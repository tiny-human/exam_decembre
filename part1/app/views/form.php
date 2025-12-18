<?php 
$app = Flight::app();
$baseUrl = $app->get('flight.base_url');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation de livraison</title>
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
    <h1 class="title-container">
        <span>Inserer une livraison</span>
        <img src="/images/plus.png" alt="moto" class="title-img">
    </h1>

    <div class="form-card">
        <form  method="post" id="myForm">
            <div class="form-grid">
                <div class="form-group">
                    <label for="colis">Colis :</label>
                    <select name="id_colis" id="colis" required>
                        <option value="">nom du colis</option>
                        <?php foreach ($colis as $c): ?>
                            <option value="<?= htmlspecialchars($c['id_colis']) ?>">
                                <?= htmlspecialchars($c['nom']) ?> (<?= htmlspecialchars($c['poids']) ?> kg)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="vehicule">Vehicule :</label>
                    <select name="id_vehicule" id="vehicule" required>
                        <option value="">vehicule de livraison</option>
                        <?php foreach ($vehicule as $v): ?>
                            <option value="<?= htmlspecialchars($v['id_vehicule']) ?>">
                                <?= htmlspecialchars($v['numero']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="livreur">Livreur :</label>
                    <select name="id_livreur" id="livreur" required>
                        <option value="">livreur</option>
                        <?php foreach ($livreur as $l): ?>
                            <option value="<?= htmlspecialchars($l['id_livreur']) ?>">
                                <?= htmlspecialchars($l['prenom']) ?> <?= htmlspecialchars($l['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Date de livraison :</label>
                    <input type="date" name="date_livraison" id="date" required>
                </div>

                <div class="form-group full-width">
                    <label for="depart">Adresse de depart :</label>
                    <input type="text" name="adresse_depart" id="depart" placeholder="Entrepot" required>
                </div>

                <div class="form-group">
                    <label for="zone">Zone de livraison :</label>
                    <select name="id_zone" id="zone" required>
                        <option value="">zone pour livrer</option>
                        <?php foreach ($zone as $z): ?>
                            <option value="<?= htmlspecialchars($z['id_zone']) ?>">
                                <?= htmlspecialchars($z['nom_zone']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="statut">Statut initial :</label>
                    <select name="id_statut" id="statut" required>
                        <option value="">etat de la livraison</option>
                        <?php foreach ($statut as $s): ?>
                            <option value="<?= htmlspecialchars($s['id_statut']) ?>">
                                <?= htmlspecialchars($s['statut']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="carburant">Cout du vehicule :</label>
                    <input type="number" name="cout_vehicule" id="carburant"
                        placeholder="Ex: 15000" step="0.01" min="0" required>
                </div>
            </div>

            <input type="submit" class="btn-submit" value="Confirmer la creation">
        </form>
    </div>
    <script type="text/javascript">
        window.addEventListener("load", function() {
            function sendData() {
                var xhr = new XMLHttpRequest();
                var formData = new FormData(form);
                xhr.addEventListener("load", function(event) {
                    var msg = (event.target.responseText != "") ? event.target.responseText : "Livraison inseree avec succes !";
                    alert(msg);
                });
                xhr.addEventListener("error", function(event) {
                    alert('Oups! Quelque chose s\'est mal passé lors de l\'envoi.');
                });

                xhr.open("POST", "/insert_livraison",true); 
                xhr.send(formData);
            }
            var form = document.getElementById("myForm");
            form.addEventListener("submit", function(event) {
                event.preventDefault(); 
                sendData();
            });
        });
    </script>

    <div class="footer-link">
        <a href="/liste" class="btn-back">← Revenir en arriere</a>
    </div>
    <footer class="main-footer">
        <p>&copy; <?= date('Y') ?> - Service de livraison Madagascar. Tous droits reserves (Neks et Tsiky).</p>
        <p>Ariary (MGA)</p>
    </footer>
</body>

</html>