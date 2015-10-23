<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link href="./css/style.css" rel="stylesheet" media="all" type="text/css"> 
    </head>
    <body>
        <div id="header">
            <?php
            require("./header.php");
            ?>
        </div>
        
        <div id="content">
            Content
            <form id="formInscription">
                <fieldset>
                    
                    <label id="lblPrenom">
                        Prénom : 
                    </label>
                    <input id="valPrenom" type="text" maxlength="25">
                    <br>
                    <label id="lblNom">
                        Nom : 
                    </label>
                    <input id="valNom" type="text" maxlength="25">
                    <br>
                    <label id="lblMdp">
                        Mot de passe : 
                    </label>
                    <input id="valMdp" type="password" maxlength="25">
                    <br>
                    <input id="inscrire" type="submit" value="s'inscrire">
                </fieldset>
            </form>
            blabla
        </div>
        
        <div id="footer">
            
        </div>
    </body>
</html>
