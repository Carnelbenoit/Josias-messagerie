<?php 
   session_start();
   if (isset($_SESSION['unique_id'])){ // if user is logged in
     header("location: users.php");
   }
?>

<?php include_once "header.php";?>

<body>
    <div class="wrapper">
        <section class="form login">
            <header><span style="margin-left: 20px;">Messagerie en temps réel</span></header>
            <form action="#">
                <div class="error-txt"></div>
               
                <div class="field input">
                    <label>Adresse électronique</label>
                    <input type="email" name="email" placeholder="Saisissez votre courriel">
                </div>
                <div class="field input ">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="Entrer votre mot de passe">
                    <i class="fas fa-eye"></i>
                </div>
                
                <div class="field button">
                    <input type="submit" value="Se connecter">
                </div>
            </form>

            <div class="link">Pas encore inscrit ? <a href="index.php">Inscrivez-vous maintenant</a></div>
        </section>
    </div>

    <script  src="Javascript/pass-show-hide.js"></script>
    <script  src="Javascript/login.js"></script>

</body>
</html>