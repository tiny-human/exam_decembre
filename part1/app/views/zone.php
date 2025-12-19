<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <?php include('header.php') ?>
    <h1 class="title-container">
        <span>Gerer les zones</span>
    </h1>
    <table>
        <thead>
            <tr>
                <th>id_zone</th>
                <th>nom de la zone</th>
                <th>pourcentage</th>
                <th>statut</th>
                <th>Modifier</th>
                <th>supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($zone as $z) { ?>
                <tr>
                    <td><?= $z['id_zone'] ?></td>
                    <td><?= $z['nom_zone'] ?></td>
                    <td><?= $z['pourcentage'] ?></td>
                    <td><?= $z['id_statut_zone'] == 1 ? "disponible" : "supprime" ?></td>
                    <td> <a href="/form_zone/<?= $z['id_zone'] ?>" class="btn-submit" style="background-color: green; text-decoration: none;">
                            Modifier
                        </a></td>
                    <td>
                        <button class="btn-submit btn-delete"
                            data-id="<?= $z['id_zone'] ?>"
                            style="background-color:red;">
                            Supprimer
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.onclick = function() {
                if (!confirm("Supprimer ?")) return;
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "/supprimer_zone");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.responseText === "OK") {
                        btn.closest("tr").remove();
                    }
                };
                xhr.send("id_zone=" + btn.dataset.id);
            };
        });
    </script>


    <br>
    <br>
    <a href="/form_ajout_zone"><button class="btn-insert">Inserer une zone</button></a>
    <?php include('footer.php') ?>
</body>

</html>