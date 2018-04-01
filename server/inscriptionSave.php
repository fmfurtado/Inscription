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

$familyName = $_POST['familyName'];
if ($familyName == '') {
    $fmw->error('inscription.message.familyNameMandatory');
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
    "familyName" => $familyName,
    "email" => $email,
    "ipaddress" => $fmw->getUserIP(),
    "#timestamp" => "STR_TO_DATE('" . $timestamp . "','%d/%m/%Y %H:%i:%s')"
);
    
$inscription_id = $database->insert($config->inscription_table, $columns);    

$fmw->checkDatabaseError();

// Send e-mail to the person
$subject = $t->__('inscription.title.confirmed');
$headers = 'From: NEECAFLA ASBL <info@neecafla.be>' . "\r\n" .
    'Reply-To: info@neecafla.be' . "\r\n" .
    'Bcc: info@neecafla.be' . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . "\r\n" .
    'Content-Type: text/html; charset=utf-8\r\n';

$warning = $t->__('inscription.message.warning');
$body    = $t->__('inscription.email.body', $name, $inscription_id, $warning);
$body = wordwrap($body,70);

mail($email, $subject, $body, $headers);

$_SESSION['inscription_id'] = $inscription_id;
$_SESSION['name'] = $name;
$_SESSION['familyName'] = $familyName;
$_SESSION['email'] = $email;
$_SESSION['timestamp'] = $timestamp;

header("Location: inscriptionConfirmed.php");
?>