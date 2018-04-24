<?php require_once '_header.mandatory.php';

$fmw->checkAdmin();

$id = $_REQUEST['id'];
if ($id == '') {
    $fmw->error('admin.message.registrationDoesNotExist');
    include('admin.php');
    exit();
}

if ($_REQUEST['action'] == "paymentRemoval") {

    $columns = array(
        "payment" => 0,
        "paymentDate" => NULL,
        "paymentValue" => NULL,
        "paymentMethod" => NULL
    );
    $messageInfo = 'admin.message.paymentRemoved';

} else if ($_REQUEST['action'] == "cancellation") {

    $columns = array(
        "canceled" => 1
    );
    $messageInfo = 'admin.message.cancellation';
    
} else if ($_REQUEST['action'] == "cancellationRemoval") {

    $columns = array(
        "canceled" => 0
    );
    $messageInfo = 'admin.message.cancellationRemoval';
    
} else {

    $paymentDate = $_POST['paymentDate'];
    $paymentValue = $_POST['paymentValue'];
    if (!is_numeric($paymentValue)) {
        $fmw->error('admin.message.valueNotNumber');
    } else if (!$fmw->verifyDate($paymentDate)) {
      $fmw->error('admin.message.dateNotValid');
    }
    
    if ($fmw->hasError()) {
       include('admin.php');
       exit();
    }
    
    $columns = array(
        "payment" => 1,
        "#paymentDate" => "STR_TO_DATE('" . $paymentDate . "','%d/%m/%Y')",
        "paymentValue" => $paymentValue,
        "paymentMethod" => $_POST['paymentMethod']
    );
    $messageInfo = 'admin.message.paymentSaved';
}

$database->update($config->inscription_table, $columns, array("id[=]" => $id));
$fmw->info($messageInfo, $id);  

$fmw->checkDatabaseError();

header("Location: admin.php");
?>