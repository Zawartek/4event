<?php
$langueChoisie = (isset($_GET["langue"])) ? $_GET["langue"] : 'FR';

$languesActives = array ('FR', 'EN');
foreach ($languesActives as $langue)
{
    if ($langue == $langueChoisie)
    {
        $texte = parse_ini_file("Langue_".$langue.".ini",true);
    }
} 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion Langue</title>
        <style>
            h3, ul
            {
                margin: 10px;
            }
            img
            {
                width: 25px;
                height: 25px;
            }
        </style>
    </head>
    <body>
        <a href="exemple.php?langue=FR"><img style="margin-left: 20px;" src="pays/france.png" alt="Francais"></a>
        <a href="exemple.php?langue=EN"><img src="pays/angleterre.png" alt="English"></a>
        <!--<a href="gestionLangue.php?langue=ES"><img src="vue/img/pays/espagne.png" alt="Espagne"></a> -->
        
        <h3>Sans la gestion de langue</h3>
        <ul>
            <li>Accueil</li>
            <li>Événement</li>
            <li>Profil</li>
        </ul>
        
        <h3><?php echo $texte['global']['titre']; ?></h3>
        <ul>
            <li><?php echo $texte['global']['menu'][0]; ?></li>
            <li><?php echo $texte['global']['menu'][1]; ?></li>
            <li><?php echo $texte['global']['menu'][2]; ?></li>
        </ul>
        <a style="margin-left: 20px;" href="exemple.php">Reset</a>
    </body>
</html>