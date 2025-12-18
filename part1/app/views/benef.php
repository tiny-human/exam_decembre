<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bénéfices</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f9f9f9; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .form-filtre { background: #f0f8ff; padding: 20px; border-radius: 8px; margin-bottom: 30px; text-align: center; }
        .form-filtre label { display: inline-block; margin: 10px 5px 5px; font-weight: bold; }
        .form-filtre input { padding: 10px; width: 200px; margin: 5px; }
        .form-filtre button { margin-top: 20px; padding: 12px 24px; background: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ccc; padding: 12px; text-align: center; }
        th { background: #007bff; color: white; }
        .retour { text-align: center; margin: 30px 0; }
        .erreur { background:#ffeeee; color:#d8000c; padding:15px; border-radius:8px; margin:20px 0; text-align:center; font-weight:bold; }
    </style>
</head>
<body>

<div class="container">
    <h1><?= htmlspecialchars($titre) ?></h1>

    <p>Filtrer les bénéfices par :</p>
    <div class="form-filtre">
        <form method="POST" action="/benef">
            <label for="jour">Jour :</label>
            <input type="date" name="jour" id="jour" value="<?= htmlspecialchars($jour ?? '') ?>">

            <label for="mois">Mois :</label>
            <input type="month" name="mois" id="mois" value="<?= htmlspecialchars($mois ?? '') ?>" placeholder="mois en francais">

            <label for="annee">Année :</label>
            <input type="number" name="annee" id="annee" placeholder="Ex: 2025" value="<?= htmlspecialchars($annee ?? '') ?>">

            <button type="submit">Afficher les bénéfices</button>
        </form>
        <small>Ne remplissez qu’un seul champ à la fois.</small>
    </div>
    <?php if ($messageErreur): ?>
        <div class="erreur">
            <?= htmlspecialchars($messageErreur) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($benefices)): ?>
        <table>
            <thead>
                <tr>
                    <th>Période</th>
                    <th>Bénéfice (Ar)</th>
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
                                    echo htmlspecialchars($b['mois_annee']);
                                } elseif (isset($b['mois']) && isset($b['annee'])) {
                                    echo htmlspecialchars($b['mois'] . ' ' . $b['annee']);
                                } else {
                                    echo "Mois inconnu";
                                }
                            } elseif ($typeAffiche === 'annee') {
                                echo htmlspecialchars($b['annee']);
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
        <a href="/liste"><button>Retour à la liste</button></a>
    </div>
</div>

</body>
</html>