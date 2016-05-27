<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejemplo01.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <?php echo "<h1>Variables en PHP</h1>"; ?>

  <?php
    $nombre = 'Roberto';
    $num_gatos = 7;
    echo "$nombre tiene $num_gatos gatos.";
    echo "<br />";
    echo '$nombre tiene $num_gatos gatos.';
  ?>
</body>
</html>
