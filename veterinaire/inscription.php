<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=veterinaire', 'root', '');

if (isset($_POST['forminscription'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    if (!empty($_POST['nom']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) {
        $nomlength = strlen($nom);
        if ($nomlength <= 255) {
            if ($mail == $mail2) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                        if ($mdp == $mdp2) {
                            $insertmbr = $bdd->prepare("INSERT INTO membres(nom, mail, motdepasse) VALUES(?, ?, ?)");
                            $insertmbr->execute(array($nom, $mail, $mdp));
                            $erreur = "Votre compte a bien été créé ! <a href=\"espace-veterinaire.html\">Me connecter</a>";
                        } else {
                            $erreur = "Vos mots de passes ne correspondent pas !";
                        }
                    } else {
                        $erreur = "Adresse mail déjà utilisée !";
                    }
                } else {
                    $erreur = "Votre adresse mail n'est pas valide !";
                }
            } else {
                $erreur = "Vos adresses mail ne correspondent pas !";
            }
        } else {
            $erreur = "Votre nom ne doit pas dépasser 255 caractères !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Inscription</title>
</head>

<body>
    <section class="sub-header-inscription">
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
        </nav>

        <!-----------inscription-->

        <section class="inscription-container">
            <form name="RegForm" class="W3docs" method="POST">
                <div class="wrapper">
                    <div class="title">
                        Inscription
                    </div>
                    <div align="center">
                        <h2>Inscription</h2>
                        <br /><br />
                        <form method="POST" action="">
                            <table>
                                <tr>
                                    <td align="right">
                                        <label for="nom">Nom :</label>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if (isset($nom)) {
                                                                                                                    echo $nom;
                                                                                                                } ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <label for="mail">Mail :</label>
                                    </td>
                                    <td>
                                        <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) {
                                                                                                                        echo $mail;
                                                                                                                    } ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <label for="mail2">Confirmation du mail :</label>
                                    </td>
                                    <td>
                                        <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if (isset($mail2)) {
                                                                                                                                    echo $mail2;
                                                                                                                                } ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <label for="mdp">Mot de passe :</label>
                                    </td>
                                    <td>
                                        <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <label for="mdp2">Confirmation du mot de passe :</label>
                                    </td>
                                    <td>
                                        <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="center">
                                        <br />
                                        <input type="submit" name="forminscription" value="Je m'inscris" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        if (isset($erreur)) {
                            echo '<font color="red">' . $erreur . "</font>";
                        }
                        ?>
                    </div>
                </div>
            </form>
        </section>

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
</body>

</html>