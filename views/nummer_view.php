<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personenlijst</title>
    <link rel="stylesheet" href="public/css/simple.css">
</head>
<body>
<h1>Nummers</h1>
<table>
    <tr>
        <th>ID</th>
        <th>AlbumID</th>
        <th>Titel</th>
        <th>Duur</th>
        <th>URL</th>
    </tr>
    <?php foreach ($Nummers as $Nummer): ?>
        <tr>
            <td><?= $Nummer->getId() ?></td>
            <td><?= $Nummer->getAlbumID() ?></td>
            <td><?= $Nummer->getTitel() ?></td>
            <td><?= $Nummer->getDuur() ?></td>
            <td><?= $Nummer->getURL() ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="notice">
    <h2>Nummer Toevoegen:</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="nummer_toevoegen.php" method="post">
        <label for="AlbumID">AlbumID:</label>
        <input type="number" id="AlbumID" name="AlbumID" value="<?= $formValues['AlbumID'] ?? '' ?>" required>
        <?php if (isset($errors['AlbumID'])): ?>
            <span style="color: red;"><?= $errors['AlbumID'] ?></span>
        <?php endif; ?><br>

        <label for="Titel">Titel:</label>
        <input type="text" id="Titel" name="Titel" value="<?= $formValues['Titel'] ?? '' ?>"  required>
        <?php if (isset($errors['Titel'])): ?>
            <span style="color: red;"><?= $errors['Titel'] ?></span>
        <?php endif; ?><br>

        <label for="Duur">Duur:</label>
        <input type="time" id="Duur" name="Duur" value="<?= $formValues['Duur'] ?? '' ?>">
        <?php if (isset($errors['Duur'])): ?>
            <span style="color: red;"><?= $errors['Duur'] ?></span>
        <?php endif; ?><br>

        <label for="URL">URL:</label>
        <input type="url" id="URL" name="URL" value="<?= $formValues['URL'] ?? '' ?>">
        <?php if (isset($errors['URL'])): ?>
            <span style="color: red;"><?= $errors['URL'] ?></span>
        <?php endif; ?><br>

        <input type="submit" value="Toevoegen">
    </form>
</div>

</body>
</html>
