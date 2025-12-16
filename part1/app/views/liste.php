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
            <td>date de la livraison</td>
            <td>carburant</td>
            <td>salaire livreur </td>
            <td>statut</td>
        </tr>
        <?php foreach($liste as $l){ ?>
            <tr>
                <td><?= $l['id_livraison'] ?></td>
                <td><?= $l['id_colis'] ?></td>
                <td><?= $l['id_vehicule'] ?></td>
                <?php foreach($livreur as $liv){ ?>
                    <td><?= ($l['id_livraison'] = $liv['id_livreur']) ? $liv['nom'] : ""?></td>
                <?php } ?>
                <td><?= $l['date'] ?></td>
                <td><?= $l['carburant'] ?></td>
                <td><?= $l['salaire'] ?></td>
                <td><?= $l['statut'] ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="/form"><button>inserer une livraison</button></a>
    <a href="/benef/mois"><button>les benefices par mois</button></a>
   <a href="/benef/jour"><button>les benefices par jour</button></a>
   <a href="/benef/annee"><button>les benefices par annee</button></a>
</body>
</html>