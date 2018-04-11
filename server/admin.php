<?php
  include_once '_header.mandatory.php';
  $fmw->checkAdmin();
  include '_header.php';
?>

<script>
    function confirmPayment(id) {
        if (confirm("<?= $t->__('admin.question.confirmPayment') ?>")) {
            document.forms['myform' + id].submit();
        }
    }
    function confirmPaymentRemoval(id) {
        if (confirm("<?= $t->__('admin.question.confirmPaymentRemoval') ?>")) {
            window.location = "adminAction.php?action=paymentRemoval&id=" + id;
        }
    }
</script>

<table class="table table-hover">
    <tr>
        <th>&nbsp;</th>
        <th><?= $t->__('inscription.label.name') ?></th>
        <th><?= $t->__('inscription.label.familyName') ?></th>
        <th><?= $t->__('inscription.label.email') ?></th>
        <th><?= $t->__('inscription.label.timestamp') ?></th>
        <th><?= $t->__('ip') ?></th>
        <th><?= $t->__('inscription.label.paymentDate') ?></th>
        <th><?= $t->__('inscription.label.paymentValue') ?></th>
        <th><?= $t->__('inscription.label.paymentMethod') ?></th>
        <th><?= $t->__('action') ?></th>
    </tr>
<?php

$datas = $database->select($config->inscription_table, "*");
$nbPayments = 0;
$nbRegistrations = 0;
$total = 0;

foreach($datas as $row) {
    $fmw->escapeHtmlArray($row);

    $paymentDate = date('d/m/Y', time());
    $paymentValue = 0;
    $paymentMethod = 'bank';
    if ($row['payment'] == 1) {
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
    echo "<td>", $row['timestamp'], "</td>";
    echo "<td>", $row['ipaddress'], "</td>";

    $nbRegistrations++;
    if ($row['payment'] == 1) {
        echo "<td>", substr($row['paymentDate'], 0, 10), "</td>";
        echo "<td>", $row['paymentValue'], "</td>";
        echo "<td>", $row['paymentMethod'], "</td>";
        echo "<td>";
        echo "<input type='button' value='", $t->__('admin.button.removePayment') ,"' onClick='javascript:confirmPaymentRemoval(", $id, ")'/>";
        echo "</td>";
        $nbPayments++;
        $total += $row['paymentValue'];
    } else {
        echo "<form action='adminAction.php' method='post' id='myform", $id ,"'>";
        echo "<input type='hidden' name='id' value='", $id ,"'/>";
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
        echo "</td>";
        echo "</form>";
    }

    echo "</tr>\n";
}

?>

</table>

<?= $t->__('admin.label.numberRegistrations') ?>: <?= $nbRegistrations ?><br/>
<?= $t->__('admin.label.numberPayments') ?>: <?= $nbPayments ?> (<?= number_format($total, 2, ",", ".") ?> $)
<br/>
<br/>

<form action="logout.php" method="post">
  <input type="submit" value="Logout"/>
</form>

<?php include '_footer.php' ?>