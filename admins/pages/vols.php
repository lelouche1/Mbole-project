<?php
session_start();
include '/xampp/htdocs/mbole/connexion.php';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<!-- Modal -->
<div class="modal fade" id="adminprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestion des vols</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../control/code_vols.php" method="POST" id="form_vol">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nom Compagnie</label>
                        <input type="text" name="compagnie" class="form-control" placeholder="entrer nom compagnie..." id="comp">
                        <br>
                        <div>
                            <span id="error_comp"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date de départ</label>
                        <input type="date" name="date_d" class="form-control" placeholder="saisir une date de l'année en cours..." id="datev">
                        <br>
                        <div>
                            <span id="error_dat"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>pays de départ</label>
                        <input type="text" name="pays_d" class="form-control" placeholder="entrer le pays de depart..." id="payde">
                        <br>
                        <div>
                            <span id="error_dep"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>pays d'arrivée</label>
                        <input type="text" name="pays_a" class="form-control" placeholder="entrer le pays d'arrivée..." id="lieud">
                        <br>
                        <div>
                            <span id="error_lieud"></span>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label>Prix en Dinar</label>
                        <input type="number" name="prix" class="form-control" placeholder="Prix..." id="prix">
                        <br>
                        <div>
                            <span id="error_lieua"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                    <button type="submit" class="btn btn-primary" name="enregistrerbtn">enregistrer</button>
                </div>
            <form>
        </div>
    </div>
</div>

<!------------------------------------------------------>

<div class="container-fluid">
    <!-- Button trigger modal -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Information Vols
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adminprofile">
                    Cliquez ici pour vous Ajouter un nouveaux vol
                </button>
                <a href="imprimer_vols.php" class="btn btn-success"> imprimer les vols
                </a>
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

                try {
                    $query = $pdo->prepare("SELECT * FROM vols");
                    $query->execute();
                    $result = $query->fetchAll();
                } catch (PDOException $e) {
                    $erreur = $e->getMessage();
                }

                ?>
                <table class="table table-bordered" id="datatale" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"> id </th>
                            <th scope="col"> Compagnie </th>
                            <th scope="col"> Date de départ </th>
                            <th scope="col"> Pays de départ </th>
                            <th scope="col"> Pays d'arrivée </th>
                            <th scope="col"> Prix </th>
                            <th scope="col"> EDITER </th>
                            <th scope="col " width="10"> SUPPRIMER </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--   affichage des donnée de votre base de donnée -->
                        <?php foreach ($result as $row) : ?>

                            <tr>
                                <td><?= $row['id_vol'] ?></td>
                                <td><?= $row['compagnie'] ?></td>
                                <td><?= $row['date_depart'] ?></td>
                                <td><?= $row['lieu_depart'] ?></td>
                                <td><?= $row['lieu_arrivee'] ?></td>
                                <td><?= $row['prix'] ?></td>
                                <td>
                                    <form action="../model/modifier_vols.php" method="POST">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id_vol']; ?>">
                                    <button type="submit" class="btn btn-success" name="edit_btn">MODIFIER</button>
                                    </form>
                                </td>
                                
                                <td>
                                    <form action="../control/code_vols.php" method="POST">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id_vol']; ?>">
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