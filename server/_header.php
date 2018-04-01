<?php require_once '_header.mandatory.php' ?>
<?php
    $config->about = $database->select("tb_about", "*");
    $config->about = $config->about[0];

    // Meddo put lots of \ in the HTML. Let's remove them.
    $config->about['site_welcome'] = str_replace(array('\\'),'',$config->about['site_welcome']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Divaldo Franco, Bruxelles, 13/05/2018" />
    <meta name="keywords" content="divaldo franco, neecafla" />
    <title>Divaldo Franco, Bruxelles, 13/05/2018</title>
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
      <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-book"> NEECAFLA</span></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

          <li><a href='' onClick="javascript:_changeLanguage('Português')"> Português </a></li>
          <li><a href='' onClick="javascript:_changeLanguage('Français')"> Français </a></li>
          <li><a href='' onClick="javascript:_changeLanguage('English')"> English </a></li>

      </ul>
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