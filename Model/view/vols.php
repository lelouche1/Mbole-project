<?php
session_start();
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
}
include '/xampp/htdocs/mbole/connexion.php';
include 'tablehelper.php';

$quer = "SELECT * FROM vols";
$querycount = "SELECT COUNT(id_vol) as count FROM vols";
$params = [];
$sortable = ["id","lieu_depart","prix"];

if(!empty($_GET['lieud'])){
	$lieud=$_GET['lieud'];
	$lieua=$_GET['lieua'];
	$quer .= " WHERE lieu_depart LIKE :lieudep";
	$params=['lieudep'=> '%'.$lieud.'%'];
}

// organisation 
if(!empty($_GET['sort']) && in_array($_GET['sort'], $sortable)){
	$direction = '%' . $_GET['dir'] ?? 'asc';
	if(!in_array($direction,['asc', 'desc'])){
		$direction='asc';
	}
	$quer .= " ORDER BY " . $_GET['sort'] . " $direction";
}

try {
$etat= $pdo->prepare($quer);
$etat->execute($params);
$result = $etat->fetchAll();

} catch (PDOException $e) {
$erreur = $e->getMessage();
echo $erreur;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Sergey Pozhilov (GetTemplate.com)">

	<title>Progressus - Free business bootstrap template by GetTemplate</title>

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

<body class="home">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li ><a class="btn" href="index.php">Accueil</a></li>
					<li class="active"><a class="btn" href="">Vols</a></li>
					<li><a class="btn" href="Reclamation.php">Reclamation</a></li>
					<?php if(isset($user)): ?>
						
						<li><button class="btn btn-primary"><?= $user ?></button></li>
						<form action="deconnexion.php" method="POST">
						<li><button class="submit" name="btn_deconect">déconnexion</button></li>
						</form>
						
					<?php endif ?>
					<?php if(empty($user)): ?>
					<li><a class="btn" href="login.php">Connexion / Enregistrement</a></li>
					<?php endif ?>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<!-- Header -->
	<header id="head">
		<div class="container">
			<div class="row">
				<h1 class="lead">SOYEZ LIBRE !</h1>
				<div class="col-col">
					<form method="GET" action="" id="form_vol">
						<div class="row">
							<div class="col-md-4">
								<label class="form-label">Pays départ</label>
								<input id="nom" class="form-control" type="text" name="lieud" placeholder="Entrer votre nom" id="ld">
								<br>
								<div>
									<span id="error_dep"></span>
								</div>
							</div>
							<div class="col-md-4">
								<label class="form-label">Pays arrivée</label>
								<input id="prenom" class="form-control" type="text" name="lieua" placeholder="Entrer votre prénom" id="la">
								<br>
								<div>
									<span id="error_lieud"></span>
								</div> 
							</div>

							<div class="col-md-4">
								<label class="form-label">Date de départ</label>
								<input class="form-control" type="date" name="date" placeholder="Date de départ">
							    <br>
								<div>
									<span id="error_dat"></span>
								</div>
								
						</div>

						<div class="row">
	  						<div class="col-md-6">
								
									<input type="radio" class="form-check-input" id="radio1" name="radiobouton">
									<label class="custom-control-label" for="radio1">Aller-Simple</label>

									<input type="radio" class="form-check-input" id="radio2" name="radiobouton">
									<label class="custom-control-label" for="radio2">Aller-Retour</label>
								
							    </div>
						</div>

						<button class="btn btn-success" name="">chercher</button>
					</form>
				</div>
			</div>
		</div>
	</header>
	<!-- /Header -->

	<!-- Intro -->
	<div class="container text-center">

		<br> <br>
		<h2 class="thin">LISTE DES VOLS</h2>
		<div class="row g-3 align-items-center">
		
		<?php if(isset($result) && empty($result)) : ?>
			<h4 class="thin">PAS DE VOLS DISPONIBLES</h4>
		<?php endif ?>
		<?php if(isset($result) && !empty($result)) : ?>
		<div class="table-responsive">
                <table class="table table-bordered" id="datatale" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"><?= Tableheper::sort('lieu_depart', 'Pays de départ', $_GET) ?></th>
                            <th scope="col"> Pays d'arrivée </th>
                            <th scope="col"> Date départ </th>
                            <th scope="col"> Compagnie </th>
                            <th scope="col"><?= Tableheper::sort('prix', 'Prix', $_GET) ?> </th>
                            <th scope="col"> Réserver </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--   affichage des donnée de votre base de donnée -->
                        <?php foreach ($result as $row) : ?>

                            <tr>
                                <td><?= $row['lieu_depart'] ?></td>
                                <td><?= $row['lieu_arrivee'] ?></td>
                                <td><?= $row['date_depart'] ?></td>
								<td><?= $row['compagnie'] ?></td>
								<td><?= $row['prix'] ?></td>
                                <td>
                                    <form action="../View/reserver.php" method="POST">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id_vol']; ?>">
                                        <button type="submit" class="btn btn-success" name="edit_btn">RESERVER</button>
                                </td>
                                </form>
                           
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
			<?php endif ?>
		</div>
	</div>
	<!-- /Intro-->
	<div class="jumbotron top-space">
		<div class="container">
			
			<h3 class="text-center thin">Les raisons de choisir Air Mbolé</h3>
			
			<div class="row">
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-cogs fa-5"></i>Navigation facile</h4></div>
					<div class="h-body text-center">
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque aliquid adipisci aspernatur. Soluta quisquam dignissimos earum quasi voluptate. Amet, dignissimos, tenetur vitae dolor quam iusto assumenda hic reprehenderit?</p>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-flash fa-5"></i>Rapide</h4></div>
					<div class="h-body text-center">
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, commodi, sequi quis ad fugit omnis cumque a libero error nesciunt molestiae repellat quos perferendis numquam quibusdam rerum repellendus laboriosam reprehenderit! </p>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-heart fa-5"></i>liste de vols à jours</h4></div>
					<div class="h-body text-center">
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, vitae, perferendis, perspiciatis nobis voluptate quod illum soluta minima ipsam ratione quia numquam eveniet eum reprehenderit dolorem dicta nesciunt corporis?</p>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-6 highlight">
					<div class="h-caption"><h4><i class="fa fa-smile-o fa-5"></i>En savoir plus sur nous</h4></div>
					<div class="h-body text-center">
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, excepturi, maiores, dolorem quasi reprehenderit illo accusamus nulla minima repudiandae quas ducimus reiciendis odio sequi atque temporibus facere corporis eos expedita? </p>-->
					</div>
				</div>
			</div> <!-- /row  -->
		
		</div>
	</div>
	<!-- /Highlights -->

	<!-- container -->
	

	<!-- Social links. @TODO: replace by link/instructions in template -->
	<section id="social">
		<div class="container">
			<div class="wrapper clearfix">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_button_linkedin_counter"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				</div>
				<!-- AddThis Button END -->
			</div>
		</div>
	</section>
	<!-- /social links -->


	<footer id="footer" class="top-space">

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
							<p class="follow-me-icons">
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
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, dolores, quibusdam architecto voluptatem amet fugiat nesciunt placeat provident cumque accusamus itaque voluptate modi quidem dolore optio velit hic iusto vero praesentium repellat commodi ad id expedita cupiditate repellendus possimus unde?</p>
							<p>Eius consequatur nihil quibusdam! Laborum, rerum, quis, inventore ipsa autem repellat provident assumenda labore soluta minima alias temporibus facere distinctio quas adipisci nam sunt explicabo officia tenetur at ea quos doloribus dolorum voluptate reprehenderit architecto sint libero illo et hic.</p>
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
								<a href="#">Home</a> |
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
								Copyright &copy; 2014, Your name. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a>
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

	</footer>





	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
	<script src="assets/js/control_vol.js"></script>
</body>

</html>