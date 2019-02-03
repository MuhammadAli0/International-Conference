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

            $this->mail->addAddress("safaasms@hotmail.com", "  ");

            $this->mail->WordWrap = 50;

            $this->mail->isHTML(true);
            $this->mail->CharSet = 'UTF-8';

            $this->mail->Subject = "SomeOne Registed";
            $this->mail->Body =  `<!DOCTYPE html>
            <html lang="en">
            <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            "Content-Type: text/plain; charset=UTF-8\r\n"               </head>
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
    $filterHeaderValue = function ($value) {
        return str_replace(array("\r", "\n"), '', trim($value));
    };
    
    $data=$request->getParsedBody();
    $mail = new mailer();
    try{
        $mail->load();
        $rData = '<br> <table dir="rtl" class="table table-light" style="border-collapse: collapse; color: #0c3950;text-align: center;">
        <tr>
                  <th>الاسم</th>
                  <th>البريد الالكترونى</th>
                  <td>الهاتف</td>
                  <td>العضويه</td>
                  <td>الملاحظات</td>
                </tr>
                <tbody> <tr>';
        foreach($data as &$value){
            $rData = $rData . '<th>' . $filterHeaderValue($value) . '</th>';

        }
        $rData = $rData . '</tr></tbody>';
        $mail->sendMail($rData);
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

