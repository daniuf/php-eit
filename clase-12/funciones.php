<?php

/**
 * Login de usuario al sistema
 * @param object $gbd
 * @param string $email
 * @param string $password
 * @return array
 */
function login($gbd, $email, $password) {

  $encontrado = false;
  $query = "SELECT nombre,email, fecha_creacion ";
  $query .= "FROM usuario ";
  $query .= "WHERE email = '{$email}' AND pass = '{$password}' ";

  $users = $gbd->query($query, PDO::FETCH_ASSOC);

  if ($users->rowCount() > 0) {
    $encontrado = true;
  }

  return array($encontrado, $users);
}

/**
 * Actualiza ultima fecha de login del usuario dado
 * @param object $gbd
 * @param string $email
 * @return void
 */
function actualizar_ultima_fecha_login($gbd, $email) {

  $datetime = new DateTime();
  $fecha_login = $datetime->format('Y-m-d H:i:s');
  $update = "UPDATE usuario SET fecha_ultimo_login = '{$fecha_login}' WHERE email = '{$email}' ";
  $sth = $gbd->prepare($update);//sth es del tipo PDOStatement
  $sth->execute();

}

function conectarDB($engine, $host, $user, $pass, $schema) {

 try {
  $db_dsn = $engine.':dbname='.$schema.';host='.$host;
  $db_user = $user;
  $db_pass = $pass;
  $gbd = new PDO($db_dsn, $db_user, $db_pass);
 } catch (Exception $error) {
  $gbd = false;
  escribir_log("logs/error.log", "a+", $error->getMessage());
 }

  return $gbd;
}

/**
 * Funcion para escribir archivo
 * @param string $archivo
 * @param string $modo
 * @param string $mensaje
 * @return void
 */
function escribir_log($archivo, $modo, $mensaje) {

 $datetime = new DateTime();
 $now = $datetime->format('Y-m-d H:i:s');

 $fp = fopen($archivo, $modo);
 fwrite($fp, "[".$now."]\t".$mensaje.PHP_EOL);
 fclose($fp);

}

