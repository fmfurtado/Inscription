<?php include '_header.php' ?>

<div class="container" style="margin-top:30px">
    <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading"><h3 class="panel-title"><strong><?= $t->__('login.title') ?> </strong></h3></div>
          <div class="panel-body">
           <form id="login" action="loginAttempt.php" method="post" role="form">
              <div class="form-group">
                <label for="exampleInputEmail1"><?= $t->__('login.username') ?></label>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="username" type="text" name='username' class="form-control" id="exampleInputEmail1" placeholder="<?= $t->__('login.tip.username') ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"><?= $t->__('login.password') ?></label>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="<?= $t->__('login.tip.password') ?>">
                </div>
              </div>

              <button type="submit" class="btn btn-sm btn-default"><?= $t->__('login.button.login') ?></button>
            </form>
          </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        // Focus on username
        $('#username').focus();
    });
</script>

<?php include '_footer.php' ?>