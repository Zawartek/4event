<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>jQuery UI Datepicker - Localize calendar</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/datepicker.js"></script>
    <link rel="stylesheet" href="css/style.css">
  
    <script type="text/javascript">
        $(function ()
        {
            $("#datepicker1").datepicker($.datepicker.regional["fr"]);
            $("#datepicker2").datepicker($.datepicker.regional["fr"]);
        });
    </script>
</head>

<body>
 
Date: <input type="text" id="datepicker1">
Date: <input type="text" id="datepicker2">

 
 
</body>
</html>