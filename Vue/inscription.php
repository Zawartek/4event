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
    </head>
    <body>
        <div id="header">
            <?php
            require("./header.php");
            ?>
        </div>
        
        <div id="content">
            Content
            <form>
                <fieldset>
                    
                    <label id="lblPrenom">
                        Nom : 
                    </label>
                    <input id="valPrenom" type="text" maxlength="25">
                    
                    <label id="lblNom">
                        Nom : 
                    </label>
                    <input id="valNom" type="text" maxlength="25">
                    
                </fieldset>
            </form>
        </div>
        
        <div id="footer">
            
        </div>
    </body>
</html>
