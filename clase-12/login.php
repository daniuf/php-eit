<?php
  /**
   * Formulario de inicio de sesion
   * 
   * Variables esperadas 
   * 
   * email & password
   * Metodo: POST 
   */
 
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $encontrado = false;

     $email = trim($_POST['email']);
     //$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
     $password = sha1($_POST['password']);

     if (empty($email) == false && empty($password) == false) {
	//Como recibimos email y password, me puedo conectar a DB para validar email/pass

	$db_dsn = 'mysql:dbname=educacion_it;host=127.0.0.1';
	$db_user = 'eit';
	$db_pass = '1Qa2Ws3Ed@@';

	try {
	    $gbd = new PDO($db_dsn, $db_user, $db_pass);
	    //Validar si el email/pass existen en la tabla usuario
	    $query = "SELECT nombre,email, fecha_creacion ";
            $query .= "FROM usuario ";
	    $query .= "WHERE email = '{$email}' AND pass = '{$password}' ";

	    $users = $gbd->query($query, PDO::FETCH_ASSOC);

	    if ($users->rowCount() > 0) {

	      $encontrado = true;
              session_start();
	      foreach ($users as $key => $value) {
		$_SESSION[$key] = $value;
	      }
	      var_dump($_SESSION);
       	      //header("Location: mostrar_sesion.php");
            }
	} catch (PDOException $e) {
	    //echo 'Falló la conexión: ' . $e->getMessage();
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
