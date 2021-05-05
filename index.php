<?php
if (isset($_POST['submit'])) {
    $username = 'hassan';
    $pass = '1234';
    session_start();
    $_session['login'] = false;
    if ($username === $_POST['user'] && $pass === $_POST['pass']) {
        $_session['login'] = true;
        header('location: home.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <link rel="stylesheet" href="templates/lgcss.css">
</head>

<body>
    <div class="row">
        <div class="col-md-6 mx-auto my-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"> </label>
                        <div class="login-space">
                            <form class="login" method="POST">
                                <div class="group"> <label for="user" class="label">Username</label> <input id="user" type="text" name="user" class="input" placeholder="Enter your username"> </div>
                                <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" type="password" name="pass" class="input" data-type="password" placeholder="Enter your password"> </div>
                                <div class="group"> <input id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Keep me Signed in</label> </div>
                                <div class="group"> <input type="submit" name="submit" class="button" value="Sign In"> </div>
                                <div class="hr"></div>
                                <div class="foot"> <a href="#">Forgot Password?</a> </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</body>

</html>