<?php

use Eden\R606Eval\Entity\DbTable;

require_once __DIR__ . '/bootstrap.php';

$tables = [];
$exData = ["azerty", "qabcdefh", "xyz", "123456789"];

try {
    $repo = $entityManager->getRepository(DbTable::class);
    $tables = $repo->findAll();
    if (empty($tables)) {
        foreach ($exData as $text) {
            $table = new DbTable();
            $table->setText($text);
            $entityManager->persist($table);
        }
        $entityManager->flush();
    }
} catch (Exception $e) {
    $tables = [];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>R6.06 Maintenance applicative</title>
</head>

<body>
    <header>
        <h1>R6.06 Maintenance applicative</h1>
        <h2 style="color: crimson">Evaluation</h2>
        <p style="color: crimson">Modifiez ce projet à l'aide des outils vus ensemble pour améliorer la maintenabilité de ce projet et déployez le sur le serveur mis à votre disposition</p>
        <p style="color: crimson">Vous êtes libre de modifier ce que vous souhaitez sur le projet, chaque amélioration (ou début d'amélioration) sera prise en compte dans la notation</p>
        <p style="color: crimson; font-weight: bold; border: solid 2px crimson; padding: 5px; width: fit-content;">Pensez à inviter cdiiv sur votre projet Github</p>
    </header>

    <table>
        <thead style="font-weight: bold;">
            <tr>
                <td style="border: solid black 1px">Id</td>
                <td style="border: solid black 1px">Text</td>
            </tr>
        </thead>
        <?php if (empty($tables)): ?>
            <tbody>
                <tr>
                    <td colspan="2" style="border: solid black 1px; text-align: center;">Aucun résultat</td>
                </tr>
            </tbody>
        <?php else : ?>
            <tbody>
                <?php foreach ($tables as $table): ?>
                    <tr>
                        <td style="border: solid black 1px"><?= $table->getId() ?></td>
                        <td style="border: solid black 1px"><?= $table->getText() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php endif; ?>
    </table>
</body>

</html>