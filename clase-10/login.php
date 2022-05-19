<?php

  /**
   * Formulario de inicio de sesion
   * 
   * Variables esperadas 
   * 
   * username & password
   * Metodo: POST 
   */
 
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $username = trim($_POST['username']);
     $password = trim($_POST['password']);

     $encontrado = false;

     $users = array(
		array('user' => 'daniuf@gmail.com',
		      'pass' => '123456',
		      'pais' => 'Argentina'),
		array('user' => 'hernan@gmail.com',
		      'pass' => '654321',
		      'pais' => 'Argentina'),
		array('user' => 'esteban@gmail.com',
		      'pass' => '123654',
		      'pais' => 'Brasil')
              );

     for ($i = 0; $i < count($users); $i++) {

      if ($username == $users[$i]['user'] && $password == $users[$i]['pass']) {
       //Iniciamos session
       $encontrado = true;
       session_start();
       $_SESSION['username'] = $users[$i]['user'];
       $_SESSION['pais'] = $users[$i]['pais'];
       $_SESSION['logueado'] = true;
       header("Location: mostrar_sesion.php");
       break;
      }
     }

     if ($encontrado == false) {
       $error = "Credenciales incorrectas";
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
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
  </div>

  </form>
 </body>
</html>
