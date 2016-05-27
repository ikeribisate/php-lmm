<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejemplo02.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Paso de valores en PHP</h1>
  <p>Dará errores a menos que "nombre" y "apellido" tengan algún valor.</p>
  <?php echo $_GET['nombre']; ?>
  <?php echo $_GET['apellido']; ?>
</body>
</html>
