<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,
]];
$app = new \Slim\App($config);
date_default_timezone_set('UTC');

class mailer
{
    private $host = "smtp.gmail.com";
    private $smtpAut = true;
    private $EmailAddress = "mohamed007258@gmail.com";
    private $EmailPassword = "Imiss2egy";
    private $smtpProto = "tls";
    private $mailPort = 587;
    private $mail;

    private $body;
    private $footer = "\n \n\ \n \nCreated By organizing team";


    public function load()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = $this->host;
        $this->mail->SMTPAuth = $this->smtpAut;
        $this->mail->Username = $this->EmailAddress;
        $this->mail->Password = $this->EmailPassword;
        $this->mail->SMTPSecure = $this->smtpProto;
        $this->mail->Port = $this->mailPort;
    }



    public function sendMail($body)
    {
        try {
            $this->mail->From = $this->EmailAddress;
            $this->mail->FromName = "Mohammed Ali";

            $this->mail->addAddress("mohammedali@mail.uk", "  ");

            $this->mail->WordWrap = 50;

            $this->mail->isHTML(true);

            $this->mail->Subject = "SomeOne Registed";
            $this->mail->Body =  `<!DOCTYPE html>
            <html lang="en">
            <head>
              <!-- Required meta tags 
              </head>
              <body>
              <p><B> `. $body .` </B></p>
              </body></html>` ;

            $this->mail->AltBody = $this->footer;

            $this->mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
}


$app->post('/', function($request, $response){
    $data=$request->getParsedBody();
    $mail = new mailer();
    try{
        $mail->load();
        $mail->sendMail(json_encode($data, JSON_UNESCAPED_UNICODE));
        $response->write(json_encode(array(
            "status" => 200,
            "message" => "Success"
        )));
    }catch (Exception $e) {
        $response->write(json_encode(array(
            "status" => 500,
            "error" => $e
        )));
    }
    
});
$app->run();


 






?>

