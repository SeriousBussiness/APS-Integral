<?php 
	require 'lib/PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'natja.kramarenko@gmail.com';                     // SMTP username
    $mail->Password   = '72616e61';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  if($_POST) {
      $cnombre = "";
      $capellido = "";
      $cemail = "";
      $casunto = "";
      $cmensaje = "";

    //Recipients
    $mail->setFrom('natja.kramarenko@gmail.com', 'Contactame');
    $mail->addAddress('natja.kramarenko@gmail.com');     // Add a recipient
       
      if(isset($_POST['nombre'])) {
        $cnombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
      }

      if(isset($_POST['apellido'])) {
        $capellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
      }
       
      if(isset($_POST['email'])) {
          //$cemail = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
          //$cemail = filter_var($cemail, FILTER_VALIDATE_EMAIL);
      	$cemail = $_POST['email'];
      }
       
      if(isset($_POST['asunto'])) {
          $casunto = filter_var($_POST['asunto'], FILTER_SANITIZE_STRING);
      }
       
      if(isset($_POST['mensaje'])) {
          $cmensaje = htmlspecialchars($_POST['mensaje']);
      }

      $ccontacto="";
      $ccontacto= "Se ha enviado un mensaje por contactame de parte de ". $cnombre ."". $capellido."(".$cemail."):".$cmensaje;   

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $casunto;
    $mail->Body    = $ccontacto;
       
//    $mail->send();
    if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}

       
  } else {
      echo '<p>Algo salió mal.</p>';
  }

  header('Location: index.html');
 
?>