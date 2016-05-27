<!--
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejer09.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Ejercicio 9</h1>
  <p>Partiendo del ejemplo 21, hacer que muestre también los comentarios asociados a cada entrada.</p>
  <p>Cuando se pinche en el título de una entrada, debería mostrarse otra página con el contenido de la misma y todos
    los comentarios asociados.</p>
  <p>Al final de esa página tenemos que dar la opción de introducir un nuevo comentario, pidiendo los datos que sean
    necesarios.</p>
</body>
</html>
-->



<!--
EJER08 (21)

-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejemplo20.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
<h1>Ejercicio 09</h1>
<p>Se conecta a una base de datos llamada "blog" en la máquina "localhost" con el usuario "root" y contraseña
  "root".</p>
<p>Borra la entrada cuyo ID nos llegue en el parámetro id de la petición GET de HTTP.</p>
<p>No hace comprobación de errores.</p>

<?php
// Abrir la conexión
$conexion = mysqli_connect("localhost", "root", "root", "blog");

// Borrado, si es que nos pasan un id
if (isset($_GET['id'])) {
  // Borramos los comentarios correspondientes a la entrada
  $q = "delete from comentario where entrada_id='" . $_GET['id'] . "'";
  // Ejecutar la consulta en la conexión abierta. No hay "resultset"
  mysqli_query($conexion, $q) or die(mysqli_error($conexion));

  // Formar la consulta (borrado de una fila)
  $q = "delete from entrada where id='" . $_GET['id'] . "'";

  // Ejecutar la consulta en la conexión abierta. No hay "resultset"
  mysqli_query($conexion, $q) or die(mysqli_error($conexion));

  // Comprobar si hemos afectado a alguna fila
  echo "<p class='red'>";

  if (mysqli_affected_rows($conexion) > 0)
    echo "Se ha borrado la entrada on ID " . $_GET['id'] . ".";
  else
    echo "No se ha borrado ninguna entrada.";

  echo "</p>";
}

// Formar la consulta (seleccionando todas las filas)
$q = "select * from entrada";

// Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
$r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

// Calcular el número de filas
$total = mysqli_num_rows($r);

// Mostrar el contenido de las filas, creando una tabla XHTML
if ($total > 0) {
  echo '<table border="1">';
  echo '<tr><th>ID</th><th>Título</th><th>Texto</th><th>Fecha</th><th>Activo</th></tr>';


  //echo '<a href="http://192.168.33.10/ejemplos-php/02_php_mysql/ejemplo20modificar.php">holi </a>';

  while ($fila = mysqli_fetch_assoc($r)) {
    echo "<tr>";
    echo "<td><a href='http://192.168.33.10/ejemplos-php/02_php_mysql/ejemplo20modificar2.php?id=" .$fila['id']. "'>" . $fila['id'] . "</td>";
    echo "<td>" . $fila['titulo'] . "</td>";
    echo "<td>" . $fila['texto'] . "</td>";
    echo "<td>" . $fila['fecha'] . "</td>";
    echo "<td>" . $fila['activo'] . "</td>";
    echo "</tr>";
  }

  echo '</table>';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
<p><a class="blue" href="ejemplo20modificar2.php">Recargar la página</a></p>


<!--
ejemplo20modificar

-->






</body>
</html>
