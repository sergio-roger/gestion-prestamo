<?php

$peticionAjax = true; 

include_once '../core/config.php';
include_once '../core/Helper.php';
include_once '../controllers/UsuarioController.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../pluginsPHP/Exception.php';
require '../pluginsPHP/PHPMailer.php';
require '../pluginsPHP/SMTP.php';

if(isset($_POST['data'])){
    $data = $_POST['data'];
    $data = json_decode($data);

    $_POST['id'] = $data->{'id'};
    $id = $_POST['id'];
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->getUsuario();
    
    $admin = 'admin@admin.com';
    $destinatario = $usuario['usu_correo'];
    $nombres = $usuario['usu_nombres'].' '.$usuario['usu_apellidos'];
    $nombre = 'Administrador';
    $asunto = 'Verificacion del correo';

    //Enviar mensaje de confirmación al correo
    $header = 'Enviado desde CrediExpress';
    $rutaConfirmar = 'confirmar/correo/link/'.$id;
    $altbody = '
    Para confirmar su correo haga click en el siguiente enlace <br> 
    <a href= "'.BASE.$rutaConfirmar.'" target="_blank">Verificar correo</a>
    <br><br><br>
    <b>Enviado desde '.APLICACION.'<b>
    <br>
    <em>Mensaje generado automáticamente al verificar correo<em>';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'sergio.lkg.31@gmail.com';                     // SMTP username
        $mail->Password   = '01237896540818M';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('admin@admin.com', 'Administrador');
        $mail->addAddress($destinatario, $nombres);     // Add a recipient

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $altbody;
        $mail->AltBody = $header;

        $mail->send();
        $respone['respuesta'] = 'Mensaje Enviado';
    } catch (Exception $e) {
        $response['error']  = "Hubo un error al enviar el correo. Mailer Error: {$mail->ErrorInfo}";
    }

    $response['result'] = 'true';
    $response['altbody'] = $altbody;
}else{
    $response['result'] = 'false';
}

echo json_encode($response);
$peticionAjax = false;