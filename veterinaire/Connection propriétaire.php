<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=veterinaire', 'root', '');

if (isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if (!empty($mailconnect) and !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if ($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['nom'] = $userinfo['nom'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: Page Propriétaire.php?id=" . $_SESSION['id']);
        } else {
            $erreur = "Mauvais mail ou mot de passe !";
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
    <title>Connexion propriétaire</title>
</head>

<body>
    <section class="sub-header-connection">
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



        <!-------------connection------------------>
        <section class="connection-container">
            <form method="POST">
                <h1>Se connecter avec</h1>
                <div class="social-media">
                    <p i class="fa-brands fa-facebook"></i></p>
                    <p i class="fa-brands fa-twitter"></i></p>
                    <p i class="fa-brands fa-youtube"></i></p>
                    <p i class="fa-brands fa-google"></i></p>
                </div>
                <p class="choose-email">ou utiliser mon adresse mail :</p>

                <div class="inputs">
                    <input type="email" placeholder="Email" name="mailconnect" />
                    <input type="password" placeholder="Mot de passe" name="mdpconnect" />
                    <input type="submit" name="formconnexion" class="team-btn" value="Se connecter !" />
                </div>

                <p class="new-inscription">Je n'ai pas de <span>compte</span>, je m'en <span>crée</span> un.</p>

            </form>
            <?php
            if (isset($erreur)) {
                echo '<font color="red">' . $erreur . "</font>";
            }
            ?>
        </section>



        <div class="footer">
            <h4>About Us</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.<br> Iusto enim unde similique ipsum ducimus.
                Alias
                quis
                pariatur mollitia? Odio, cum.</p>
            <div class="icons">
                <a href="https://fr-fr.facebook.com"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://twitter.com"><i class="fa-brands fa-twitter"></i></a>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin"></i>
            </div>
        </div>
        <script src="./script.js"></script>
</body>

</html>