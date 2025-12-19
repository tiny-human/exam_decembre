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
    <?php include('header.php')?>
  
    <h1 class="title-container">
        <span>Modifier la livraison numero : <?= $id ?></span>
        <img src="/images/editer.png" alt="moto" class="title-img">
    </h1>
    <div class="form-card">
        <form  method="post" id="myForm">
            <div class="form-grid">
                <div class="form-group">
                    <label for="colis">Colis :</label>
                    <select name="id_colis" id="colis" required>
                        <option value="" selected disabled><?= $liste['colis'] ?></option>
                        <?php foreach ($colis as $c): ?>
                            <option value="<?= ($c['id_colis']) ?>">
                                <?= ($c['nom']) ?> (<?= ($c['poids']) ?> kg)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vehicule">Vehicule :</label>
                    <select name="id_vehicule" id="vehicule" required>
                        <option value="" selected disabled><?=  $liste['vehicule']?></option>
                        <?php foreach ($vehicule as $v): ?>
                            <?php if($liste['vehicule'] != $v['numero'])?>
                            <option value="<?= ($v['id_vehicule']) ?>">
                                <?= ($v['numero']) ?>
                            </option>
                            <?php ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="livreur">Livreur :</label>
                    <select name="id_livreur" id="livreur" required>
                        <option value="" selected disabled><?= $liste['livreur'] ?></option>
                        <?php foreach ($livreur as $l): ?>
                            <option value="<?= ($l['id_livreur']) ?>">
                                <?= ($l['prenom']) ?> <?= ($l['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date de livraison :</label>
                    <input type="date" name="date_livraison" id="date" required value="<?= $liste['dates'] ?>">
                </div>

                <div class="form-group full-width">
                    <label for="depart">Adresse de depart :</label>
                    <input type="text" name="adresse_depart" id="depart" placeholder="Entrepot" value="<?= $liste['depart'] ?>"required>
                </div>
                <div class="form-group">
                    <label for="zone">Zone de livraison :</label>
                    <select name="id_zone" id="zone" required>
                        <option value="" selected disabled><?= $liste['zone'] ?></option>
                        <?php foreach ($zone as $z): ?>
                            <option value="<?= ($z['id_zone']) ?>">
                                <?= ($z['nom_zone']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="statut">Statut initial :</label>
                    <select name="id_statut" id="statut" required>
                        <option value="" selected disabled><?= $liste['statut'] ?></option>
                        <?php foreach ($statut as $s): ?>
                            <option value="<?= ($s['id_statut']) ?>">
                                <?= ($s['statut']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="carburant">Cout du vehicule :</label>
                    <input type="number" name="cout_vehicule" id="carburant"
                        placeholder="Ex: 15000" step="0.01" min="0" value="<?= $liste['cout'] ?>"required>
                    <input type="hidden" value="<?= $id ?>" name="id_livraison">
                </div>
            </div>
            <br>
            <br>
            <input type="submit" class="btn-submit" value="Modifier la livraison">
        </form>
    </div>
    <script>
        //code tp9 moa ?
        window.addEventListener("load", function() {
            function sendData() {
                var xhr = new XMLHttpRequest();
                var formData = new FormData(form);
                xhr.addEventListener("load", function(event) {
                    var msg = (event.target.responseText != "") ? event.target.responseText : "Livraison modifier avec succes !";
                    alert(msg);
                });
                xhr.addEventListener("error", function(event) {
                    alert('Oups! Quelque chose s\'est mal passé lors de l\'envoi.');
                });
                xhr.open("POST", "/modifier_livraison",true); 
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
    <?php include('footer.php')?>
</body>

</html>