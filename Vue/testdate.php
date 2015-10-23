<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>jQuery UI Datepicker - Localize calendar</title>
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
    <input type="text" id="datepicker" class="date" onload="this.value(Date());">
</body>
</html>