<?php

$date = new DateTime();
$format = $date->format('Y-m-d H:i:s');

echo "La hora actual segun el servidor es: $format";
