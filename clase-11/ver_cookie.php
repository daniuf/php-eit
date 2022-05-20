<?php

/**
 * Vemos el contenido de la variable superglobal COOKIE
 * https://www.php.net/manual/es/reserved.variables.php
 *
 */
var_dump($_COOKIE);


if (isset($_COOKIE['clase11'])) {
  //setcookie("clase11-2", "Siguio por detalle de cookie", 0, "/clase-11/", "https://eit.daniuf.com.ar", true, true);
  var_dump($_COOKIE['clase11']);
} else {

  echo "El usuario entro por pagina de ver cookie";

}
