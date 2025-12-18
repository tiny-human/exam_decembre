<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>id_livraison</td>
            <td>cout revient</td>
        </tr>
   
    <?php foreach ($data as $d) { ?>
        <tr>
            <td><?=  $d['id_livraison'] ?></td>
            <td><?= $d['cout_revient'] ?></td>
        </tr>

    <?php } ?>
     </table>
    
</body>
</html>