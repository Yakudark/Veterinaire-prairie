<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=veterinaire', 'root', '');

if (isset($_GET['id']) and $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <title>Page Propriétaire</title>
    </head>

    <body>

        <section class="sub-header-page-proprietaire">
            <nav>
                <a class="header-logo" href="index.html"><img src="./assets/Logo_veto.png" alt="logo"></a>
                <div class="nav-links" id="navLinks">
                    <i class="fa fa-times" onclick="hideMenu()"></i>
                    <ul>
                        <li><a href="index.html">Accueil</a></li>
                        <li><a href="">Vétérinaire</a></li>
                        <li><a href="">Propriétaire d'animaux</a></li>
                        <li><a href="">Urgences</a></li>
                        <li><a href="contact.html">Nous contacter</a></li>
                        <li><a href="espace-veterinaire.html">Mon espace vétérinaire</a></li>
                    </ul>
                </div>
                <i class="fa fa-bars" onclick="showMenu()"></i>
                <div class="profil-utilisateur">
                    <h2>Profil de <?php echo $userinfo['nom']; ?></h2>
                    <p>Nom = <?php echo $userinfo['nom']; ?></p>
                    <p>Mail = <?php echo $userinfo['mail']; ?></p>
                    <?php
                    if (isset($_SESSION['id']) and $userinfo['id'] == $_SESSION['id']) {
                    ?>
                        <a href="">Editer mon profil</a>
                        <a href="deconnexion.php">Se déconnecter</a>
                    <?php
                    }
                    ?>
            </nav>

            <!-----------inscription-->

            <section class="animal-container">
                <form name="animal-profil" method=" POST">
                    <div class="wrapper">
                        <div class="title">
                            Enregistrer un animal
                        </div>
                        <div class="form">
                            <div class="inputfield">
                                <label>Nom</label>
                                <input type="text" class="input" name="Nom" placeholder="Le nom de votre animal">
                            </div>
                            <div class="inputfield">
                                <label>Type</label>
                                <input name="Type" type="text" class="input" placeholder="Le type (chat, chien...)">
                            </div>
                            <div class="inputfield">
                                <label>Race</label>
                                <input name="Type" type="text" class="input" placeholder="Sa race">
                            </div>

                            <div class="inputfield">
                                <label>Genre</label>
                                <div class="custom-select">
                                    <select name="Genre">
                                        <option value="">Sélectionnez</option>
                                        <option value="male">Mâle</option>
                                        <option value="female">Femelle</option>
                                    </select>
                                </div>
                            </div>
                            <div class="inputfield">
                                <label>Naissance</label>
                                <input name="Naissance" type="text" class="input" placeholder="Sa date de naissance">
                            </div>
                            <div class="inputfield">
                                <button class="btn" id="validinscription" type="submit" name="envoyer">Enregistrer</button>

                            </div>
                        </div>
                    </div>
                </form>
                <form name="coordonnées" method="POST">
                    <div class="wrapper">
                        <div class="title">
                            Enregistrer vos coordonnées
                        </div>
                        <div class="form">
                            <div class="nom-utilisateur">
                                <?php echo $userinfo['nom']; ?>
                            </div>
                            <div class="inputfield">
                                <label>Prénom</label>
                                <input name="prenom" type="text" class="input" placeholder="Prénom">
                            </div>
                            <div class="inputfield">
                                <label>Naissance</label>
                                <input name="Naissance" type="text" class="input" placeholder="Date de naissance">
                            </div>
                            <div class="inputfield">
                                <label>Adresse</label>
                                <input name="adresse" type="text" class="input" placeholder="Adresse">
                            </div>
                            <div class="inputfield">
                                <label>Téléphone</label>
                                <input name="telephone" type="text" class="input" placeholder="Téléphone">
                            </div>

                            <div class="inputfield">
                                <button class="btn" id="validinscription" type="submit" name="envoyer">Enregistrer</button>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="dossier-container">
                    <p>Le dossier médicale de votre animal</p>
                    <div class="choix-container">
                        <div class="choix-nom">
                            <select name="choix-animal" id="choix-animal">
                                <option value="Sélectionner"></option>
                                <!---En fonction de la BDD du proprio-->
                                <option value="chat">chat</option>
                                <option value="Chien">Chien</option>
                                <option value="perroquet">perroquet</option>
                            </select>
                            <input type="button" value="Valider le choix" id="btn-choice">
                        </div>
                        <div id="affichage-nom">
                            <p id="text-choice"></p>
                        </div>
                    </div>
                </div>

            </section>
            <table class="table-recap">
                <caption>Carnet de santé</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Type</th>
                        <th scope="col">Race</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Naissance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Wouffy</td>
                        <td>Chien</td>
                        <td>Malinois</td>
                        <td>Mâle</td>
                        <td>01/02/2020</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Remarque</td>
                        <td colspan="5"></td>
                    </tr>
                </tfoot>
            </table>

            <table class="table-recap">
                <caption>Suivi médical</caption>
                <thead>
                    <tr>
                        <th scope="col">Date d'intervention</th>
                        <th scope="col">Raison</th>
                        <th scope="col">Médicament</th>
                        <th scope="col">dosage</th>
                        <th scope="col">posologie</th>
                        <th scope="col">indication</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">23/12/2021</th>
                        <td>Hernie</td>
                        <td>Douliproune</td>
                        <td>100g</td>
                        <td>3x/jour</td>
                        <td>Ne pas dépasser 7jours</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Remarque</td>
                        <td colspan="5"></td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <div class="footer-inscription">
            <h4>About Us</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.<br> Iusto enim unde similique ipsum ducimus.
                Alias
                quis
                pariatur mollitia? Odio, cum.</p>
            <div class="icons">
                <a href="https://fr-fr.facebook.com"><i class="fa-brands fa-facebook"></i></a>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin"></i>
            </div>
        </div>
        <script src="./script.js"></script>

        </div>
    </body>

    </html>
<?php
}
?>