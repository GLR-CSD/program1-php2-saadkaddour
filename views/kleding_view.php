<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kledinglijst</title>
    <link rel="stylesheet" href="public/css/simple.css">
</head>
<body>
<h1>Kleding</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Omschrijving</th>
        <th>Maat</th>
        <th>Afbeelding</th>
        <th>Prijs</th>
    </tr>
    <?php foreach ($kledings as $kleding): ?>
        <tr>
            <td><?= $kleding->getId() ?></td>
            <td><?= $kleding->getNaam() ?></td>
            <td><?= $kleding->getOmschrijving() ?></td>
            <td><?= $kleding->getMaat() ?></td>
            <td><img src="<?= htmlspecialchars($kleding->getAfbeelding()) ?>" alt="Afbeelding van <?= htmlspecialchars($kleding->getNaam()) ?>" style="width:100px;height:auto;"></td>
            <td><?= $kleding->getPrijs() ?></td>

        </tr>
    <?php endforeach; ?>
</table>

<div class="notice">
    <h2>Kleding Toevoegen:</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="kleding_toevoegen.php" method="post">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" value="<?= $formValues['naam'] ?? '' ?>" required>
        <?php if (isset($errors['naam'])): ?>
            <span style="color: red;"><?= $errors['naam'] ?></span>
        <?php endif; ?><br>

        <label for="omschrijving">Omschrijving:</label>
        <input type="text" id="omschrijving" name="omschrijving" value="<?= $formValues['omschrijving'] ?? '' ?>"  required>
        <?php if (isset($errors['omschrijving'])): ?>
            <span style="color: red;"><?= $errors['omschrijving'] ?></span>
        <?php endif; ?><br>

        <label for="maat">Maat:</label>
        <input type="text" id="maat" name="maat" value="<?= $formValues['maat'] ?? '' ?>">
        <?php if (isset($errors['maat'])): ?>
            <span style="color: red;"><?= $errors['maat'] ?></span>
        <?php endif; ?><br>

        <label for="afbeelding">Afbeelding:</label>
        <input type="url" id="afbeelding" name="afbeelding" value="<?= $formValues['afbeelding'] ?? '' ?>">
        <?php if (isset($errors['afbeelding'])): ?>
            <span style="color: red;"><?= $errors['afbeelding'] ?></span>
        <?php endif; ?><br>

        <label for="prijs">Prijs:</label>
        <input type="number" id="prijs" name="prijs" value="<?= $formValues['prijs'] ?? '' ?>">
        <?php if (isset($errors['prijs'])): ?>
            <span style="color: red;"><?= $errors['prijs'] ?></span>
        <?php endif; ?><br>

        <input type="submit" value="Toevoegen">
    </form>
</div>

</body>
</html>
