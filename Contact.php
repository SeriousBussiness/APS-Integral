<?php 
  if($_POST) {
      $cnombre = "";
      $capellido = "";
      $cemail = "";
      $casunto = "";
      $cmensaje = "";
       
      if(isset($_POST['cnombre'])) {
        $cnombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
      }

      if(isset($_POST['capellido'])) {
        $capellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
      }
       
      if(isset($_POST['email'])) {
          $cemail = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
          $cemail = filter_var($cemail, FILTER_VALIDATE_EMAIL);
      }
       
      if(isset($_POST['asunto'])) {
          $casunto = filter_var($_POST['asunto'], FILTER_SANITIZE_STRING);
      }
       
      if(isset($_POST['cmensaje'])) {
          $cmensaje = htmlspecialchars($_POST['mensaje']);
      }
       
      $recipient = "hounriom.7@gmail.com";
       
      $headers  = 'MIME-Version: 1.0' . "\r\n"
      .'Content-type: text/html; charset=utf-8' . "\r\n"
      .'From: ' . $cemail . "\r\n";
       
      if(mail($recipient, $casunto, $cmensaje, $headers)) {
          echo "<p>Gracias por contactarnos, $cnombre. Te responderemos a penas podamos.</p>";
      } else {
          echo '<p>Lo sentimos, pero el correo electrónico no fue enviado.</p>';
      }
       
  } else {
      echo '<p>Algo salió mal.</p>';
  }

  header('Location: index.html');
 
?>