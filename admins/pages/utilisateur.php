<?php
session_start();
include '/xampp/htdocs/mbole/connexion.php';
include '../includes/header.php';
include '../model/tablehelper.php';


?>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Template</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Template</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <form action="" method="GET">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control" name="nom_user">
            </div>
                </form>
          </div>
          <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <form action="../pages/deconnexion.php" method="POST"> 
                    <button type="submit" class="btn btn-dark btn-user btn-block" name="deconnexion">deconnexion</button>
                            <i class="fa fa-user me-sm-1"></i>
                            </form>
                    </li>                   
                </ul>
        </div>
      </div>
    </nav>

    <!--- titre --------->
    <div class="container-fluid py-4">
<div class="row min-vh-80">
        <div class="col-12">
          <div class="card h-100">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h5 class="text-white text-capitalize ps-3">Air Mbolé</h5>
              </div>
            </div>
            <div class="card-body">
<!-- Modal -->
<div class="modal fade" id="adminprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../control/code_utilisateur.php" method="POST" id="form_utilisateur">
                <div class="modal-body">

                    <div class="form-group">
                        <label>nom utilisateur</label>
                        <input type="text" name="nom_utilisateur" class="form-control" placeholder="entrer nom" id="nom_user">
                        <br>
                        <div>
                            <span id="error_nom"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>age</label>
                        <input type="date" name="age_utilisateur" class="form-control" placeholder="entrer date de naissance" id="date">
                        <br>
                        <div>
                            <span id="error_date"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="email" name="email_utilisateur" class="form-control" placeholder="entrer email" id="mail">
                        <br>
                        <div>
                            <span id="error_email"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>mot de passe</label>
                        <input type="password" name="mdp_utilisateur" class="form-control" placeholder="entrer mot de passe" id="mdp">
                       <br>
                        <div>
                            <span id="spanmdp"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirmer mot de passe</label>
                        <input type="mot de passe" name="confirme_mdp" class="form-control" placeholder="confirmer mot de passe" id="cmdp">
                        <br>
                        <div>
                            <span id="spacnmdp"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                    <button type="imput" class="btn btn-primary" name="enregistrerbtn">enregistrer</button>
                </div>
                <form>
        </div>
    </div>
</div>

<!--------------------------------------------------------------------------->

<div class="container-fluid">
    <!-- Button trigger modal -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">profile administrateur
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adminprofile">
                    cliquez ici pour vous enregistrer
                </button>
            </h6>
        </div>
        <div class="card-body">

            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white">' . $_SESSION['success'] . '</h2>';     //affichage message en cas de reussite
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-danger text-white">' . $_SESSION['status'] . '</h2>';     //affichage message en cas de reussite
                unset($_SESSION['status']);
            }

            ?>


            <div class="table-responsive">

            


                <?php

                        $quer = "SELECT * FROM utilisateur";
                        $querycount = "SELECT COUNT(id) as count utilisateur";
                        $params = [];
                        $sortable = ["id","nom"];

                        if(!empty($_GET['nom_user'])){
                            $nom_user=$_GET['nom_user'];
                            $quer .= " WHERE nom LIKE :nom";
                            $params=['nom'=> '%'.$nom_user.'%'];
                        }
                    
                    //trie par nom
                    if(!empty($_GET['sort']) && in_array($_GET['sort'], $sortable)){
                        $direction = '%' . $_GET['dir'] ?? 'asc';
                        if(!in_array($direction,['asc', 'desc'])){
                            $direction='asc';
                        }
                        $quer .= " ORDER BY " . $_GET['sort'] . " $direction";
                    }



                        try {
                            $query = $pdo->prepare($quer);
                            $query->execute($params);
                            $result = $query->fetchAll();
                        } catch (PDOException $e) {
                            $erreur = $e->getMessage();
                        }

                ?>
                <table class="table table-bordered" id="datatale" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"> ID </th>
                            <th scope="col"><?= Tableheper::sort('nom', 'nom', $_GET) ?></th>
                            <th scope="col"> date de naissance </th>
                            <th scope="col"> email </th>
                            <th scope="col"> EDITER </th>
                            <th scope="col"> SUPPRIMER </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--   affichage des donnée de votre base de donnée -->
                        <?php foreach ($result as $row) : ?>

                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nom'] ?></td>
                                <td><?= $row['age'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td>
                                    <form action="../model/modifier_utilisateur.php" method="POST">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-success" name="edit_btn">MODIFIER</button>
                                </td>
                                </form>
                                <td>
                                    <form action="../control/code_utilisateur.php" method="POST">
                                        <input type="text" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger" name="delete_btn">SUPPRIMER</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<?php
include '../includes/footer.php';
?>