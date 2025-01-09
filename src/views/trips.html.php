<?php

// Header loading
include_once './src/views/components/header.html.php';

// Connexion à la base de données MySQL
$host = 'localhost:3307';
$dbname = 'dailytrip_0';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// function pour récupérer les éléments de la table trips
function getTrip($pdo, $table)
{
    $query = "SELECT * FROM $table"; // On écrit la requête SQL
    $stmt = $pdo->prepare($query); // Préparation de la requête (statement)
    $stmt->execute(); // On exécute la requête
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC); // On retourne un tableau associatif
    return $trips;
}

$trips = getTrip($pdo, 'trips');

?>

<div>
    <h1>trips</h1>

    <?php foreach ($trips as $commande): ?>
    <li class="flex justify-between items-center p-4 bg-white rounded-lg shadow-lg">
        <div class="text-xl font-medium"><?= $commande['ref'] ?></div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
            data-modal-toggle="commandeModal<?= $commande['id'] ?>">
            Détails
        </button>
    </li>
    <?php endforeach; ?>
</div>

<?php include_once './src/views/components/footer.html.php'; ?>