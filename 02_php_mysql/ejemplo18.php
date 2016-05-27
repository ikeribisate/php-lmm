<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejemplo18.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Mostrar todas las filas de una tabla de MySQL</h1>
  <p>Se conecta a una base de datos llamada "blog" en la máquina "localhost" con el usuario "root" y contraseña
    "root".</p>
  <p>Muestra las filas de la tabla "entrada".</p>
  <p>No hace comprobación de errores.</p>

  <?php
    // Abrir la conexión
    $conexion = mysqli_connect("localhost", "root", "root", "blog");

    // Formar la consulta (seleccionando todas las filas)
    $q = "select * from entrada";

    // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    // Calcular el número de filas
    $total = mysqli_num_rows($r);

    // Mostrar el contenido de las filas
    if ($total > 0) {
      while ($fila = mysqli_fetch_assoc($r)) {
        echo "<strong><p>" . $fila['titulo'] . "</p></strong>";
        echo "<p>Texto: " . $fila['texto'] . "<p/>";
        echo "<p>Fecha: " . $fila['fecha'] . "</p>";
      }
    }

    // Cerrar la conexión
    mysqli_close($conexion);
  ?>
</body>
</html>
