<?php 
    session_start();
    $file_dir = '../';
    require $file_dir.'inc/db.inc.php';
    require $file_dir.'inc/config.inc.php'; 
    require $file_dir.'inc/mail.inc.php'; 

    if (isset($_SESSION["loggedIn"]) == true || isset($_SESSION["loggedIn"]) === true) {
        $signedIn = true;
    } else {}
    $signedIn = false;
    $message = [];

    if (isset($_POST['create-account'])) {

        $email = sanitizePlus($_POST["email"]);
        $password = sanitizePlus($_POST["password"]);
        $c_password = sanitizePlus($_POST["c_password"]);
        $f_name = sanitizePlus($_POST["firstname"]);
        $l_name = sanitizePlus($_POST["lastname"]);
        $datetime = date("Y-m-d H:i:s");

        if (isset($email) && isset($password) && isset($c_password) && isset($f_name) && isset($l_name)) {
            # confirm password
            if ($password === $c_password) {
                #select all mails
                $CheckIfUserExist = "SELECT * FROM newcomers_users WHERE email = '$email' LIMIT 1";
                $UserExist = $con->query($CheckIfUserExist);
                if ($UserExist->num_rows > 0) {
                    #error, user already exists
                    array_push($message, "Error 402: Email Already Exists!!");
                }else{
                    #send registration email
                    $otp = secure_random_string(10).'-'.secure_random_string(10).'-'.secure_random_string(10);
                    $confirmation_link = 'https://newcomersunion.com/auth/activate-account?e='.weirdlyEncode($email).'&auth='.$otp;
                    $subject = 'New Comers Union - Activate Account Email Address (OTP)';
                    $recipient = $email;
                    $sender = $regMailSender;
                    #$mailBody = 'Your One-Time Confirmation Link is:' . $confirmation_link;

                    $_sentmail = _reg($sender, $recipient, $subject, $confirmation_link);
                    if ($_sentmail['sent'] == 'true') {
                        #encrypt password
                        $password = weirdlyEncode($password);
                        #add user to db
                        $createNewUser = "INSERT INTO newcomers_users (`email`, `password`, `firstname`, `lastname`, `phone`, `activated`, `otp`, `token`) VALUES ('$email', '$password', '$f_name', '$f_name', '$phone', 'false', '$confirmation_link', '$otp')";
                        $userCreated = $con->query($createNewUser);
                        if ($userCreated) {
                            #done
                            #redirect to activate-account.php
                            
                        }else{
                           #error, error inserting to db 
                        }
                    }else{
                        #error, otp unsuccessful
                        array_push($message, "Error 502: Error Sending OTP!! ".$_sentmail['error']);
                    }
                }
            } else {
                #error, password doesnt matvh
            }     
        } else {
            # error ,missing params
            array_push($message, "Error 402: Missing Registration Parameters!!");
        }
        

        
        
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account <?php echo $site; ?></title>

    <?php include $file_dir.'inc/header.layout.php'; ?>
</head>
<body>
    <header class="header_four">
    <?php include $file_dir.'inc/nav.layout.php'; ?>
    </header>

    <section class="card">
        <div class="row card-body">
            <div class="col-12 col-lg-4"></div>
            <div class="col-12 col-lg-8">
                <div class="card-header">
                    <h4>User Registeration</h4>
                </div>
                <div class="row row_card">
                <div class="form-group col-12 col-lg-6">
                    <label for="f_name">First Name:</label>
                    <input type="text" name="" id="f_name" class="form-control" placeholder="...">
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="l_name">Last Name:</label>
                    <input type="text" name="" id="l_name" class="form-control" placeholder="...">
                </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="" id="phone" class="form-control" placeholder="...">
                </div>
                <div class="form-group">
                    <label for="mail">Email Address:</label>
                    <input type="mail" name="" id="mail" class="form-control" placeholder="...">
                </div>
                <div class="row">
                <div class="form-group col-12 col-lg-6">
                    <label for="pass">Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="..." name="password" id="pass" required>
                        <div class="input-group-append">
                            <div class="input-group-text fyeviu" style="cursor:pointer;">
                                <i class="fa fa-eye"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="c_pass">Confirm Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="..." name="c_password" id="c_pass" required>
                        <div class="input-group-append">
                            <div class="input-group-text fyeviui" style="cursor:pointer;">
                                <i class="fa fa-eye"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group center">
                    <br>
                    <input type="checkbox" id="confirm_auth">
                    By confirming, you agree to our Candidate Guidelines<br>
                    You are also agreeing to our <a href="http://">Terms of Use</a> and <a href="http://">Privacy Policy</a>
                </div>
                <div class="form-group center">
                    <button type="submit" disabled id="btn_auth" class="btn btn-lg btn-primary btn-icon icon-left">Create Account</button>
                </div>
                <div class="form-group center">
                    Already have an account? <a href="http://">Login</a>
                </div>
            </div>
        </div>
    </section>
    
    <?php include $file_dir.'inc/auth_footer.layout.php'; ?>
    <?php include $file_dir.'inc/scripts.layout.php'; ?>
</body>
</html>

<style>
    .row_card{
        margin-top: 30px;
    }
    .form-group.center{
        text-align: center;
    }
    .btn:disabled{
        cursor: not-allowed;
    }
</style>
<script>
    $("#confirm_auth").click(function (e) {
        // alert('test');
        var _value = $(this).prop('checked');
        if (_value == true) {
            $("#btn_auth").prop("disabled", false);
        } else {
            $("#btn_auth").prop("disabled", true);
        }
    });
    $(".fyeviu").on("click", function () {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        $(".fyeviu i").attr("class", "fa fa-eye-slash");
        x.type = "text";
    } else {
        $(".fyeviu i").attr("class", "fa fa-eye");
        x.type = "password";
    }
    });
    $(".fyeviui").on("click", function () {
    var x = document.getElementById("c_pass");
    if (x.type === "password") {
        $(".fyeviui i").attr("class", "fa fa-eye-slash");
        x.type = "text";
    } else {
        $(".fyeviui i").attr("class", "fa fa-eye");
        x.type = "password";
    }
    });
</script>