<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | ejer03.php</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/ejemplos.css">
</head>
<body>
  <h1>Ejercicio 3</h1>
  <p>Partiendo de este formulario, hacer que esta página muestre una lista no ordenada con una secuencia como "Elemento
    1", "Elemento 2", etc.</p>
  <p>Empezará en 1 y acabará en el número que el usurio nos escriba en el formulario.</p>

  <h2>El formulario</h2>
  <form action="ejer03.php" method="get">
    <input type="text" id="N" name="N" value=""/>
    <input type="submit" id="enviar" name="enviar" value="Enviar"/>
  </form>
</body>
</html>
