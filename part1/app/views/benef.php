<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les bénéfices</title>
</head>
<body>
    <?php if (isset($benefMois) && is_array($benefMois)) { ?>

        <h3>Bénéfice par mois</h3>
        <table border = "collapse 1px">
            <thead>
                <tr>
                    <th>Mois</th>
                    <th>Annee</th>
                    <th>Total Bénéfice</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($benefMois as $b) { ?>
                <tr>
                    <td><?= $b['Mois'] ?></td>
                    <td><?= number_format($b['benefice'], 2, ',', ' ') ?> </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
    <?php } if (isset($benefJour) && is_array($benefJour)) { ?>

        <h3>Bénéfice par jour</h3>
        
        <table border = "collapse 1px">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Bénéfice</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($benefJour as $b) { ?>
                <tr>
                    <td><?= $b['jour'] ?></td>
                    <td><?= number_format($b['benefice'], 2, ',', ' ') ?> Ar</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } if (isset($benefAnnee) && is_array($benefAnnee)) { ?>

        <h3>Bénéfice par Annee</h3>
        
        <table border = "collapse 1px">
            <thead>
                <tr>
                    <th>Annee</th>
                    <th>Total Bénéfice</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($benefAnnee as $b) { ?>
                <tr>
                    <td><?= $b['annee'] ?></td>
                    <td><?= number_format($b['benefice'], 2, ',', ' ') ?> Ar</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <a href="/liste"><button>retour a la liste</button></a>

</body>
</html>