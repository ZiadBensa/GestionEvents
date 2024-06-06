<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit;
}
?>

<?php
require 'pro.inc.php';

// Récupérer l'utilisateur à partir de la base de données (supposons que vous avez déjà un mécanisme d'authentification)
// Vous pouvez utiliser la session pour stocker l'ID de l'utilisateur après la connexion
$userID = $_SESSION['user_id']; // Supposons que vous stockiez l'ID de l'utilisateur dans la session

// Préparer la requête pour récupérer les informations de l'utilisateur à partir de son ID
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userID]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe
if (!$user) {
    // Rediriger l'utilisateur vers une page d'erreur ou de connexion s'il n'existe pas
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h1 class="text-2xl font-semibold mb-4">Profil Utilisateur</h1>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nom</label>
                <p class="mt-1 text-sm text-gray-900"><?php echo $user['nom']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Prénom</label>
                <p class="mt-1 text-sm text-gray-900"><?php echo $user['prenom']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Adresse Email</label>
                <p class="mt-1 text-sm text-gray-900"><?php echo $user['email']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Matricule</label>
                <p class="mt-1 text-sm text-gray-900"><?php echo $user['Matricule']; ?></p>
            </div>
            <div class="mt-8">
                <a href="change_password.php" class="ml-4 text-indigo-600 hover:text-indigo-500">Modifier le mot de passe</a>
            </div>
        </div>
    </div>
</body>
</html>
