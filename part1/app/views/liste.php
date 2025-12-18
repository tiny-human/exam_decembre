<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les livraisons</title>
</head>
<body>
    <table border = "collapse 1px">
        <tr>
            <td>id livraison</td>
            <td>id colis</td>
            <td>id vehicule</td>
            <td>livreur</td>
            <td>cout de revient</td>
            <td>chiffre d'affaire</td>
            <td>date de la livraison</td>
            <td>statut</td>
        </tr>
        <?php foreach($liste as $l){ ?>
            <tr>
                <td><?= $l['id_livraison'] ?></td>
                <td><?= $l['colis'] ?></td>
                <td><?= $l['vehicule'] ?></td>
                <td><?= $l['livreur'] ?></td>
                <?php foreach ($cout as $c ) { 
                    if ($c['id_livraison'] == $l['id_livraison']) { ?>
                        <td><?= $c['cout_revient'] ?></td>
                   <?php }?>
                <?php } ?>
                <?php foreach ($recette as $r ) { 
                    if ($r['id_livraison'] == $l['id_livraison']) { ?>
                        <td><?= $r['chiffre_affaire'] ?></td>
                   <?php }?>
                <?php } ?>
                <td><?= $l['dates'] ?></td>
                <td><?= $l['statut'] ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="/form"><button>inserer une livraison</button></a>
    <a href="/benef"><button>les benefices de la societe</button></a>
</body>
</html>