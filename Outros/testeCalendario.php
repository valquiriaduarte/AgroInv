<head>
  <link rel="stylesheet" type="text/css" href="Views/_style/Calendar.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php



require __DIR__ . "/Apps/Controller/Calendar.php";

echo Calendar::getCalendar();




?>
</body>