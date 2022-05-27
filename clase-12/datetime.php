<?php

ini_set('date.timezone', 'America/Argentina/Buenos_Aires');

$datetime = new DateTime();
$hoy = $datetime->format('Y-m-d H:i:s');

echo $hoy;
