<?php

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
require 'pro.inc.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST['event-name'];
    $description = $_POST['description'];
    $eventDate = $_POST['date'];
    $eventTime = $_POST['time'];
    $location = $_POST['location'];
    
    // Gestion de l'image
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $imagePath = 'uploads/' . $imageName;
        
        
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            die("Échec du téléchargement de l'image.");
        }
    }

   
    try {
        $sql = "INSERT INTO events (event_name, description, event_date, event_time, location, image_path) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$eventName, $description, $eventDate, $eventTime, $location, $imagePath]);

        echo "Nouvel événement créé avec succès";
        header("Location: events.php");
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Événements</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
    
  </style>
</head>
<body class="h-full">
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Créer un Nouvel Événement</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
      <form class="space-y-6 bg-white p-8 shadow sm:rounded-lg" action="#" method="POST" enctype="multipart/form-data">
        <div>
          <label for="event-name" class="block text-sm font-medium text-gray-700">Nom de l'Événement</label>
          <div class="mt-1">
            <input id="event-name" name="event-name" type="text" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
          </div>
        </div>

        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <div class="mt-1">
            <textarea id="description" name="description" rows="3" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
          </div>
        </div>

        <div>
          <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
          <div class="mt-1">
            <input id="date" name="date" type="date" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3">
          </div>
        </div>

        <div>
          <label for="time" class="block text-sm font-medium text-gray-700">Heure</label>
          <div class="mt-1">
            <input id="time" name="time" type="time" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3">
          </div>
        </div>

        <div>
          <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
          <div class="mt-1">
            <input id="location" name="location" type="text" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
          </div>
        </div>

        <div>
          <label for="image" class="block text-sm font-medium text-gray-700">Image de l'Événement</label>
          <div class="mt-1">
            <input id="image" name="image" type="file" class="block w-full text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Créer l'Événement
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

