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
    private $EmailPassword = "zddtgyqrecuuubru";
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

            $this->mail->addAddress("safaasms@hotmail.com", "D.r Safaa Sayed");

            $this->mail->WordWrap = 50;

            $this->mail->isHTML(true);
            $this->mail->CharSet = 'UTF-8';

            $this->mail->Subject = "بيانات تسجيل للمؤتمر";
            $this->mail->Body = $body;

            $this->mail->AltBody = $this->footer;

            $this->mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
}


$app->post('/', function ($request, $response) {
    $filterHeaderValue = function ($value) {
        return str_replace(array("\r", "\n"), '', trim($value));
    };

    $data = $request->getParsedBody();



    $mail = new mailer();
    try {
        $mail->load();
    
        $rData = '<html lang="en"><head><style>.table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}.table tbody+tbody{border-top:2px solid #dee2e6}.table .table{background-color:#fff}.table-sm td,.table-sm th{padding:.3rem}.table-bordered{border:1px solid #dee2e6}.table-bordered td,.table-bordered th{border:1px solid #dee2e6}.table-bordered thead td,.table-bordered thead th{border-bottom-width:2px}.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}.table-hover tbody tr:hover{background-color:rgba(0,0,0,.075)}.table-primary,.table-primary>td,.table-primary>th{background-color:#b8daff}.table-hover .table-primary:hover{background-color:#9fcdff}.table-hover .table-primary:hover>td,.table-hover .table-primary:hover>th{background-color:#9fcdff}.table-secondary,.table-secondary>td,.table-secondary>th{background-color:#d6d8db}.table-hover .table-secondary:hover{background-color:#c8cbcf}.table-hover .table-secondary:hover>td,.table-hover .table-secondary:hover>th{background-color:#c8cbcf}.table-success,.table-success>td,.table-success>th{background-color:#c3e6cb}.table-hover .table-success:hover{background-color:#b1dfbb}.table-hover .table-success:hover>td,.table-hover .table-success:hover>th{background-color:#b1dfbb}.table-info,.table-info>td,.table-info>th{background-color:#bee5eb}.table-hover .table-info:hover{background-color:#abdde5}.table-hover .table-info:hover>td,.table-hover .table-info:hover>th{background-color:#abdde5}.table-warning,.table-warning>td,.table-warning>th{background-color:#ffeeba}.table-hover .table-warning:hover{background-color:#ffe8a1}.table-hover .table-warning:hover>td,.table-hover .table-warning:hover>th{background-color:#ffe8a1}.table-danger,.table-danger>td,.table-danger>th{background-color:#f5c6cb}.table-hover .table-danger:hover{background-color:#f1b0b7}.table-hover .table-danger:hover>td,.table-hover .table-danger:hover>th{background-color:#f1b0b7}.table-light,.table-light>td,.table-light>th{background-color:#fdfdfe}.table-hover .table-light:hover{background-color:#ececf6}.table-hover .table-light:hover>td,.table-hover .table-light:hover>th{background-color:#ececf6}.table-dark,.table-dark>td,.table-dark>th{background-color:#c6c8ca}.table-hover .table-dark:hover{background-color:#b9bbbe}.table-hover .table-dark:hover>td,.table-hover .table-dark:hover>th{background-color:#b9bbbe}.table-active,.table-active>td,.table-active>th{background-color:rgba(0,0,0,.075)}.table-hover .table-active:hover{background-color:rgba(0,0,0,.075)}.table-hover .table-active:hover>td,.table-hover .table-active:hover>th{background-color:rgba(0,0,0,.075)}.table .thead-dark th{color:#fff;background-color:#212529;border-color:#32383e}.table .thead-light th{color:#495057;background-color:#e9ecef;border-color:#dee2e6}.table-dark{color:#fff;background-color:#212529}.table-dark td,.table-dark th,.table-dark thead th{border-color:#32383e}.table-dark.table-bordered{border:0}.table-dark.table-striped tbody tr:nth-of-type(odd){background-color:rgba(255,255,255,.05)}.table-dark.table-hover tbody tr:hover{background-color:rgba(255,255,255,.075)}@media (max-width:575.98px){.table-responsive-sm{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-sm>.table-bordered{border:0}}@media (max-width:767.98px){.table-responsive-md{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-md>.table-bordered{border:0}}@media (max-width:991.98px){.table-responsive-lg{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-lg>.table-bordered{border:0}}@media (max-width:1199.98px){.table-responsive-xl{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive-xl>.table-bordered{border:0}}.table-responsive{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar}.table-responsive>.table-bordered{border:0}
        </style><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"></head><body dir="rtl"><table class="table table-bordered"><thead class="table-dark"><tr><th>الاسم</th><th>البريد الالكترونى</th><th>الهاتف</th><th>العضويه</th><th>التكلفه</th><th>الملاحظات</th></tr></thead><tbody><tr><th class="table-success">'. $filterHeaderValue($data['name']) .'</th><th class="table-info">'. $filterHeaderValue($data['email']) .'</th><th class="table-info">'. $filterHeaderValue($data['phone']) .'</th><th class="table-primary">'. $filterHeaderValue($data['type']) .'</th><th class="table-danger">'. $filterHeaderValue($data['cost']) .'</th><th class="table-active">'. $filterHeaderValue($data['note']) .'</th></tr></tbody></table></body></html>';

        $mail->sendMail($rData);
        $response->write(json_encode(array(
            "status" => 200,
            "message" => "success"
        )));
    } catch (Exception $e) {
        $response->write(json_encode(array(
            "status" => 500,
            "error" => $e
        )));
    }

});
$app->run();









?>

