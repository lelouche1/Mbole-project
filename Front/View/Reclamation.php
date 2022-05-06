<?php

include_once "../Config.php";

function getReclamationPublique(){
    $db = config::getconnexion();

    try {
        $query = $db->query(
            "SELECT * FROM reclamation_publique"
        );
        return $query;

    } catch (PDOException $e) {
        $e->getMessage();
        }
}

function verifierOriginRE($id,$email)
{
	$db = config::getConnexion();
    
    $Query = "SELECT count(*) AS nb FROM reclamation_publique where Id_recla='$id' and email_utilisateur='$email'";
    
    try {
        $res = $db->query($Query);
        $data = $res->fetch();
        $nb = $data['nb'];
        return $nb;
            
    } catch (PDOException $e) {
            $e->getMessage();
    }
}


$reclamationPublique = getReclamationPublique();

$decla = array('Prix','Retard','Mauvais retour','Autres');

if( isset($_POST['decla']) && $_POST['secteur']!='default')
        {
 
            $control = new TypeC();
            
            $declaration = $_POST['decla'];
            
            $newType = new Type($declaration);
            
            $control->addReclamation($newType);
 
        }
//         && $_POST['secteur']!='default'

// $clef = $_POST['decla'];
// $valeur = $decla[$_POST['decla']];
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sergey Pozhilov (GetTemplate.com)">

    <title>Reclamation - Air Mbole</title>

    <link rel="shortcut icon" href="assets/images/gt_favicon.png">

    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top headroom">
        <div class="container">
            <div class="navbar-header">
                <!-- Button for smallest screens -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="index.html"><img src="assets/images/logo.png"
                        alt="Progressus HTML5 template"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a href="">Vols</a></li>
                    <!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">More Pages <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="sidebar-left.html">Left Sidebar</a></li>
							<li class="active"><a href="sidebar-right.html">Right Sidebar</a></li>
						</ul>
					</li> -->
                    <li><a href="Reclamation.php">Reclamation</a></li>
                    <li><a class="btn" href="signin.html">SIGN IN / SIGN UP</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    <!-- /.navbar -->

    <header id="head" class="secondary"></header>

    <!-- container -->
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Reclamations</li>
        </ol>

        <div class="row">

            <!-- Article main content -->
            <article class="col-sm-9 maincontent">
                <header class="page-header">
                    <h1 class="page-title">Exprimez Vous</h1>
                </header>

                <!-- <p>
					We’d love to hear from you. Interested in working together? Fill out the form below with some info about your project and I will get back to you as soon as I can. Please allow a couple days for me to respond.
				</p> -->
                <br>
                <form action="../Controller/ajouterReclamation.php" method="post" id="form_cnt">
                    <div class="row">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea placeholder="Saisissez votre reclamation ici..." class="form-control" rows="9"
                                name="contenu" id="contenu" minlength="2" maxlength="300"></textarea>
                            <span id="erre"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="decla"> Type: </label>
                            <!-- <select name="decla" >
                                <option value="Prix"> Prix </option>
                                <option value="Retard"> Retard </option>
                                <option value="mr"> Mauvais retour </option>
                                <option value="Autres"> Autres </option>
                            </select> -->

                            <select name="decla">
                                <?php
                                    foreach($decla as $key => $decla):
                                        echo'<option value="'.$key.'">'.$decla.'</option>';
                                    endforeach;
                                ?>
                            </select>

                            <label class="checkbox"><input type="checkbox" name="prive"> Reclamation privée</label>
                        </div>
                        <div class="col-sm-6 text-right">
                            <input class="btn btn-action" type="submit" value="Envoyer">
                        </div>
                    </div>
                </form>

            </article>
            <!-- /Article -->

            <!-- Sidebar -->
            <aside class="col-sm-3 sidebar sidebar-right">

                <!--<div class="widget">
					<h4>Address</h4>
					<address>
						2002 Holcombe Boulevard, Houston, TX 77030, USA
					</address>
					<h4>Phone:</h4>
					<address>
						(713) 791-1414
					</address>
				</div>-->

            </aside>
            <!-- /Sidebar -->

        </div>

        <div class="row">

            <section class="container-full top-space">
                <h4>Vos Reclamations</h4>
                <br>
                <?php foreach($reclamationPublique as $reclamation){ ?>
                <div class="widget">

                    <ul class="list-unstyled list-spaces">
                        <li style="border-bottom: 1px #eee solid;">
                            <a><?php echo $reclamation['email_utilisateur']?></a>
                            <span class="small text-muted"><?php echo $reclamation['Date']?></span>
                            <a style="color:black;" id="modifier"
                                href="modifier.php?id=<?php echo $reclamation['Id_recla'] ?>"><i class="fa fa-pencil"
                                    style="margin-left:5rem;"></i></a> <a
                                href="../Controller/supprimerReclamation.php?id=<?php echo $reclamation['Id_recla'] ?>"
                                style="color:black;"><i class="fa fa-trash-o" style="margin-left:1rem;"></i></a>
                            <br>
                            <p>
                            <h4 id="contenu"><?php echo $reclamation['Contenu']?></h4>
                            </p>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </section>
        </div>
    </div> <!-- /container -->



    <footer id="footer">

        <div class="footer1">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 widget">
                        <h3 class="widget-title">Contact</h3>
                        <div class="widget-body">
                            <p>+234 23 9873237<br>
                                <a href="mailto:#">some.email@somewhere.com</a><br>
                                <br>
                                234 Hidden Pond Road, Ashland City, TN 37015
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3 widget">
                        <h3 class="widget-title">Follow me</h3>
                        <div class="widget-body">
                            <p class="follow-me-icons clearfix">
                                <a href=""><i class="fa fa-twitter fa-2"></i></a>
                                <a href=""><i class="fa fa-dribbble fa-2"></i></a>
                                <a href=""><i class="fa fa-github fa-2"></i></a>
                                <a href=""><i class="fa fa-facebook fa-2"></i></a>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 widget">
                        <h3 class="widget-title">Text widget</h3>
                        <div class="widget-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, dolores, quibusdam
                                architecto voluptatem amet fugiat nesciunt placeat provident cumque accusamus itaque
                                voluptate modi quidem dolore optio velit hic iusto vero praesentium repellat commodi ad
                                id expedita cupiditate repellendus possimus unde?</p>
                            <p>Eius consequatur nihil quibusdam! Laborum, rerum, quis, inventore ipsa autem repellat
                                provident assumenda labore soluta minima alias temporibus facere distinctio quas
                                adipisci nam sunt explicabo officia tenetur at ea quos doloribus dolorum voluptate
                                reprehenderit architecto sint libero illo et hic.</p>
                        </div>
                    </div>

                </div> <!-- /row of widgets -->
            </div>
        </div>

        <div class="footer2">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="simplenav">
                                <<a href="#">Home</a> |
                                    <a href="about.html">Vols</a> |
                                    <!--<a href="sidebar-right.html">Sidebar</a> |-->
                                    <a href="Reclamation.php">Reclamation</a> |
                                    <b><a href="signup.html">Sign up</a></b>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="text-right">
                                Copyright &copy; 2014, Your name. Designed by <a href="http://gettemplate.com/"
                                    rel="designer">gettemplate</a>
                            </p>
                        </div>
                    </div>

                </div> <!-- /row of widgets -->
            </div>
        </div>
    </footer>



    <script>
    modifier = document.getElementById('modifier');
    modifier.addEventListener('click', () => {

        zoneSaisie = document.getElementById('contenu');
        zoneSaisie.value = "<?php echo $reclamation['Contenu']?>";
    });
    </script>

    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/headroom.min.js"></script>
    <script src="assets/js/jQuery.headroom.min.js"></script>
    <script src="assets/js/template.js"></script>

    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=&amp;sensor=false&amp;extension=.js"></script>
    <script src="assets/js/google-map.js"></script>

    <!-- Controle de saisi reclamation -->
    <script src="assets/js/ControlRecla.js"></script>


</body>

</html>