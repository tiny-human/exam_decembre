<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benefices</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <?php include('header.php')?>
 
    <div class="container">
        <h1 class="title-container">
            <span><?php echo $titre ?></span>
            <img src="/images/argent.png" alt="money" class="title-img">
        </h1>

        <p>Filtrer les benefices par :</p>

        <div class="form-filtre">
            <form method="POST" action="/benef">
                <label for="jour">Jour :</label>
                <input type="date" name="jour" id="jour" value="<?= ($jour ?? '') ?>">

                <label for="mois">Mois :</label>
                <select name="mois" id="mois">
                <option value=""></option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>

                <label for="annee">Annee :</label>
                <input type="number" name="annee" id="annee" placeholder="Ex: 2025" value="<?= ($annee ?? '') ?>">

                <button type="submit">Afficher les benefices</button>
            </form>
            <small>Ne remplissez qu un seul champ a la fois.</small>
        </div>

        <?php if ($messageErreur): ?>
            <div class="erreur">
                <?= ($messageErreur) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($benefices)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Benefice (Ar)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($benefices as $b): ?>
                        <tr>
                            <td>
                                <?php
                                if ($typeAffiche === 'jour') {
                                    echo date('d/m/Y', strtotime($b['jour']));
                                } elseif ($typeAffiche === 'mois') {
                                    if (isset($b['mois_annee'])) {
                                        echo ($b['mois_annee']);
                                    } elseif (isset($b['mois']) && isset($b['annee'])) {
                                        echo ($b['mois'] . ' ' . $b['annee']);
                                    } else {
                                        echo "Mois inconnu";
                                    }
                                } elseif ($typeAffiche === 'annee') {
                                    echo ($b['annee']);
                                }
                                ?>
                            </td>
                            <td><?= number_format($b['benefice'], 2, ',', ' ') ?> Ar</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="retour">
            <a href="/liste"><button>Retour a la liste</button></a>
        </div>
    </div>
    <?php include('footer.php')?>

   
</body>
</html>
