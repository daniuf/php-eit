<?php
  /**
   * Formulario de inicio de sesion
   * 
   * Variables esperadas 
   * 
   * email & password
   * Metodo: POST 
   */
   ini_set('date.timezone', 'America/Argentina/Buenos_Aires');
   require_once('funciones.php');
 
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $email = trim($_POST['email']);
     $name = trim($_POST['name']);
     $password = sha1($_POST['password']);

     if (empty($email) == false && empty($password) == false && empty($name) == false) {
	//Como recibimos valores esperados, procedemos con creacion de usuario 

	    $gbd = conectarDB('mysql','127.0.0.1', 'eit', '1Qa2Ws3Ed@@', 'educacion_it');

	    if (is_object($gbd)) {

	     $date = new DateTime();
	     $fecha_alta = $date->format('Y-m-d H:i:s');
	
	     $hash = md5($name.$email.$password);

	     $insert = "INSERT INTO usuario ";
	     $insert .= " (nombre, email, pass, estado, hash, fecha_creacion) ";
	     $insert .= " VALUES ";
	     $insert .= " ('{$name}', '{$email}', '{$password}', 0, '{$hash}', '{$fecha_alta}') ";

	     $sth = $gbd->prepare($insert);
	     $sth->execute();

	     if ($sth->rowCount() > 0) { //Si pudo crear el usuario en la tabla
		//Enviamos el correo al email ingresado
                //Usando el hash generado en el insert
		require_once('demo-mail.php');
	     } else {
		//logueamos query en error_log para ver registros fallidos
	     }

	    } else {
             $error = "Credenciales incorrectas";
	     die("Error general del sistema");
	    }
         }
     }
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Formulario de alta</title>
 </head>
 <body>
 <form action="" method="post">

  <div>
  <?php
     echo $error;
  ?>
  </div>

  <div class="container">
    <label for="uname"><b>E-mail</b></label>
    <input type="email" placeholder="Enter Username" name="email" required>

    <label for="uname"><b>Nombre</b></label>
    <input type="text" placeholder="Enter Name" name="name" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Registrarme</button>
  </div>

  </form>
 </body>
</html>
