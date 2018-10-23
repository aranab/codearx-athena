<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>Dear {{$name}},</div>
<h2>Please Click Below Link</h2>
<div>
    <p>Thanks for requesting us. Please follow the link below to change password:</p>
    {{URL::to('/change?code='.$code.'&username='.$username)}}.<br/>
</div>
<div>
    Thanks & Regards,
    <br/>
    Athena Venture & Equities Ltd
</div>
</body>
</html>