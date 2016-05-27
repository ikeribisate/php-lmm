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
  <h1>Insertar una fila en una tabla de MySQL</h1>
  <p>Se conecta a una base de datos llamada "blog" en la máquina "localhost" con el usuario "root" y contraseña
    "root".</p>
  <p>Inserta un nuevo post en la tabla "entrada".</p>
  <p>No hace comprobación de errores.</p>

  <h2>Nuevo post</h2>

  <?php
    // date_default_timezone... es obligatorio si usais PHP 5.3 o superior
    date_default_timezone_set('Europe/Madrid');
    $fecha_actual = date("Y-m-d H:i:s");
  ?>

  <form action="ejemplo20.php" method="get">
    <div>
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" value=""/>
    </div>
    <div>
      <label for="texto">Texto:</label>
      <textarea id="texto" name="texto" rows="4" cols="40"></textarea>
    </div>
    <div>
      <label for="fecha">Fecha:</label>
      <input type="text" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>"/>
    </div>
    <div>
      <label for="activo">Activo:</label>
      <input type="checkbox" id="activo" name="activo" checked="checked"/>
    </div>
    <div>
      <input type="reset" id="limpiar" name="limpiar" value="Limpiar"/>
      <input type="submit" id="enviar" name="enviar" value="Guardar"/>
    </div>
  </form>

  <?php if (isset($_GET['enviar'])) { ?>

    <h2>Listado de entradas</h2>

    <?php
    // Recoger los valores
    $titulo = "";
    if (isset($_GET['titulo']))
      $titulo = $_GET['titulo'];

    $texto = "";
    if (isset($_GET['texto']))
      $texto = $_GET['texto'];

    $fecha = $fecha_actual;
    if (isset($_GET['fecha']) && $_GET['fecha'] != "")
      $fecha = $_GET['fecha'];

    $activo = 0;
    if (isset($_GET['activo']))
      $activo = 1;
    ?>

    <?php
    // Abrir la conexión
    $conexion = mysqli_connect("localhost", "root", "root", "blog");

    // Formar la consulta (insertar una fila)

    /*
      Escribir la consulta

        $q = "insert into entrada values( 0, '', '', '', '' )";

      Cortar en los puntos en los que queremos introducir variables con ".."

        $q = "insert into entrada values( 0, '".$titulo."', '".$texto."', '".$fecha."', '".$activo."' )";
    */

    $q = "insert into entrada values ( 0,'" . $titulo . "','" . $texto . "','" . $fecha . "','" . $activo . "' )";

    // Ejecutar la consulta en la conexión abierta. No hay "resultset"
    mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    // Formar la consulta (seleccionando todas las filas)
    $q = "select * from entrada";

    // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    // Calcular el número de filas
    $total = mysqli_num_rows($r);

    // Mostrar el contenido de las filas, creando una tabla XHTML
    if ($total > 0) {
      echo '<table border="1">';
      echo '<tr><th>Título</th><th>Texto</th><th>Fecha</th><th>Activo</th></tr>';

      while ($fila = mysqli_fetch_assoc($r)) {
        echo "<tr>";
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

  <?php } ?>
</body>
</html>
