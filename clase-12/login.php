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

     $encontrado = false;

     $email = trim($_POST['email']);
     //$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
     $password = sha1($_POST['password']);

     if (empty($email) == false && empty($password) == false) {
	//Como recibimos email y password, me puedo conectar a DB para validar email/pass

	    $gbd = conectarDB('mysql','127.0.0.1', 'eit', '1Qa2Ws3Ed@@', 'educacion_it');

	    if (is_object($gbd)) {
	     //Validar si el email/pass existen en la tabla usuario
	     $resultado = login($gbd, $email, $password);

	     if ($resultado[0] == true) {

              actualizar_ultima_fecha_login($gbd, $email);
	      $encontrado = true;
              session_start();

	      foreach ($resultado[1] as $key => $value) {
		$_SESSION[$key] = $value;
	      }
	      var_dump($_SESSION);
       	      //header("Location: mostrar_sesion.php");
             }
	    } else {
	     die("Error general del sistema");
	    }

         if ($encontrado == false) {

           $error = "Credenciales incorrectas";
         }
     }
   }
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Formulario de login</title>
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

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
  </div>

  </form>
 </body>
</html>
