<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
        <link href="./Vue/css/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
        <link href="./Vue/css/style.css" rel="stylesheet" media="all" type="text/css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="./Vue/js/datepicker.js"></script>

        <script type="text/javascript">
            function controlDate()
            {
                var jour = $("#jourInscription").val();
                var mois = $("#moisInscription").val();
                var annee = $("#anneeInscription").val();

                if (jour != 0 && mois != 0 && annee != 0)
                {
                    // On vérifie l'année et le mois
                    var anneeMax = new Date().getFullYear();
                    if (annee < 1900 || annee > anneeMax || mois == 0 || mois > 12)
                        return 1;

                    var moisLongeur = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                    // On gère les années bisextiles
                    if (annee % 400 == 0 || (annee % 100 != 0 && annee % 4 == 0))
                        moisLongeur[1] = 29;

                    // On vérifie le jour en fonction du mois
                    if (jour < 0 || jour > moisLongeur[mois - 1])
                        return 1;
                    else
                        return 0;
                }
                else
                    return 1;
            };

            function checkFormulaireInscription()
            {
                var submit = document.getElementById("submitInscription");
                var desactivation = 0;

                if ($("#nom").val() == "" || $("#prenom").val() == "" || $("#email").val() == "" || $("#voie").val() == "" ||
                    $("#codepostal").val() == "" || $("#ville").val() == "" || $("#pays").val() == "" || $("#mdp").val() == "" || !$("#cgu").is(":checked"))
                        desactivation = 1;
                else
                    desactivation = controlDate();

                if (desactivation == 1)
                    submit.disabled = true;
                else if (desactivation == 0)
                    submit.disabled = false;
            }
        </script>
    </head>

    <body>
        <div class="inscription" style="margin-top: 5%">
            <div style="background-color: white; height: 40px; width: 98px; border-radius: 10px;">
                <img src="./Vue/img/logo.png" height="40px">
            </div>

            <form method="post" action="index.php?controle=utilisateur&action=inscription" onchange="checkFormulaireInscription();">
                <h2 style="margin-top: 10px;" class="text-orange bold">Inscription</h2>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/facebook.png" alt="facebook"></a>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/twitter.png" alt="twitter"></a><br>

                <label for="nom">Nom* :</label>
                <input type="text" name="nom" id="nom" class="input"><br>

                <label for="prenom">Prénom* :</label>
                <input type="text" name="prenom" id="prenom" class="input"><br>

                <label for="email">Email* :</label>
                <input type="text" name="email" id="email" class="input"><br>

                <label for="voie">Voie* :</label>
                <input type="text" name="voie" id="voie" class="input"><br>

                <label for="codepostal">Code postal* :</label>
                <input type="text" name="codepostal" id="codepostal" class="input"><br>

                <label for="ville">Ville* :</label>
                <input type="text" name="ville" id="ville" class="input"><br>

                <label for="pays">Pays* :</label>
                <input type="text" name="pays" id="pays" class="input"><br>

                <label style="width: auto;">Date de<br>naissance* :</label>
                <div class="formDateNaissance">
                    <select class="champDateNaissance" name="jour" id="jourInscription">
                        <option value="0">Jour</option>
                        <?php
                        for ($j = 1; $j <= 31; $j ++)
                        {
                            echo "<option value='$j'>$j</option>";
                        } ?>
                    </select>
                    <select class="champDateNaissance" name="mois" id="moisInscription">
                        <option value="0">Mois</option>
                        <?php
                        $mois = array('janv', 'févr', 'mars', 'avril', 'mai', 'juin', 'juil', 'août', 'sept', 'oct', 'nov', 'déc');
                        for ($m = 1; $m <= 12; $m ++)
                        {
                            $indice = $m - 1;
                            echo "<option value='$m'>$mois[$indice]</option>";
                        } ?>
                    </select>
                    <select class="champDateNaissance" name="annee" id="anneeInscription">
                        <option value="0">Année</option>
                        <?php
                        for ($a = date("Y"); $a >= 1900; $a --)
                        {
                            echo "<option value='$a'>$a</option>";
                        } ?>
                    </select>
                </div>

                <label for="mdp">Mot de passe* :</label>
                <input type="password" name="mdp" id="mdp" class="input" required="required"><br>

                <input type="radio" checked="checked" name="sexe" Value="0" id="femme">
                <label for="femme" style="width: auto">Femme</label>
                <input type="radio" name="sexe" value="1" id="homme">
                <label for="homme" style="width: auto">Homme</label><br>

                <input type="checkbox" name="newsletter" id="newsletter" value="1">
                <label for="newsletter" style="width: auto">Je veux recevoir la newsletter de 4event.</label><br>

                <input type="checkbox" name="cgu" id="cgu" value="1">
                <label for="cgu" style="width: auto">J'ai lu et j'accepte les <a href="./Vue/conditions_GU.html" target="_blank">CGU</a>.*</label><br>

                <input id="submitInscription" class="btn btn-orange bold" type="submit" value="S'inscrire" disabled="disabled">
            </form>
        </div>
    </body>
</html>
