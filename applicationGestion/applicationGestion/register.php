<?php
require 'pro.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $matricule = $_POST['Matricule'];
    $password = $_POST['password'];

    // Hashage du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Préparation de la requête d'insertion
    $sql = "INSERT INTO users (nom, prenom, email, Matricule, password_hash) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Exécution de la requête avec les valeurs des variables
    $stmt->execute([$nom, $prenom, $email, $matricule, $passwordHash]);

    // Redirection vers une page de succès ou de connexion
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html class="h-full bg-white">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer un compte</title>
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
    <!-- Section gauche : Formulaire de création de compte -->
    <div class="flex flex-col justify-center px-6 py-12 lg:px-8 w-full lg:w-1/2">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Créer un compte</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="register.php" method="POST">
          <div>
            <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>
            <div class="mt-2">
              <input id="nom" name="nom" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>
            <div class="mt-2">
              <input id="prenom" name="prenom" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse email</label>
            <div class="mt-2">
              <input id="email" name="email" type="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <label for="Matricule" class="block text-sm font-medium leading-6 text-gray-900">Matricule</label>
            <div class="mt-2">
              <input id="Matricule" name="Matricule" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
            <div class="mt-2">
              <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Créer un compte</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Section droite : Image -->
    <div class="hidden lg:flex lg:w-1/2 items-center justify-center bg-gray-100">
      <img src="https://maroc-diplomatique.net/wp-content/uploads/2022/09/amphi-droit1-e1663087164572.jpg" alt="Image descriptive" class="h-full object-cover">
    </div>
  </div>
</body>
</html>