<?php
// Start de sessie
// Deze gaan we gebruiken om de form values en de errors op te slaan
session_start();

// Controleer of het verzoek via POST is gedaan
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Valideer de ingediende gegevens
    $errors = [];
    $formValues = [
        'naam' => $_POST['naam'] ?? '',
        'omschrijving' => $_POST['omschrijving'] ?? '',
        'maat' => $_POST['maat'] ?? '',
        'afbeelding' => $_POST['afbeelding'] ?? '',
        'prijs' => $_POST['prijs'] ?? '',
    ];

    // Valideer voornaam
    if (empty($_POST['naam'])) {
        $errors['naam'] = "Naam is verplicht.";
    }

    // Valideer achternaam
    if (empty($_POST['omschrijving'])) {
        $errors['omschrijving'] = "Omschrijving is verplicht.";
    }

    if (empty($_POST['maat'])) {
        $errors['maat'] = "Maat duur is verplicht.";
    }
    if (empty($_POST['afbeelding'])) {
        $errors['afbeelding'] = "De afbeelding is verplicht.";
    }

    if (empty($_POST['prijs'])) {
        $errors['prijs'] = "De prijs is verplicht.";
    }

    // Als er geen validatiefouten zijn, voeg de persoon toe aan de database
    if (empty($errors)) {
        require_once 'db.php';
        require_once 'classes/Kleding.php';

        // Maak een nieuw Persoon object met de ingediende gegevens
        $kleding = new Kleding(
            null,
            $_POST['naam'],
            $_POST['omschrijving'],
            $_POST['maat'],
            $_POST['afbeelding'],
            $_POST['prijs']
        );

        // Voeg de persoon toe aan de database
        $kleding->save($db);

    } else {
        // Sla de fouten en formulier waarden op in sessievariabelen
        $_SESSION['errors'] = $errors;
        $_SESSION['formValues'] = $formValues;
    }

    // Stuur de gebruiker terug naar de index.php
    header("Location: kleding.php");
    exit;

} else {
    header("Location: kleding.php");
}
