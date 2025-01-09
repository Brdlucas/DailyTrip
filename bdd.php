<?php

// Informations de connexion à la base de données
$host = 'localhost:3307';
$user = 'root';
$password = '';
$database = 'dailytrip_0';


try {
    // Connexion au serveur MySQL sans sélectionner de base de données
    $conn = new PDO("mysql:host=$host", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer la base de données si elle n'existe pas
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` DEFAULT CHARACTER SET = 'utf8mb4'";
    $conn->exec($sql);
    echo "Base de données '$database' créée avec succès.\n";

    // Se connecter à la base de données créée
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Définir le moteur InnoDB pour la création des tables
    $engine = 'ENGINE = InnoDB';

    // Création des tables
    $tables = [

        // "DROP TABLE trips",
        // "DROP TABLE category",
        // "DROP TABLE localisation",
        // "DROP TABLE review",
        // "DROP TABLE admin",
        // "DROP TABLE poi",
        // "DROP TABLE rating",
        // "DROP TABLE gallery",
        // "DROP TABLE images",
        // "DROP TABLE gallery_images",

        "CREATE TABLE IF NOT EXISTS `gallery`(`id` INT PRIMARY KEY  AUTO_INCREMENT)",
        "CREATE TABLE IF NOT EXISTS `images`(`id` INT PRIMARY KEY  AUTO_INCREMENT)",
        "CREATE TABLE IF NOT EXISTS `gallery_images`(`id` INT PRIMARY KEY  AUTO_INCREMENT, `gallery_id` INT, `image_id` INT)",
        "CREATE TABLE IF NOT EXISTS `admin`(`id` INT PRIMARY KEY  AUTO_INCREMENT, `email` VARCHAR(255) NOT NULL, `password` VARCHAR(255) NOT NULL)",
        "CREATE TABLE IF NOT EXISTS `category` (`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `name` VARCHAR(255) NOT NULL, `image` VARCHAR(255) NOT NULL)",
        "CREATE TABLE IF NOT EXISTS `rating`(`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `note` BIGINT, `ip_address` VARCHAR(255) NOT NULL, `trip_id` INT)",
        "CREATE TABLE IF NOT EXISTS `review`(`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `fullname` VARCHAR(255) NOT NULL, `content` TEXT, `email` VARCHAR(255) NOT NULL, `trip_id` INT)",
        "CREATE TABLE IF NOT EXISTS `poi`(`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `point` VARCHAR(255) NOT NULL, `password` VARCHAR(255) NOT NULL, localisation_id INT, gallery_id INT)",
        "CREATE TABLE IF NOT EXISTS `localisation`(`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `start` VARCHAR(255) NOT NULL, `finish` VARCHAR(255) NOT NULL, `distance` DECIMAL(8,2), `duration` TIME)",
        "CREATE TABLE IF NOT EXISTS `trips`(`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `ref` VARCHAR(255) NOT NULL, `title` VARCHAR(255) NOT NULL, `description` VARCHAR(255) NOT NULL, `cover` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL, localisation_id INT,  status BOOLEAN, category_id INT, gallery_id INT)",

    ];

    // print_r($tables);

    // Exécution de la création des tables
    foreach ($tables as $tableSql) {
        try {
            $conn->exec($tableSql);
            echo "Table créée avec succès.\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création de la table : " . $e->getMessage() . "\n";
        }
    }

    // Ajout des clés étrangères
    $constraints = [
        // TODO: Ajoutez vos requêtes SQL de contraintes ici

        // suppression des clé étrangères
        // "ALTER TABLE trips DROP FOREIGN KEY gallery_id",
        // "ALTER TABLE trips DROP FOREIGN KEY localisation_id",
        // "ALTER TABLE trips DROP FOREIGN KEY category_id",
        // "ALTER TABLE poi DROP FOREIGN KEY category_id",
        // "ALTER TABLE poi DROP FOREIGN KEY gallery_id",
        // "ALTER TABLE gallery_images DROP FOREIGN KEY image_id",
        // "ALTER TABLE gallery_images DROP FOREIGN KEY gallery_id",
        // "ALTER TABLE review DROP FOREIGN KEY trip_id",
        // "ALTER TABLE rating DROP FOREIGN KEY trip_id",


        // ajouter des clé étrangères 
        "ALTER TABLE trips ADD CONSTRAINT FOREIGN KEY (gallery_id) REFERENCES gallery(id)",
        "ALTER TABLE trips ADD CONSTRAINT FOREIGN KEY (category_id) REFERENCES category(id)",
        "ALTER TABLE trips ADD CONSTRAINT FOREIGN KEY (localisation_id) REFERENCES localisation(id)",
        "ALTER TABLE poi ADD CONSTRAINT FOREIGN KEY (gallery_id) REFERENCES gallery(id)",
        "ALTER TABLE poi ADD CONSTRAINT FOREIGN KEY (localisation_id) REFERENCES localisation(id)",
        "ALTER TABLE gallery_images ADD CONSTRAINT FOREIGN KEY (image_id) REFERENCES images(id)",
        "ALTER TABLE gallery_images ADD CONSTRAINT FOREIGN KEY (gallery_id) REFERENCES gallery(id)",
        "ALTER TABLE review ADD CONSTRAINT FOREIGN KEY (trip_id) REFERENCES trips(id)",
        "ALTER TABLE rating ADD CONSTRAINT FOREIGN KEY (trip_id) REFERENCES trips(id)",

    ];

    // print_r($constraints);
    // Exécution des contraintes de clés étrangères
    foreach ($constraints as $constraintSql) {
        try {
            $conn->exec($constraintSql);
            echo "Contrainte de clé étrangère ajoutée avec succès.\n";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la contrainte : " . $e->getMessage() . "\n";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    exit;
} finally {
    // Fermer la connexion
    $conn = null;
}
