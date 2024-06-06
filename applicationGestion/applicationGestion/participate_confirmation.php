<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Participation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container">
        <?php if ($_GET['status'] === 'success'): ?>
            <h1 class="text-3xl font-bold mb-4">Vous avez bien été inscrit à l'événement.</h1>
        <?php elseif ($_GET['status'] === 'already_participated'): ?>
            <h1 class="text-3xl font-bold mb-4">Vous êtes déjà inscrit à cet événement.</h1>
        <?php else: ?>
            <h1 class="text-3xl font-bold mb-4">Une erreur s'est produite. Veuillez réessayer.</h1>
        <?php endif; ?>
        <a href="events.php" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Retour à la liste des événements</a>
    </div>
</body>
</html>
