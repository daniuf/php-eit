<?php

$mensaje = ucfirst(strtolower(filter_var($_GET['mensaje'], FILTER_SANITIZE_STRING)));

echo "Hola, ".$mensaje.". Como estas?";
