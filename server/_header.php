<?php require_once '_header.mandatory.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title><?= $config->title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $config->description ?>" />
    <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    
    <script src="jquery-ui/external/jquery/jquery.js"></script>
    <script src="jquery-ui/jquery-ui.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=<?= $t->getLanguageCode() ?>'></script>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
       body {font-family: 'Open Sans', sans-serif;}
    </style>
</head>
    
<body>
    
 <nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= $config->homepage ?>"><span class="glyphicon glyphicon-book"> <?= $config->homepageName ?></span></a>
    </div>
  </div>
</nav>


<?php
 $message = $_SESSION['message'];
 if ($message != '') {?>
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?= $fmw->escapeHtml($message) ?>
    </div>
<?php } ?>
    
<?php
 $message = $_SESSION['error_message'];
 if ($message != '') {?>
    <div class="alert alert-danger" role="alert">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      <?= $fmw->escapeHtml($message) ?>
    </div>
 <?php }  ?>