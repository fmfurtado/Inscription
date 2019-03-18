<?php
  $fmw->clearMessages();
?>    
    <script>
        function _changeLanguage(languageToSet) {
           $.get("_changeLanguage.php?_language=" + languageToSet, function(data,status) {
              // alert('language was set, reload URL here');
           });
        }
    </script>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>