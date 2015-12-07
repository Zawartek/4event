<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">
    </head>

    <body>
        <div class="connexion" style="margin-top: 5%">
            <div style="background-color: white; height: 40px; width: 98px; border-radius: 10px;">
                <img src="./Vue/img/logo.png" height="40px">
            </div>

            <form method="post" action="inscriptionControler.php">
                <h2 style="margin-top: 10px;" class="text-orange bold">Connexion</h2>
                
                <label for="email">Se connecter avec Facebook</label>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/facebook.png" alt="facebook"></a><br>
                <label for="email">Se connecter avec Twitter</label>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/twitter.png" alt="twitter"></a><br>
                <label for="email">Se connecter avec Google +</label>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/googleplus.png" alt="google+"></a><br>

                <label for="email">Email :</label>
                <input type="text" name="email" id="email"><br>

                <input class="btn btn-orange bold" style="display: block; margin: 10px auto 0px auto;" type="submit" value="Connexion">
            </form>
        </div>
    </body>
</html>