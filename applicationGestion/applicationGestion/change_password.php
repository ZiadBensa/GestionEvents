<?php

session_start();

if (!isset($_SESSION['user_id'])) {
   
    header("Location: login.php");
    exit;
}
?>

<?php
require 'pro.inc.php'; 



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupérer l'ID de l'utilisateur depuis la session
$userID = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $newPassword = $_POST['new_password'];

    // Hasher le nouveau mot de passe avant de le stocker dans la base de données
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Mettre à jour le mot de passe dans la base de données
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $stmt->execute([$hashedPassword, $userID]);

    // Rediriger vers la page de profil après la mise à jour du mot de passe
    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
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
            <h1 class="text-2xl font-semibold mb-4">Changer le mot de passe</h1>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                    <input id="new_password" name="new_password" type="password" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
                </div>
                <div class="mt-8">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Changer le mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
