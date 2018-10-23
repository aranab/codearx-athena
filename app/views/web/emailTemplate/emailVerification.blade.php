<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>Dear {{$name}},</div>
<h2>Please Verify Your Email Address</h2>
<div>
    <p>Thanks for creating an account to our portal.
        Please follow the link below to verify your email address:</p>
    {{URL::to('/verified?code='.$confirmation_code.'&username='.$username)}}.<br/>
</div>
<div>
    Thanks & Regards,
    <br/>
    Athena Venture & Equities Ltd
</div>
</body>
</html>