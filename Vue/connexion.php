<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">
        
        <script type="text/javascript">
            function checkFormulaireConnexion()
            {
                var submit = document.getElementById("submitConnexion");
                
                if ($("#emailConnexion").val() == "" || $("#mdpConnexion").val() == "")
                    submit.disabled = true;
                else
                    submit.disabled = false;
            }
        </script>
    </head>

    <body>
        <div class="connexion" style="margin-top: 5%">
            <div style="background-color: white; height: 40px; width: 98px; border-radius: 10px;">
                <img src="./Vue/img/logo.png" height="40px">
            </div>

            <form method="post" action="index.php?controle=utilisateur&action=connexion" onchange="checkFormulaireConnexion();">
                <h2 style="margin-top: 10px;" class="text-orange bold">Connexion</h2>

                <label for="">Se connecter avec Facebook</label>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/facebook.png" alt="facebook"></a><br>
                <label for="">Se connecter avec Twitter</label>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/twitter.png" alt="twitter"></a><br><br>

                <div style="text-align: center;">
                    <label>Ou</label>
                </div><br>

                <label for="emailConnexion" style="width: 150px;">Email* :</label>
                <input type="text" name="email" id="emailConnexion" class="input"><br>

                <label for="mdpConnexion" style="width: 150px;">Mot de passe* :</label>
                <input type="password" name="mdp" id="mdpConnexion" class="input"><br>

                <input id="submitConnexion" class="btn btn-orange bold" type="submit" value="Connexion" disabled="disabled">
            </form>
        </div>
    </body>
</html>