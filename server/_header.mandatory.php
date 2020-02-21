<?php
  require_once 'medoo.php';
  require_once 'configuration.php';
  require_once '_framework.php';
  require_once '_translator.php';
  require_once '_audit.php';

  $config = new EBBConfig();
  session_start();

  // Setting the language to be used into the session
  if (isset($_GET['_language'])) {
      $language_to_set = $_GET['_language'];
      if ($language_to_set != 'fr' and $language_to_set != 'pt') {
          $language_to_set = 'en';
      }
      $_SESSION['_lang'] = $language_to_set;
  }

  // Getting the language to be used
  if (isset($_SESSION['_lang'])) {
      $config->language = $_SESSION['_lang'];
  }

  // Object for translating text
  $t = new Translator($config->language);

  $fmw = new Framework($config, $t);
  $database = $fmw->database;
  $audit = $fmw->audit;

  // Check if there are inscription options available to be shown
  function checkOptionsAvailable() {
      global $t;
      return strcmp($t->__('inscription.option1'), 'inscription.option1') != 0;
  }
?>