<?php
  include_once '_header.mandatory.php';
  include '_header.php';
?>

<script>
    function confirmation() {
        if (confirm("<?= $t->__('inscription.question.confirm') ?>")) {
            document.forms["myform"].submit();
        }
    }
</script>

<h1><?= $t->__('inscription.title') ?></h1>

<form action="inscriptionSave.php" method="post" id="myform">

<div class="row">
<div class="col-sm-10">

  <!-- Name --> 
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.name') ?>:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="name" value=<?= $fmw->getPostOrArrayQuoted($columns, 'name') ?> maxlength="50" />
    </div>
  </div>

  <!-- Familly Name -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.famillyName') ?>:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="famillyName"  value=<?= $fmw->getPostOrArrayQuoted($columns, 'famillyName') ?> maxlength="50" />
    </div>
  </div>
    
  <!-- E-mail -->
  <div class="form-group">
    <label class="control-label col-sm-2"><?= $t->__('inscription.label.email') ?>:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="email" value=<?= $fmw->getPostOrArrayQuoted($columns, 'email') ?> maxlength="100" />
    </div>
  </div>
    
  <!-- Recaptcha -->
  <div class="form-group">
    <label class="control-label col-sm-2">&nbsp;</label>
    <div class="col-sm-10">
        <div class="g-recaptcha" data-sitekey="6LcUCk8UAAAAAB6E1JiwKkDmoLTeuKbFzELMe0pT"></div> 
    </div>
  </div>
    
</div>    
</div>

<!-- Buttons -->
<div class="row">
    <div class="col-sm-10">
        
      <div class="form-group">
        <label class="control-label col-sm-2">&nbsp;</label>
        <div class="col-sm-10">
              <input type="button" class="btn btn-default" value="<?= $t->__('button.save') ?>" onclick="confirmation()" />
              <input type="button" class="btn btn-default" value="<?= $t->__('button.cancel') ?>" onclick="window.location.href='inscription.php'" />
        </div>
      </div>
        
    </div>
</div>
    
</form>

<?php include '_footer.php' ?>