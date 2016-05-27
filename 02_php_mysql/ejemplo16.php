<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejemplo16.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Conexión a MySQL</h1>
  <p>Se conecta a una base de datos llamada "blog" en la máquina "localhost" con el usuario "root" y contraseña
    "root".</p>
  <p>No hace comprobación de errores.</p>

  <?php
    // Abrir la conexión
    $conexion = mysqli_connect("localhost", "root", "root", "blog");

    // Elegir la base de datos (sólo si no la hemos añadido como cuarto parámetro en la conexión)
    //mysqli_select_db($conexion, "blog");

    // Aquí van nuestras consultas, etc.


    // Cerrar la conexión
    mysqli_close($conexion);
  ?>
</body>
</html>
