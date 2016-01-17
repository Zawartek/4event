<html>
    <head>
        <meta charset="UTF-8">
        <title>FAQ</title>
        <link rel="icon" type="image/png" href="favicon.png">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            function swap(id)
            {
                var etat = document.getElementById(id).style;
                etat.display = (etat.display === "none") ? "inline" : "none";
            }
        </script>
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div>
                <h2 id="titreFAQ" class="text-orange">Foire Aux Questions</h2>
            </div>
            <?php
            $premier = 1;
            $cpt = 0;
            foreach ($faqs as $faq)
            { 
                if ($premier == 1)
                { ?>
                    <p id="premiereFAQ" class="justify"><?php echo nl2br($faq["faq_reponse"]); ?></p>
                    <?php
                    $premier = 0;
                }
                else
                { ?>
                    <p id="<?php echo "question".$cpt; ?>" onclick="swap('<?php echo "reponse".$cpt; ?>');" class="questionFAQ">
                        <?php echo $faq["faq_question"]; ?></p>
                    <p id="<?php echo "reponse".$cpt; ?>" class="justify" style="display: none;"><?php echo nl2br($faq["faq_reponse"]); ?></p>
                    <?php
                    $cpt ++;
                } 
            }?>
        </div>
    </body>
    <div><?php include('./Vue/footer.php'); ?></div>
</html>
