<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <?php include('header.php')?>
        <h1 class="title-container">
        <span>Modifier une zone</span>
    </h1>
    <div class="form-card">
        <form  method="post" id="myForm">
                <div class="form-group">
                    <label for="nom_zone">Zone :</label>
                    <input type="text" name="nom" id="nom_zone" value="<?= $zone['nom_zone'] ?>">
                </div>
                <div class="form-group">
                    <label for="pourcentage">pourcentage :</label>
                    <input type="text" name="pourcentage" id="pourcentage" value="<?= $zone['pourcentage'] ?>">
                    <input type="hidden" name="id_zone" value="<?= $id ?>">
                </div>
            <br>
            <br>
            <input type="submit" class="btn-submit" value="Confirmer la modification">
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
                xhr.open("POST", "/modifier_zone",true); 
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
        <a href="/zone" class="btn-back">← Revenir en arriere</a>
    </div>
    <?php include ('footer.php')?>
</body>
</html>