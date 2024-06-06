<?php
require 'pro.inc.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Vérifier si l'utilisateur est déjà inscrit à cet événement
    $stmt = $pdo->prepare("SELECT * FROM event_participants WHERE event_id = ? AND user_id = ?");
    $stmt->execute([$event_id, $user_id]);
    if ($stmt->rowCount() > 0) {
        header('Location: participate_confirmation.php?status=already_participated');
        exit();
    }

    // Insérer l'inscription dans la base de données
    $stmt = $pdo->prepare("INSERT INTO event_participants (event_id, user_id) VALUES (?, ?)");
    if ($stmt->execute([$event_id, $user_id])) {
        header('Location: participate_confirmation.php?status=success');
        exit();
    } else {
        header('Location: participate_confirmation.php?status=error');
        exit();
    }
} else {
    header('Location: events_list.php');
    exit();
}
?>
