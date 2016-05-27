<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Curso de PHP | mayo de 2016 | index.php</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/colors.css">
  <link rel="stylesheet" href="css/ejemplos.css">
</head>
<body>
  <h1>Ejemplos de PHP</h1>
  <p>Esta página muestra todos los archivos con extensión PHP que hay en los subdirectorios. Si se establece como página
    de inicio para depurar en PhpStorm y después se hace click en el archivo que se quiere ver, debería funcionar
    correctamente con la máquina scotch-box y las instrucciones que incluye.</p>
  <ul>
    <?php
      // http://stackoverflow.com/a/35105800
      function getDirContents($dir, $filter = '', &$results = array())
      {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
          $path = realpath($dir . DIRECTORY_SEPARATOR . $value);

          if (!is_dir($path)) {
            if (empty($filter) || preg_match($filter, $path)) $results[] = $path;
          } elseif ($value != "." && $value != "..") {
            getDirContents($path, $filter, $results);
          }
        }

        return $results;
      }

      $ficheros = getDirContents('.', '/\.php$/');

      foreach ($ficheros as $fichero) {
        $nombre = str_replace($_SERVER['DOCUMENT_ROOT'], "", realpath($fichero));
        echo '<li><a class="blue" href="' . $nombre . '">' . $nombre . '</a></li>';
      }
    ?>
  </ul>
</body>
</html>
