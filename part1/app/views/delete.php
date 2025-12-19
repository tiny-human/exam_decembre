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
        <span>Supprimer tous les livraisons ? (Etes -vous sur ?)</span>
    </h1>
    <div class="form-card">
        <form  method="post" id="myForm" action="/deleteTOUT">
                <div class="form-group">
                    <label for="code">Code :</label>
                    <input type="text" name="code" id="code">
                </div>
            <br>
            <br>
            <input type="submit" class="btn-submit"  value="supprimer">
        </form>
    </div>
    <?php include('footer.php')?>
</body>
</html>