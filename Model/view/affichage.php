<?php 
include '/xampp/htdocs/mbole/connexion.php';
require '../Model/utilisateur.php';
?>
<?php 

$query = $pdo->prepare("SELECT * FROM utilisateur");  

$query->execute(); 

$spost = $query->fetchAll();

?>
<?php require 'head.php'; ?>
<h1>contenu base de donnee utilisateur</h1>


<hr>
<table>
    <tr>
        <th>identifiant</th>
        <th>nom</th>
        <th>date naissance</th>
        <th>email</th>
        <th>cathegorie</th>
    </tr>
    <button type="submit">afficher contenue</button>
    <?php foreach($spost as $pos): ;?>
    <tr>        
        <td><?= $pos['id'] ?></td>
        <td><?= $pos['nom'] ?></td>
        <td><?= $pos['age'] ?></td>
        <td><?= $pos['email_user'] ?></td>
        <td><?= $pos['cathegorie'] ?></td>
    </tr>
    <?php endforeach ?>
</table>


<? require 'foot.php'; ?>