<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation de livraison</title>
</head>
<body>
    <form action="/liste_livraison" method="get">
        <input type="text" name="colis" id="colis" placeholder="id du colis">
        <input type="text" name="vehicule" id="vehicule" placeholder="id du vehicule">
        <input type="date" name="date" id="date" placeholder="date de livraison">
        <input type="text" name="livreur" id="livreur" placeholder="nom du livreur">
        <input type="text" name="depart" id="depart" placeholder="addresse de depart">
        <input type="text" name="zone" id="zone" placeholder="zone de livraison">
        <input type="text" name="statut" id="statut" placeholder="statut de la livraison">
        <input type="text" name="carburant" id="carburant" placeholder="cout du carburant">
        <input type="text" name="salaire" id="salaire" placeholder="salaire du livreur">
        <input type="submit" value="valider">
    </form>
    
</body>
</html>