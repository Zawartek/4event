<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="js/datepicker.js"></script>
        
        <script type="text/javascript">
            $(function ()
            {
                $("#datepicker").datepicker($.datepicker.regional["fr"]);
                $("#datepicker").datepicker('setDate' , new Date());
            });
        </script>
    </head>
    <body>
        
        <?php require("./header.php"); ?>
        
        <div id="content">
            <div id="slider">
                
                <?php include('slider/slider.html'); ?>
                
                <div id="barreRecherche">
                    <select name="theme">
                        <?php
                        for($i=0; $i<5; $i++){
                        ?>
                        <option>
                            Test
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="text" id="datepicker" class="date" onload="this.value(Date());">
                    <button>Rechercher</button>
                </div>
            </div>
                <select id="trierPar">
                    <option>Trier par</option>
                    <?php
                        for($i=0; $i<5; $i++){
                            ?>
                        <option>
                            Test
                        </option>
                        <?php
                        }
                        ?>
                    
                </select>
                <div id="clear"></div>
                
                <div class="cadre" style='height: 120px;'>
                    <div style="float:left; background-image: url('./img/default-event.png'); background-size: 100px 100px; background-repeat: no-repeat; width : 150px; height : 100px;"> Nom de l'évenement</div>
                    <div style="float:left; width : 70%;">Descritpion------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    <button>voir l'événement</button></div>
                    <div id="clear"></div>
                </div>
                
                <div class="cadre" >
                    <div style="float:left; width : 80%;">Descritpion------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    -----------------------------------------------------------------------------------------------
                    <button>voir l'événement</button>
                    </div>
                    <div style="float:left; background-image: url('./img/default-event.png'); background-size: 100px 100px; background-repeat: no-repeat; width : 20%; height : 100px;"> Nom de l'évenement</div>
                    <div id="clear"></div>
                </div>
        </div>
        
        <div id="footer">
            
        </div>
        <div id="footer">
            
        </div>
    </body>
</html>
