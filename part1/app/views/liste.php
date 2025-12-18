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
    <header class="main-navbar">
        <div class="nav-content">
            <a href="/liste" class="nav-logo">
                <img src="/images/livraison-rapide.png" alt="" style="height: 30px;">
                Service de livraison
            </a>
            <nav class="nav-links">
                <a href="/liste">Tableau de bord</a>
                <a href="/form">Nouvelle Livraison</a>
                <a href="/benef">Bénéfices</a>
            </nav>
        </div>
    </header>
    <h1 class="title-container">
        <span>Suivi des Livraisons</span>
    </h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Colis</th>
                <th>Véhicule</th>
                <th>Livreur</th>
                <th>Coût Revient</th>
                <th>Chiffre d'affaire</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste as $l) { ?>
                <tr>
                    <td><strong><?= $l['id_livraison'] ?></strong></td>
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
                    <td><?= $ca_val ?></td>
                    <td><?= $l['dates'] ?></td>
                    <td class="status-cell"><?= $l['statut'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="container-buttons">
        <a href="/form"><button class="btn-insert">Inserer une livraison</button></a>
        <a href="/benef"><button class="btn-stats">Bénéfices societe</button></a>
    </div>
    <footer class="main-footer">
    <p>&copy; <?= date('Y') ?> - Service de livraison Madagascar. Tous droits réservés (Neks et Tsiky).</p>
    <p>Ariary (MGA)</p>
</footer>

</body>

</html>