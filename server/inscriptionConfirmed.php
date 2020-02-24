<?php
  include_once '_header.mandatory.php';
  include '_header.php';
?>

<h1><?= $t->__('inscription.title.confirmed') ?></h1>

<div class="row">
<div class="col-sm-2">
    <img src="images/valid.png"/>
</div>
    
<div class="col-sm-10">
  <h3><?= $t->__('inscription.label.id') ?>&nbsp;<?= $_SESSION['inscription_id'] ?></h3>
    
  <!-- Name --> 
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.name') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-2"><?= $_SESSION['name'] ?></label>
    </div>
  </div>

  <!-- Family Name -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.familyName') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-2"><?= $_SESSION['familyName'] ?></label>
    </div>
  </div>
    
  <!-- E-mail -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.email') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-2"><?= $_SESSION['email'] ?></label>
    </div>
  </div>

<?php if ( checkOptionsAvailable() ) { ?>
  <!-- Option -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.option') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-10"><?= $_SESSION['option'] ?>&nbsp;</label>
    </div>
  </div>
<?php } ?>
    
  <!-- Timestamp -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.timestamp') ?>:</label>
    <div class="col-sm-10">
        <label class="control-label col-sm-10"><?= $_SESSION['timestamp'] ?></label>
    </div>
  </div>
    
</div>    
</div>

<div class="alert alert-warning" role="alert">

    <?= $t->__('inscription.email.body', $_SESSION['name'], $_SESSION['inscription_id'], $_SESSION['option']) ?>

</div>

<!-- Buttons -->
<div class="row">
    <div class="col-sm-10">
        
      <div class="form-group">
        <label class="control-label col-sm-2">&nbsp;</label>
        <div class="col-sm-10">
              <input type="button" class="btn btn-default" value="<?= $t->__('button.newInscription') ?>" onclick="window.location.href='inscription.php'" />
                <input type="button" class="btn btn-default" value="<?= $t->__('button.goToHome') ?>" onclick="window.location.href='<?= $config->homepage ?>'" />
        </div>
      </div>
        
    </div>
</div>

<?php include '_footer.php' ?>