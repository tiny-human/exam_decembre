<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benefices</title>
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
                <a href="/benef">Benefices</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 class="title-container">
            <span><?php echo $titre ?></span>
            <img src="/images/argent.png" alt="money" class="title-img">
        </h1>

        <p>Filtrer les benefices par :</p>

        <div class="form-filtre">
            <form method="POST" action="/benef">
                <label for="jour">Jour :</label>
                <input type="date" name="jour" id="jour" value="<?= htmlspecialchars($jour ?? '') ?>">

                <label for="mois">Mois :</label>
                <input type="month" name="mois" id="mois" value="<?= htmlspecialchars($mois ?? '') ?>" placeholder="mois en francais">

                <label for="annee">Annee :</label>
                <input type="number" name="annee" id="annee" placeholder="Ex: 2025" value="<?= htmlspecialchars($annee ?? '') ?>">

                <button type="submit">Afficher les benefices</button>
            </form>
            <small>Ne remplissez qu un seul champ a la fois.</small>
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
            <a href="/liste"><button>Retour a la liste</button></a>
        </div>
    </div>

    <footer class="main-footer">
        <p>&copy; <?= date('Y') ?> - Service de livraison Madagascar. Tous droits reserves (Neks et Tsiky).</p>
        <p>Ariary (MGA)</p>
    </footer>
</body>
</html>
