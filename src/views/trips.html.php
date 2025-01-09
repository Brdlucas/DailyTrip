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
function getInfo($pdo, $table)
{
    $query = "SELECT * FROM $table"; // On écrit la requête SQL
    $stmt = $pdo->prepare($query); // Préparation de la requête (statement)
    $stmt->execute(); // On exécute la requête
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC); // On retourne un tableau associatif
    return $trips;
}
// on récuprère le tableau associatif
$trips = getInfo($pdo, 'trips');

// on récuprère le tableau associatif
$ratings = getInfo($pdo, 'rating');

?>



<div>
    <h1>trips</h1>
    <div class="mb-44 grid grid-cols-4 gap-10  justify-around max-w-screen-lg mx-auto">
        <!-- foreach pour chaque trips du table -->
        <?php foreach ($trips as $trip): ?>
            <div class="relative border rounded-lg">
                <div class="absolute bg-gradient-to-b from-transparent from-60% to-neutral-900 w-full h-full rounded-lg">
                    <div class="grid w-full h-full rounded-lg content-between p-2">
                        <button
                            class="place-self-end rounded-full w-fit h-fit grid place-items-center p-1.5 hover:bg-red-600 transition ease-in-out text-white cursor-pointer">
                            <span class="material-symbols-outlined">favorite</span>
                        </button><!-- Favoris button-->
                        <div class="flex justify-between items-center">
                            <div class="text-white font-bold">
                                <p class="">
                                    <!-- affichage du titre -->
                                    <?= $trip['title']; ?>
                                </p>
                                <div class="flex">
                                    <!-- si le trip id est égal a l'id du trip alors on affiche la note -->

                                    <!-- <?php foreach ($ratings as $rating): ?>
                                        <?= $rating['trip_id'] === $trip['id'] ? "<p>" . $rating['note'] . "</p>" :  false ?>
                                    <?php endforeach; ?> -->
                                </div>

                                <div class="">
                                    <span class="material-symbols-outlined text-yellow-500">star</span>
                                    <span class="material-symbols-outlined text-yellow-500">star</span>
                                    <span class="material-symbols-outlined text-yellow-500">star</span>
                                    <span class="material-symbols-outlined">star</span>
                                </div>
                            </div>
                            <!--- Infos block -->
                            <div class="">
                                <a href=""
                                    class="ease-in-out	transition bg-white rounded-full w-fit h-fit grid place-items-center p-1.5 shadow-lg hover:bg-[#fba708] hover:-rotate-45 cursor-pointer">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </a>
                            </div><!-- Go to trip -->
                        </div>
                    </div>
                </div>
                <!-- on récupère l'image de cover dans la table -->
                <img src="<?= $trip['cover'] ?>" alt="" class="rounded-lg w-full min-h-80">
            </div>
        <?php endforeach; ?>
    </div><!-- Popular trips -->

    <?php include_once './src/views/components/footer.html.php'; ?>