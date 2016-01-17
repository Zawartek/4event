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
                var jour = document.getElementById("jourInscription");
                var mois = document.getElementById("moisInscription");
                var annee = document.getElementById("anneeInscription");

                var valJour = jour.value;
                var valMois = mois.value;
                var valAnnee = annee.value;

                var validJour = (valJour == 0) ? 0 : 1;
                var validMois = (valMois == 0) ? 0 : 1;
                var validAnnee = (valAnnee == 0) ? 0 : 1;

                if (validJour == 1 && validMois == 1 && validAnnee == 1)
                {
                    // On vérifie l'année et le mois
                    var anneeMax = new Date().getFullYear();
                    if (valAnnee < 1900 || valAnnee > anneeMax)
                        validAnnee = 0;

                    if (valMois == 0 || valMois > 12)
                        validMois = 0;

                    var moisLongeur = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                    // On gère les années bisextiles
                    if (valAnnee % 400 == 0 || (valAnnee % 100 != 0 && valAnnee % 4 == 0))
                        moisLongeur[1] = 29;

                    // On vérifie le jour en fonction du mois
                    if (valJour < 0 || valJour > moisLongeur[valMois - 1])
                        validJour = 0;
                }
                jour.style.borderColor = (validJour == 0) ? "red" : "black";
                mois.style.borderColor = (validMois == 0) ? "red" : "black";
                annee.style.borderColor = (validAnnee == 0) ? "red" : "black";

                if (validJour == 0 || validMois == 0 || validAnnee == 0)
                    return 1;
                else
                    return 0;
            };

            function checkFormulaireInscription()
            {
                var nom = document.getElementById("nom");
                var prenom = document.getElementById("prenom");
                var email = document.getElementById("email");
                var voie = document.getElementById("voie");
                var codepostal = document.getElementById("codepostal");
                var ville = document.getElementById("ville");
                var pays = document.getElementById("pays");
                var mdp = document.getElementById("mdp");

                var desactivationInscription = 0;

                // On créé un tableau contenant tous nos inputs
                var inputs = [nom, prenom, email, voie, codepostal, ville, pays];

                // On parcours notre tableau
                for (var i = 0, c = inputs.length; i < c; i++)
                {
                    if (inputs[i].value == "") ( desactivationInscription = 1 )
                    inputs[i].style.borderColor = (inputs[i].value == "") ? "red" : "black";
                }

                if (!mdp.value.match(/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/))
                {
                   desactivationInscription = 1;
                   mdp.style.borderColor = "red";
                }
                else
                    mdp.style.borderColor = "black";

                var cguText = document.getElementById("cguText");
                var cguLink = document.getElementById("cguLink");

                if (!$("#cgu").is(":checked")) { desactivationInscription = 1 }
                cguText.style.color = (!$("#cgu").is(":checked")) ? "red" : "black";
                cguLink.style.color = (!$("#cgu").is(":checked")) ? "orange" : "blue";

                var desactivationDate = controlDate();

                if (desactivationDate == 1)
                    desactivationInscription = 1;

                if (desactivationInscription == 0)
                    document.getElementById("formInscription").submit();
            }
        </script>
    </head>

    <body>
        <div class="inscription" style="margin-top: 5%">
            <div style="background-color: white; height: 40px; width: 98px; border-radius: 10px;">
                <img src="./Vue/img/logo.png" height="40px">
            </div>

            <form id="formInscription" method="post" action="index.php?controle=utilisateur&action=inscription">
                <h2 style="margin-top: 10px;" class="text-orange bold">Inscription</h2>
                <a class="lien-reseau" href="#"><img class="logo-reseau" src="./Vue/img/facebook.png" alt="facebook"></a>
                <br>

                <label for="nom">Nom* :</label>
                <input type="text" name="nom" id="nom" class="input" placeholder="ex : Sop"><br>

                <label for="prenom">Prénom* :</label>
                <input type="text" name="prenom" id="prenom" class="input" placeholder="ex : Alain"><br>

                <label for="email">Email* :</label>
                <input type="text" name="email" id="email" class="input" placeholder="ex : sop.alain@isep.fr"><br>

                <label for="voie">Voie* :</label>
                <input type="text" name="voie" id="voie" class="input" placeholder="ex : 1 rue du lotus"><br>

                <label for="codepostal">Code postal* :</label>
                <input type="text" name="codepostal" id="codepostal" class="input" placeholder="ex : 75006"><br>

                <label for="ville">Ville* :</label>
                <input type="text" name="ville" id="ville" class="input" placeholder="ex : Paris"><br>

                <label for="pays">Pays* :</label>
                <input type="text" name="pays" id="pays" class="input" placeholder="ex : France"><br>

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
                <input type="password" name="mdp" id="mdp" class="input" title="Doit contenir au moins : un nombre, une majuscule et une minuscule et au moins 8 caractères alphanumériques." placeholder="ex : Azerty12"><br>
                
                <input type="radio" checked="checked" name="sexe" Value="0" id="femme">
                <label for="femme" style="width: auto">Femme</label>
                <input type="radio" name="sexe" value="1" id="homme">
                <label for="homme" style="width: auto">Homme</label><br>

                <input type="checkbox" name="newsletter" id="newsletter" value="1">
                <label for="newsletter" style="width: auto">Je veux recevoir la newsletter de 4event.</label><br>

                <input type="checkbox" name="cgu" id="cgu" value="1">
                <label id="cguText" for="cgu" style="width: auto">J'ai lu et j'accepte les <a id="cguLink" href="./Vue/conditions_GU.html" target="_blank">CGU</a>.*</label><br>

                <input id="submitInscription" class="btn btn-orange bold" type="button" value="S'inscrire" onclick="checkFormulaireInscription();">
            </form>
        </div>
    </body>
</html>
