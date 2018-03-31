<?php
  include_once '_header.mandatory.php';
  include '_header.php';
?>

<h1><?= $t->__('inscription.title.confirmed') ?></h1>

<img src="images/valid.png" align="left" />
<br/>
<h3><?= $t->__('inscription.label.id') ?>&nbsp;<?= $_SESSION['inscription_id'] ?></h3>

<div class="row">
<div class="col-sm-10">

  <!-- Name --> 
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.name') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-2"><?= $_SESSION['name'] ?></label>
    </div>
  </div>

  <!-- Familly Name -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.famillyName') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-2"><?= $_SESSION['famillyName'] ?></label>
    </div>
  </div>
    
  <!-- E-mail -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.email') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-2"><?= $_SESSION['email'] ?></label>
    </div>
  </div>
    
  <!-- E-mail -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.timestamp') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-10"><?= $_SESSION['timestamp'] ?></label>
    </div>
  </div>
    
</div>    
</div>

<div class="alert alert-warning" role="alert">

    <?= $t->__('inscription.message.warning') ?>
<!--
    <strong>Attention:</strong> Your inscription is not yet completed, you still need to pay 3 EUR in order to help us cover costs of the event.
    <br/>
    <br/>
    You have two options to pay:
    <br/>&nbsp;&nbsp;- Directly at NEECAFLA ASBL in cash
    <br/>&nbsp;&nbsp;- Via a transfer to our account BE. In the communication use "Divaldo 2018 + Name FamillyName"
    <br/>
    <br/>
    <strong>Without your payment, your inscription is not valid !</strong>
-->

</div>

<!-- Buttons -->
<div class="row">
    <div class="col-sm-10">
        
      <div class="form-group">
        <label class="control-label col-sm-2">&nbsp;</label>
        <div class="col-sm-10">
              <input type="button" class="btn btn-default" value="<?= $t->__('button.newInscription') ?>" onclick="window.location.href='inscription.php'" />
                <input type="button" class="btn btn-default" value="<?= $t->__('button.goToHome') ?>" onclick="window.location.href='http://www.neecafla.be'" />
        </div>
      </div>
        
    </div>
</div>

<?php include '_footer.php' ?>