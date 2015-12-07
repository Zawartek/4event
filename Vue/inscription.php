<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
        <link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">

        <!-- appels pour datepicker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="./Vue/js/datepicker.js"></script>

        <script type="text/javascript">
            $(function()
            {
                $("#datenaissance").datepicker($.datepicker.regional["fr"]);
                $("#datenaissance").datepicker('setDate', new Date());
            });
        </script>
    </head>

    <body>
        <div class="inscription" style="margin-top: 5%">
            <div style="background-color: white; height: 40px; width: 98px; border-radius: 10px;">
                <img src="./Vue/img/logo.png" height="40px">
            </div>

            <form method="post" action="inscriptionControler.php">
                <h2 style="margin-top: 10px;" class="text-orange bold">Inscription</h2>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/facebook.png" alt="facebook"></a>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/twitter.png" alt="twitter"></a>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/googleplus.png" alt="google+"></a><br>

                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="input"><br>

                <label for="prenom">Prenom :</label>
                <input type="text" name="prenom" id="prenom" class="input"><br>

                <label for="email">Email :</label>
                <input type="text" name="email" id="email" class="input"><br>

                <label for="voie">Voie :</label>
                <input type="text" name="voie" id="voie" class="input"><br>

                <label for="codepostal">Code postal :</label>
                <input type="text" name="codepostal" id="codepostal" class="input"><br>

                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" class="input"><br>

                <label for="pays">Pays :</label>
                <input type="text" name="pays" id="pays" class="input"><br>

                <label for="datenaissance">Date de naissance :</label>
                <input type="text" id="datenaissance" name="datenaissance" class="input" onload="this.value(Date());">

                <label for="mdp">Mot de passe :</label>
                <input type="password" name="mdp" id="mdp" class="input" required="required"><br>

                <input type="radio" checked="checked" name="sexe" Value="0" id="femme">
                <label for="femme" style="width: auto">Femme</label>
                <input type="radio" name="sexe" value="1" id="homme">
                <label for="homme" style="width: auto">Homme</label><br>

                <input type="checkbox" name="newsletter" id="newsletter" value="1">
                <label for="newsletter" style="width: auto">Je veux recevoir la newsletter de 4Event.</label><br>

                <input class="btn btn-orange bold" style="display: block; margin: 10px auto 0px auto;" type="submit" value="S'Inscrire">
            </form>
        </div>
    </body>
</html>