<?php
require 'pro.inc.php';
session_start();
// Récupérer tous les événements de la base de données
$stmt = $pdo->query("SELECT * FROM events");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
$user_role = $_SESSION['user_role'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Événements</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Styles CSS personnalisés */
        body {
            font-family: 'Inter', sans-serif;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .events-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .event-card {
            width: 300px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .event-card h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .event-card p {
            margin-bottom: 10px;
        }
        .event-card img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .buttons {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
        }
        .buttons button {
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .buttons button.delete {
            background-color: #f44336;
            color: #fff;
        }
        .buttons button.modify {
            background-color: #2196F3;
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">Liste des Événements</h1>
        <div class="events-container">
            <?php foreach ($events as $event): ?>
                <div class="event-card">
                    <h2><?php echo $event['event_name']; ?></h2>
                    <p><?php echo $event['description']; ?></p>
                    <p>Date: <?php echo $event['event_date']; ?></p>
                    <p>Heure: <?php echo $event['event_time']; ?></p>
                    <p>Lieu: <?php echo $event['location']; ?></p>
                    <?php if (!empty($event['image_path'])): ?>
                        <img src="<?php echo $event['image_path']; ?>" alt="Image de l'événement">
                    <?php endif; ?>
                    <?php if ($user_role === 'a') { ?>
    <div class="buttons">
        <button class="delete" onclick="deleteEvent(<?php echo $event['id']; ?>)">Supprimer</button>
        <button class="modify" onclick="editEvent(<?php echo $event['id']; ?>)">Modifier</button>
    </div>
<?php } else { ?>
    <?php if ($user_role !== 'a') { ?>
    <button class="primary bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md inline-block" onclick="participateEvent(<?php echo $event['id']; ?>)">Participer</button>
<?php } ?>

<?php } ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        function deleteEvent(eventId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
                // Envoyer une requête AJAX au serveur pour supprimer l'événement
                fetch('delete_event.php?id=' + eventId, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        // Rafraîchir la page pour refléter les changements
                        location.reload();
                    } else {
                        alert('Une erreur s\'est produite lors de la suppression de l\'événement.');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la suppression de l\'événement:', error);
                    alert('Une erreur s\'est produite lors de la suppression de l\'événement.');
                });
            }
        }

        function editEvent(eventId) {
            // Rediriger vers la page de modification avec l'identifiant de l'événement
            window.location.href = 'edit_event.php?id=' + eventId;
        }

    function participateEvent(eventId) {
        window.location.href = 'participate_event.php?id=' + eventId;
    }
    </script>
</body>
</html>




