
<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit;
}
$user_role = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion des Événements</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
        }
        .header {
            background-color: #1f2937;
            color: white;
        }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .button {
            transition: background-color 0.3s;
        }
        .icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #4299e1;
        }
    </style>
</head>
<body>
    <header class="header py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Tableau de Bord</h1>
            <nav>
                <a href="logout.php" class="text-white hover:text-gray-300">Se Déconnecter</a>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Gestion des Événements</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if ($user_role === 'a') { ?>
            <div class="card bg-white rounded-lg shadow-md p-6 text-center">
                <i class="icon fas fa-calendar-plus"></i>
                <h3 class="text-xl font-semibold mb-2">Ajouter un Événement</h3>
                <p class="text-gray-600 mb-4">Ajoutez un nouvel événement à la liste.</p>
                <a href="add_event.php" class="button bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md inline-block">Ajouter un Événement</a>
            </div>
            <div class="card bg-white rounded-lg shadow-md p-6 text-center">
                <i class="icon fas fa-users"></i>
                <h3 class="text-xl font-semibold mb-2">Voir les Participants</h3>
                <p class="text-gray-600 mb-4">Consultez la liste des participants aux événements.</p>
                <a href="participants_list.php" class="button bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md inline-block">Voir les Participants</a>
            </div>
        <?php } ?>
        <div class="card bg-white rounded-lg shadow-md p-6 text-center">
            <i class="icon fas fa-calendar-alt"></i>
            <h3 class="text-xl font-semibold mb-2">Voir les Événements</h3>
            <p class="text-gray-600 mb-4">Consultez la liste des événements existants.</p>
            <a href="events.php" class="button bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md inline-block">Voir les Événements</a>
        </div>
        <div class="card bg-white rounded-lg shadow-md p-6 text-center">
            <i class="icon fas fa-user"></i>
            <h3 class="text-xl font-semibold mb-2">Voir le Profil</h3>
            <p class="text-gray-600 mb-4">Consultez votre profil utilisateur.</p>
            <a href="profile.php" class="button bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md inline-block">Voir le Profil</a>
        </div>
        <div class="card col-span-2 bg-white rounded-lg shadow-md p-6 text-center">
            <i class="icon fas fa-lock"></i>
            <h3 class="text-xl font-semibold mb-2">Modifier le Mot de Passe</h3>
            <p class="text-gray-600 mb-4">Modifiez votre mot de passe actuel.</p>
            <a href="change_password.php" class="button bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md inline-block">Modifier le Mot de Passe</a>
        </div>
    </div>
</main>

</body>
</html>
