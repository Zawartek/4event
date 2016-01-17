<html>
    <head>
        <meta charset="UTF-8">
        <title>FAQ</title>
        <link rel="icon" type="image/png" href="favicon.png">
    </head>
    <body>
        <div id="content">
            <?php require("./Vue/header.php"); ?>
            <div>
                <h2 class="text-orange" style=" text-align: center; margin-top: 7px; ">Foire Aux Questions</h2>
            </div>
            <?php
            foreach ($faqs as $faq)
            { ?>
                <p><?php echo $faq["faq_question"]; ?></p>
                <p style="text-align : justify;"><?php echo nl2br($faq["faq_reponse"]); ?></p>
            <?php
            } ?>
        </div>
    </body>
    <div><?php include('./Vue/footer.php'); ?></div>
</html>
