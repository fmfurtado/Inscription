<?php include '_header.mandatory.php';

$redirection = "login.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == $config->admin_username and $password == $config->admin_password) {
        $fmw->login($username, 9);
        $fmw->info('login.message.loginSuccessful');
        $redirection = "admin.php";
    } else {
        $fmw->error('login.message.loginFailed');
    }
}

header("Location: " . $redirection);

?>