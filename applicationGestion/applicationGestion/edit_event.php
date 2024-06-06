<?php
require 'pro.inc.php';

// Vérifier si l'ID de l'événement à modifier est passé en paramètre GET
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Récupérer les informations de l'événement à modifier depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$eventId]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$event) {
        echo "Événement non trouvé.";
        exit;
    }
} else {
    echo "ID de l'événement non spécifié.";
    exit;
}

// Traitement du formulaire de modification d'événement
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $eventName = $_POST['event-name'];
    $description = $_POST['description'];
    $eventDate = $_POST['date'];
    $eventTime = $_POST['time'];
    $location = $_POST['location'];
    
    // Mettre à jour les informations de l'événement dans la base de données
    $stmt = $pdo->prepare("UPDATE events SET event_name = ?, description = ?, event_date = ?, event_time = ?, location = ? WHERE id = ?");
    $stmt->execute([$eventName, $description, $eventDate, $eventTime, $location, $eventId]);

    // Rediriger vers la page d'affichage des événements après la modification
    header("Location: events.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Événement</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Ajoutez vos styles personnalisés ici si nécessaire */
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Modifier Événement</h1>
        <form action="" method="POST">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="event-name" class="block text-sm font-medium text-gray-700">Nom de l'Événement</label>
                    <input id="event-name" name="event-name" type="text" value="<?php echo $event['event_name']; ?>" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"><?php echo $event['description']; ?></textarea>
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input id="date" name="date" type="date" value="<?php echo $event['event_date']; ?>" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3">
                </div>
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700">Heure</label>
                    <input id="time" name="time" type="time" value="<?php echo $event['event_time']; ?>" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
                    <input id="location" name="location" type="text" value="<?php echo $event['location']; ?>" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</body>
</html>
