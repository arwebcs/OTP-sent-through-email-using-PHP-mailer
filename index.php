<?php
    error_reporting(1);
    require_once 'mailer.php';

    if (isset($_POST['sendOTP'])) {
        $otpSend        = "";
        $sent           = "";
        $className      = "";
        $otpGenerate    = rand(1000, 9999);
        $recipientEmail = trim($_POST['email_id']);
        $subject        = "Please confirm the OTP";
        $msgContent     = "Your company's <b>OTP code</b> - " . $otpGenerate;
        $attachment     = null;

        if (emailSending($recipientEmail, $subject, $msgContent)) {
            $otpSend   = "Successfully sent OTP by email";
            $className = "success";
            $sent      = 1;
        } else {
            $otpSend   = "Could not sent OTP by email";
            $className = "danger";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP sending through Email and verifying</title>
    <link rel="stylesheet" href="./bootstrap.min.css" />
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
<div class="container">
<form class="form-signin" action="" method="post">
  <h2 class="form-signin-heading">Provide email for OTP</h2>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" class="form-control" name="email_id" placeholder="Email address" required autofocus>
  <b class="text-<?php echo $className; ?>"><?php echo $otpSend; ?></b><br>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="sendOTP" id="sendOTP">Generate OTP</button>
</form>
<?php
    if ($sent == 1) {
    ?>
<div class="form-signin">
<h2 class="form-signin-heading">Verify OTP</h2>
<label for="inputOTP" class="sr-only">OTP</label>
<input type="hidden" name="hotp" id="hotp" class="form-control" placeholder="Enter OTP" value="<?php echo $otpGenerate; ?>" />
<input type="text"  name="otp" id="otp" class="form-control" placeholder="Enter OTP"  value="" />
  <b id="message"></b><br>
  <button class="btn btn-lg btn-primary btn-block" type="button" name="verify" id="verify">Verify</button>
</div>
<?php
    }
?>
</div>
</body>
<script src="./jquery.min.js"></script>
<script>
$(document).ready(function(){
   $("#verify").click(function(){
   let hOtp = $("#hotp").val();
   let otp = $("#otp").val();
   if((hOtp === null) || (hOtp === "") || (otp === null) || (otp === "")){
    $("#message").text("Provide OTP");
   }else if(hOtp !== otp){
    $("#message").text("OTP entered is wrong");
   }else{
    $("#hotp").val("");
    $("#otp").val("");
    $("#message").text("Successfully verified");
   }
 });
});
</script>
</html>