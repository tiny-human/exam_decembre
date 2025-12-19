<?php 
$app = Flight::app();
$baseUrl = $app->get('flight.base_url');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Livraisons</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <?php include('header.php')?>
    <h1 class="title-container">
        <span>Suivi des Livraisons</span>
    </h1>
    <table>
        <thead>
            <tr>
                <th>zone</th>
                <th>Colis</th>
                <th>Véhicule</th>
                <th>Livreur</th>
                <th>Coût Revient</th>
                <th>Chiffre d'affaire</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste as $l) { ?>
                <tr>
                    <td><strong><?= $l['zone'] ?></strong></td>
                    <td><?= $l['colis'] ?></td>
                    <td><?= $l['vehicule'] ?></td>
                    <td><?= $l['livreur'] ?></td>
                    <?php
                    $cout_val = "-";
                    foreach ($cout as $c) {
                        if ($c['id_livraison'] == $l['id_livraison']) {
                            $cout_val = $c['cout_revient'] . " Ar";
                        }
                    }
                    ?>
                    <td><?= $cout_val ?></td>
                    <?php
                    $ca_val = "-";
                    foreach ($recette as $r) {
                        if ($r['id_livraison'] == $l['id_livraison']) {
                            $ca_val = $r['chiffre_affaire'] . " Ar";
                        }
                    }
                    ?>
                    <td><?= $l['statut'] == "annule" ? "0" : $ca_val ?></td>
                    <td><?= $l['dates'] ?></td>
                    <td class="status-cell"><?= $l['statut'] ?></td>
                    <td>
                    <a href="/form_modification/<?= $l['id_livraison']?>" class="btn-submit" style="background-color: green; text-decoration: none;">
                        Modifier
                    </a>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script></script>
    <div class="container-buttons">
        <a href="/form"><button class="btn-insert">Inserer une livraison</button></a>
        <a href="/benef"><button class="btn-stats">Benefices societe</button></a>
    </div>
    <?php include('footer.php')?>
</body>
</html>