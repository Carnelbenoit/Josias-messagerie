<?php 
   session_start();
   if (isset($_SESSION['unique_id'])){ // if user is logged in
     header("location: users.php");
   }
?>

<?php include_once "header.php";?>


<body>
    <div class="wrapper">
        <section class="form signup">
            <header><span style="margin-left: 20px;">Messagerie en temps réel</span></header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>Premier nom</label>
                        <input type="text" name="fname" placeholder="Premier nom" required>
                    </div>
                    <div class="field input">
                        <label>Nom de famille</label>
                        <input type="text" name="lname" placeholder="Nom de famille" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Adresse électronique</label>
                    <input type="email" name="email" placeholder="Saisissez votre courriel" required>
                </div>
                <div class="field input ">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="Entrer un nouveau mot de passe" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Sélection d'image de profil</label><br>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="S'inscrire">
                </div>
            </form>

            <div class="link">Déjà inscrite ? <a href="login.php">Connectez-vous maintenant</a></div>
        </section>
    </div>

    <script  src="Javascript/pass-show-hide.js"></script>
    <script  src="Javascript/signup.js"></script>
</body>
</html>