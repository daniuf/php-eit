<?php

$mensaje = ucfirst(strtolower(filter_var($_GET['mensaje'], FILTER_SANITIZE_STRING)));
$ciudad = ucfirst(strtolower(filter_var($_GET['ciudad'], FILTER_SANITIZE_STRING)));

echo "Hola, ".$mensaje.". Como estas? Segun nuestros datos, vos sos de ".$ciudad;
