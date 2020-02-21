<?php
  include_once '_header.mandatory.php';
  $fmw->checkAdmin();
  include '_header.php';
?>

<script>
    function confirmPayment(id) {
        if (confirm("<?= $t->__('admin.question.confirmPayment') ?>")) {
            document.forms['myform' + id].elements["action"].value = 'payment';
            document.forms['myform' + id].submit();
        }
    }
    function confirmSave(id) {
        if (confirm("<?= $t->__('admin.question.confirmSave') ?>")) {
            document.forms['myform' + id].elements["action"].value = 'save';
            document.forms['myform' + id].submit();
        }
    }
    function confirmPaymentRemoval(id) {
        if (confirm("<?= $t->__('admin.question.confirmPaymentRemoval') ?>")) {
            window.location = "adminAction.php?action=paymentRemoval&id=" + id;
        }
    }
    function confirmCancellation(id) {
        if (confirm("<?= $t->__('admin.question.confirmCancellation') ?>")) {
            window.location = "adminAction.php?action=cancellation&id=" + id;
        }
    }
    function confirmCancellationRemoval(id) {
        if (confirm("<?= $t->__('admin.question.confirmCancellationRemoval') ?>")) {
            window.location = "adminAction.php?action=cancellationRemoval&id=" + id;
        }
    }
</script>

<table class="table table-hover">
    <tr>
        <th>&nbsp;</th>
        <th><?= $t->__('inscription.label.name') ?></th>
        <th><?= $t->__('inscription.label.familyName') ?></th>
        <th><?= $t->__('inscription.label.email') ?></th>
        <th><?= $t->__('inscription.label.option') ?></th>
        <th><?= $t->__('inscription.label.timestamp') ?></th>
        <th><?= $t->__('ip') ?></th>
        <th><?= $t->__('inscription.label.paymentDate') ?></th>
        <th><?= $t->__('inscription.label.paymentValue') ?></th>
        <th><?= $t->__('inscription.label.paymentMethod') ?></th>
        <th><?= $t->__('action') ?></th>
    </tr>
<?php

$datas = $database->select($config->inscription_table, "*");
                    
// About valid inscriptions
$nbValidRegistrations = 0;
$nbPayments = 0;
$valuePayments = 0;

$qttPaymentMethod = [];
$valuePaymentMethod = [];
$qttOptionTotal = [];
$qttOptionPaid = [];
$qttOptionNotPaid = [];
$qttOptionCancelled = [];
                    
// About cancellations
$nbCancels = 0;
$valueCancels = 0;
                    
foreach($datas as $row) {
    $fmw->escapeHtmlArray($row);

    $paymentDate = date('d/m/Y', time());
    $paymentValue = $row['paymentValue'];
    $paymentMethod = $row['paymentMethod'];
    if ($row['canceled'] == 1) {
        echo "<tr class='warning' style='text-decoration: line-through'>";   
    } else if ($row['payment'] == 1) {
        echo "<tr class='success'>";
    } else if ($row['id'] == $_POST['id']) {
        echo "<tr class='danger'>";
        $paymentDate = $_POST['paymentDate'];
        $paymentValue = $_POST['paymentValue'];
        $paymentMethod = $_POST['paymentMethod'];
    } else {
        echo "<tr>";
    }
    
    $id = $row['id'];
    echo "<td>", $id, "</td>";
    echo "<td>", $row['name'], "</td>";
    echo "<td>", $row['familyName'], "</td>";
    echo "<td>", $row['email'], "</td>";
    echo "<td>", $row['selectedOption'], "</td>";
    echo "<td>", $row['timestamp'], "</td>";
    echo "<td>", $row['ipaddress'], "</td>";

    $selectedOption = $row['selectedOption'];
    $qttOptionTotal[$selectedOption]++;
    
    if ($row['canceled'] == 0) {    
        $nbValidRegistrations++;
        if ($row['payment'] == 1) {
            $nbPayments++;
            $valuePayments += $row['paymentValue'];
            $qttOptionPaid[$selectedOption]++;
        } else {
            $qttOptionNotPaid[$selectedOption]++;
        }
        $paymentMethod = $row['paymentMethod'];
        $qttPaymentMethod[$paymentMethod]++;
        $valuePaymentMethod[$paymentMethod] += $row['paymentValue'];
    } else {
        $nbCancels++;
        $valueCancels += $row['paymentValue'];
        $qttOptionCancelled[$selectedOption]++;
    }
    
    if ($row['canceled'] == 1) {
        echo "<td>", substr($row['paymentDate'], 0, 10), "</td>";
        echo "<td>", $row['paymentValue'], "</td>";
        echo "<td>", $row['paymentMethod'], "</td>";
        echo "<td>";
        echo "<input type='button' value='O' onClick='javascript:confirmCancellationRemoval(", $id, ")'/>";
        echo "</td>";
    } else if ($row['payment'] == 1) {
        echo "<td>", substr($row['paymentDate'], 0, 10), "</td>";
        echo "<td>", $row['paymentValue'], "</td>";
        echo "<td>", $row['paymentMethod'], "</td>";
        echo "<td>";
        echo "<input type='button' value='", $t->__('admin.button.removePayment') ,"' onClick='javascript:confirmPaymentRemoval(", $id, ")'/>";
        echo "<input type='button' value='X' onClick='javascript:confirmCancellation(", $id, ")'/>";
        echo "</td>";
    } else {
        echo "<form action='adminAction.php' method='post' id='myform", $id ,"'>";
        echo "<input type='hidden' name='id'     value='", $id ,"'/>";
        echo "<input type='hidden' name='action'/>";
        echo "<td><input type='text' name='paymentDate' size='10' value='", $paymentDate, "' id='datepicker", $id, "'/></td>";
        ?>
        <script>
            $(function() {
                $( "#datepicker<?= $id?>" ).datepicker({ dateFormat: "dd/mm/yy" });
            });
        </script>
        <?
        echo "<td><input type='text' name='paymentValue' size='10' value='", $paymentValue ,"'/></td>";
        echo "<td><input type='text' name='paymentMethod' size='10' value='", $paymentMethod ,"'/></td>";
        echo "<td>";
        echo "<input type='button' value='", $t->__('admin.button.savePayment') ,"' onClick='javascript:confirmPayment(", $id, ")'/>";
        echo "<input type='button' value='", $t->__('admin.button.save') ,"' onClick='javascript:confirmSave(", $id, ")'/>";
        echo "<input type='button' value='X' onClick='javascript:confirmCancellation(", $id, ")'/>";
        echo "</td>";
        echo "</form>";
    }

    echo "</tr>\n";
}

?>

</table>

<?= $t->__('admin.label.numberRegistrations') ?>: <?= $nbValidRegistrations ?><br/>
<?= $t->__('admin.label.numberPayments') ?>: <?= $nbPayments ?> (<?= number_format($valuePayments, 2, ",", ".") ?> $)<br/><br/>



<h1><?= $t->__('admin.summaryPaymentMethod.title') ?></h1>
<table class='table table-striped'>
<tr><th><?= $t->__('inscription.label.paymentMethod')?></th><th>Number</th><th>Value</th></tr>
<?
    foreach ($qttPaymentMethod as $key => $value) {
      echo "<tr><td>{$key}</td><td>{$value}</td><td>" . number_format($valuePaymentMethod[$key], 2, ",", ".") . "&nbsp;$</td></tr>";
    }
?>
</table>

<br/>

<?= $t->__('admin.label.numberCancels') ?>: <?= $nbCancels ?> (<?= number_format($valueCancels, 2, ",", ".") ?> $)<br/>
<?= $t->__('admin.label.valueTotal') ?>: <?= number_format($valuePayments + $valueCancels, 2, ",", ".") ?> $

<br/>
<br/>


<?php if ( checkOptionsAvailable() ) { ?>

<h1><?= $t->__('admin.summaryOptions.title') ?></h1>
<table class='table table-striped'>
<tr><th><?= $t->__('inscription.label.option')?></th><th>Total</th><th>Paid</th><th>Not Paid</th><th>Cancelled</th></tr>
<?
    foreach ($qttOptionTotal as $key => $value) {
      echo "<tr><td>{$key}</td><td>{$value}</td>";
      echo "<td>{$qttOptionPaid[$key]}&nbsp;</td>";
      echo "<td>{$qttOptionNotPaid[$key]}&nbsp;</td>";
      echo "<td>{$qttOptionCancelled[$key]}&nbsp;</td>";
      echo "</tr>";
    }
?>
</table>

<br/>
<br/>

<?php } ?>


<form action="logout.php" method="post">
  <input type="submit" value="Logout"/>
</form>

<?php include '_footer.php' ?>