<?php require_once '_header.mandatory.php';

// First, we check the recaptcha
if (!$fmw->isRecaptchaValid('6LcUCk8UAAAAAM9CaJsM6Lad7h0lRyw3kquZYPD3')) {
    $fmw->error('inscription.message.youAreABot');
    include("inscription.php");
    exit();
} 

$name = $_POST['name'];
if ($name == '') {
    $fmw->error('inscription.message.nameMandatory');
    include("inscription.php");
    exit();
}

$famillyName = $_POST['famillyName'];
if ($famillyName == '') {
    $fmw->error('inscription.message.famillyNameMandatory');
    include("inscription.php");
    exit();
}

$email = $_POST['email'];
if ($email == '') {
    $fmw->error('inscription.message.emailMandatory');
    include("inscription.php");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fmw->error('inscription.message.emailInvalid');
    include("inscription.php");
    exit();
}

$timestamp = date('d/m/Y H:i:s');
$columns = array(
    "name" => $name,
    "famillyName" => $famillyName,
    "email" => $email,
    "ipaddress" => $fmw->getUserIP(),
    "#timestamp" => "STR_TO_DATE('" . $timestamp . "','%d/%m/%Y %H:%i:%s')"
);
    
$inscription_id = $database->insert($config->inscription_table, $columns);    

$fmw->checkDatabaseError();

// Send e-mail to the person
$subject = 'Subject'; //$t->__('inscription.email.subject');
$msg = 'Message to send'; //$t->__('inscription.email.body');
$headers = 'From: info@neecafla.be' . "\r\n" .
    'Reply-To: info@neecafla.be' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($email, $subject, $msg, $headers);

$_SESSION['inscription_id'] = $inscription_id;
$_SESSION['name'] = $name;
$_SESSION['famillyName'] = $famillyName;
$_SESSION['email'] = $email;
$_SESSION['timestamp'] = $timestamp;

header("Location: inscriptionConfirmed.php");
?>