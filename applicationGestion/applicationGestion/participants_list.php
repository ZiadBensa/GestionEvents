<?php
require 'pro.inc.php';
session_start();

// Récupérer tous les événements avec leurs participants
$query = "
    SELECT e.event_name, e.event_date, e.event_time, e.location, u.id AS user_id, u.Matricule, u.nom, u.prenom, u.email, ep.participation_date
    FROM event_participants ep
    JOIN events e ON ep.event_id = e.id
    JOIN users u ON ep.user_id = u.id
    ORDER BY e.event_date, e.event_time
";
$stmt = $pdo->query($query);
$participants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Participants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">Liste des Participants</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom de l'événement</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Lieu</th>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Date de participation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $participant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($participant['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($participant['event_date']); ?></td>
                        <td><?php echo htmlspecialchars($participant['event_time']); ?></td>
                        <td><?php echo htmlspecialchars($participant['location']); ?></td>
                        <td><?php echo htmlspecialchars($participant['Matricule']); ?></td>
                        <td><?php echo htmlspecialchars($participant['nom']); ?></td>
                        <td><?php echo htmlspecialchars($participant['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($participant['email']); ?></td>
                        <td><?php echo htmlspecialchars($participant['participation_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="events.php" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Retour à la liste des événements</a>
    </div>
</body>
</html>
