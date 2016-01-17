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

            <form id="formConnexion" method="post" action="index.php?controle=utilisateur&action=connexion">
                <h2 style="margin-top: 10px;" class="text-orange bold">Connexion</h2>

                <label for="emailConnexion" style="width: 150px;">Email* :</label>
                <input type="text" name="email" id="emailConnexion" class="input" required="required"><br>

                <label for="mdpConnexion" style="width: 150px;">Mot de passe* :</label>
                <input type="password" name="mdp" id="mdpConnexion" class="input"required="required"><br>

                <input id="submitConnexion" class="btn btn-orange bold" type="submit" value="Connexion">
            </form>
        </div>
    </body>
</html>