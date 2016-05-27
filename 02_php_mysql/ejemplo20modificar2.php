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


<h1>Nueva llamada</h1>
<p>Se conecta a una base de datos llamada "blog" en la máquina "localhost" con el usuario "root" y contraseña
    "root".</p>
<p>"entrada".</p>
<p>No hace comprobación de errores.</p>

<h2>Nuevo post</h2>


<?php
// date_default_timezone... es obligatorio si usais PHP 5.3 o superior
date_default_timezone_set('Europe/Madrid');
$fecha_actual = date("Y-m-d H:i:s");
?>





<?php
// Abrir la conexión
$conexion = mysqli_connect("localhost", "root", "root", "blog");

// Borrado, si es que nos pasan un id
if (isset($_GET['id'])) {
    // Borramos los comentarios correspondientes a la entrada
    $q1 = "SELECT * FROM comentario where entrada_id= '" . $_GET['id'] . "'";
    $q = "SELECT * FROM entrada where id= '" . $_GET['id'] . "'";
    //$q = "SELECT * FROM entrada,comentario where entrada.id= '" . $_GET['id'] . "' and comentario.entrada_id = entrada.id";


// Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));
    $r1 = mysqli_query($conexion, $q1) or die(mysqli_error($conexion));

// Calcular el número de filas
    $total = mysqli_num_rows($r);
    $total1 = mysqli_num_rows($r1);

// Mostrar el contenido de las filas, creando una tabla XHTML
    if ($total > 0) {


        $fila = mysqli_fetch_assoc($r);


    }

    if ($total1 > 0) {


        $fila1 = mysqli_fetch_assoc($r1);


    }
}
// Cerrar la conexión
mysqli_close($conexion);
?>








<form action="ejemplo20modificar2.php" method="get">
    <div>
        <label for="activo">Activo:</label>
        <input type="checkbox" id="activo" name="activo" "<?php $fila ['activo'] ; ?>" />
    </div>
    <div>
        <input type="hidden" id="id" name="id" value="<?php echo $fila['id'];?>"/>
    </div>
    <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $fila['titulo'];?>"/>
    </div>
    <div>
        <label for="texto">Texto:</label>
        <textarea id="texto" name="texto" rows="4" cols="40"><?php echo $fila['texto'];?></textarea>
    </div>
    <div>
        <label for="fecha">Fecha:</label>
        <input type="text" id="fecha" name="fecha" value="<?php echo $fila['fecha']; ?>"/>
    </div>
    <div>
        <label for="activo">Activo:</label>
        <input type="checkbox" id="activo" name="activo"
        "<?php if ($fila ['activo'] == 1)
            echo 'checked = "checked"' ?>" />

    </div>

    <?php if ($total1 > 0) { ?>
    <div>
        <label for="comentario">Comentario:</label>
        <input type="text" id="comentario" name="comentario" value="<?php echo $fila1['texto']; ?>"/>
    </div>
    <?php } ?>



    <div>
        <input type="reset" id="limpiar" name="limpiar" value="Limpiar"/>

        <input type="submit" id="modificar" name="modificar" value="Modificar"/>
        <input type="submit" id="borrar" name="borrar" value="Borrar"/>
        <input type="submit" id="insertarcomentario" name="insertarcomentario" value="Insertar comentario"/>
    </div>
</form>




<?php if (isset($_GET['modificar'])) { ?>

    <h2>Listado de entradas</h2>

    <?php

    // Recoger los valores
    //$titulo = "";
    if (isset($_GET['titulo']))
        $titulo = $_GET['titulo'];
    if (isset($_GET['id']))
        $titulo = $_GET['id'];
    //$texto = "";
    if (isset($_GET['texto']))
        $texto = $_GET['texto'];

    //$fecha = $fecha_actual;
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

    $q = "update entrada set  titulo = '" . $titulo . "',texto = '" . $texto . "',fecha = '" . $fecha . "',activo = '" . $activo . "'  where id='" . $_GET['id'] . "'" ;

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


        //echo '<a href="http://192.168.33.10/ejemplos-php/02_php_mysql/ejer08.php">holi </a>';

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

<?php if (isset($_GET['borrar'])) { ?>

    <h2>Listado de entradas</h2>

    <?php

    // Recoger los valores
    //$titulo = "";
    if (isset($_GET['titulo']))
        $titulo = $_GET['titulo'];
    if (isset($_GET['id']))
        $titulo = $_GET['id'];
    //$texto = "";
    if (isset($_GET['texto']))
        $texto = $_GET['texto'];

    //$fecha = $fecha_actual;
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
    $q = "delete from comentario  where entrada_id='" . $_GET['id'] . "'" ;

    $q = "delete from entrada  where id='" . $_GET['id'] . "'" ;

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


        //echo '<a href="http://192.168.33.10/ejemplos-php/02_php_mysql/ejer08.php">holi </a>';

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


<?php if (isset($_GET['insertarcomentario'])) { ?>


    <div>
        <label for="guardarcomentario">Guardar comentario:</label>
        <input type="text" id="guardarcomentario" name="guardarcomentario" value=""/>
    </div>

<div>
    <input type="submit" id="guardar" name="guardar" value="Guardar"/>
</div>



<?php } ?>

<?php if (isset($_GET['guardar'])) { ?>

<?php
    if (isset($_GET['id']))
    $titulo = $_GET['id'];


    if (isset($_GET['texto']))
        $texto = $_GET['texto'];


    $q = "insert into comentario VALUES  id = '" . $id . "',texto = '" . $texto . "' " ;



    mysqli_query($conexion, $q) or die(mysqli_error($conexion));
    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

    ?>






<?php } ?>


</body>
</html>