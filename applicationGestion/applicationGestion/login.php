<?php
// Inclure le fichier de connexion à la base de données
require 'pro.inc.php';

// Démarrer la session en début de script
session_start();

// Vérifier si le formulaire de connexion est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $matricule = $_POST['Matricule'];
    $password = $_POST['password'];

    // Requête SQL pour sélectionner l'utilisateur avec le matricule donné
    $stmt = $pdo->prepare("SELECT * FROM users WHERE Matricule = ?");
    $stmt->execute([$matricule]);
    $user = $stmt->fetch();

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password_hash'])) {
        // Authentification réussie, stocker les informations de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_matricule'] = $user['Matricule'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // Rediriger vers la page d'accueil ou une autre page protégée
        header("Location: dashboard.php");
        exit;
    } else {
        // Identifiants incorrects, afficher un message d'erreur
        $error_message = "Matricule ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html class="h-full bg-white">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="h-full">
  <div class="flex min-h-full">
    <!-- Section gauche : Formulaire de connexion -->
    <div class="flex flex-col justify-center px-6 py-12 lg:px-8 w-full lg:w-1/2">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Connectez-vous à votre compte</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <?php if(isset($error_message)) { ?>
            <p class="text-red-500 text-sm"><?php echo $error_message; ?></p>
          <?php } ?>
          <div>
            <label for="Matricule" class="block text-sm font-medium leading-6 text-gray-900">Matricule</label>
            <div class="mt-2">
              <input id="Matricule" name="Matricule" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
            </div>
            <div class="mt-2">
              <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Se connecter</button>
          </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-500">
        Pas encore membre?
      <a href="/applicationGestion/register.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Créer un compte</a>
    </p>
      </div>
    </div>

    <!-- Section droite : Image -->
    <div class="hidden lg:flex lg:w-1/2 items-center justify-center bg-gray-100">
      <img src="https://tawjihmaroc.com/media/cache/size_730_450/front/images/schools/93/578134e1afc263e164afb45145bbc1a8.png" alt="Image descriptive" class="h-full object-cover">
    </div>
  </div>
</body>
</html>
