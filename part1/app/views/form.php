<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation de livraison</title>
</head>
<body>
    <h1>Création d'une nouvelle livraison</h1>
    
    <form action="/insert_livarison" method="post">
        <div>
            <label for="colis">Colis:</label>
            <select name="id_colis" id="colis" required>
                <option value="">-- Sélectionnez un colis --</option>
                <?php foreach ($colis as $c): ?>
                <option value="<?= htmlspecialchars($c['id_colis']) ?>">
                    <?= htmlspecialchars($c['nom']) ?> (<?= htmlspecialchars($c['poids']) ?> kg)
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="vehicule">Véhicule:</label>
            <select name="id_vehicule" id="vehicule" required>
                <option value="">-- Sélectionnez un véhicule --</option>
                <?php foreach ($vehicule as $v): ?>
                <option value="<?= htmlspecialchars($v['id_vehicule']) ?>">
                    <?= htmlspecialchars($v['numero']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="date">Date de livraison:</label>
            <input type="date" name="date_livraison" id="date" required>
        </div>

        <div>
            <label for="livreur">Livreur:</label>
            <select name="id_livreur" id="livreur" required>
                <option value="">-- Sélectionnez un livreur --</option>
                <?php foreach ($livreur as $l): ?>
                <option value="<?= htmlspecialchars($l['id_livreur']) ?>">
                    <?= htmlspecialchars($l['prenom']) ?> <?= htmlspecialchars($l['nom']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="depart">Adresse de départ:</label>
            <input type="text" name="adresse_depart" id="depart" placeholder="Entrepot central" required>
        </div>

        <div>
            <label for="zone">Zone de livraison:</label>
            <select name="id_zone" id="zone" required>
                <option value="">-- Sélectionnez une zone --</option>
                <?php foreach ($zone as $z): ?>
                <option value="<?= htmlspecialchars($z['id_zone']) ?>">
                    <?= htmlspecialchars($z['nom_zone']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="statut">Statut:</label>
            <select name="id_statut" id="statut" required>
                <option value="">-- Sélectionnez un statut --</option>
                <?php foreach ($statut as $s): ?>
                <option value="<?= htmlspecialchars($s['id_statut']) ?>">
                    <?= htmlspecialchars($s['statut']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="carburant">Coût du véhicule (MGA):</label>
            <input type="number" name="cout_vehicule" id="carburant" 
                   placeholder="15000" step="0.01" min="0" required>
        </div>

        <input type="submit" value="Créer la livraison">
    </form>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        select, input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</body>
</html>