<?php
    include_once '../Model/billet.php';
    include_once '../Controller/billetC.php';

    $error = "";

    // create billet
    $billet = null;
	$error= "";

    // create an instance of the controller
    $billetC = new billetC();
    if (
       
        isset($_POST["nom_client"]) &&
		isset($_POST["date"]) &&		
        isset($_POST["prix"]) &&
        isset($_POST["ville_depart"]) && 
        isset($_POST["ville_arrivee"])&&
        isset($_POST["numero_vol"])

    ) {
        if (
             
            !empty($_POST["nom_client"]) && 
			!empty($_POST['date']) &&
            !empty($_POST["prix"]) && 
			!empty($_POST["ville_depart"]) && 
          
            !empty($_POST["ville_arrivee"])&&
            !empty($_POST["numero_vol"])

        ) {
			if(preg_match("#[0-9]+#",$_POST["nom_client"])){
            $error .=  "Nom client ne doit pas avoir des lettres !<br>";
        }
		if ($error !=""){
        echo "<script>alert('ERROR :  ".$error."');</script>";
    }
		else{
			
            $billet= new billet(
               
                $_POST['nom_client'],
				$_POST['date'],
                $_POST['prix'], 
				$_POST['ville_depart'],
                
                $_POST['ville_arrivee'],
                $_POST['numero_vol'],

            );
            $billetC->ajouterbillet($billet);
            var_dump($billet);
            header('Location:afficherbillet.php');
        }}
    
        else
            $error = "Missing information";
            echo $error;
    }
    var_dump($_POST);
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>
    <body>
        <button><a href="afficherbillet.php">Retour à la liste des reclamation</a></button>
        <hr>
        
        <div id="error">
            <?php echo $error; ?>
        </div>
        <h1>Ajouter une billet</h1>
        <form action="" method="POST">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="nom_client">nom_client:
                        </label>
                    </td>
                    <td><input type="text" name="nom_client" id="nom_client" maxlength="20"></td>
                </tr>
				<tr>
                    <td>
                        <label for="date">date:
                        </label>
                    </td>
                    <td><input type="date" name="date" ></td>
                </tr>
                <tr>
                    <td>
                        <label for="prix">prix:
                        </label>
                    </td>
                    <td><input type="number" name="prix" ></td>
                </tr>
                <tr>
                    <td>
                        <label for="ville_depart">ville_depart:
                        </label>
                    </td>
                    <td>
                        <input type="text" name="ville_depart" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="ville_arrivee">ville_arrivee:
                        </label>
                    </td>
                    <td>
                        <input type="text" name="ville_arrivee" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="numero_vol">numero_vol :
                        </label>
                    </td>
                    <td>
                        <input type="number" name="numero_vol" >
                    </td>
                </tr>
                 
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Envoyer"> 
                    </td>
                    <td>
                        <input type="reset" value="Annuler" >
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

		 