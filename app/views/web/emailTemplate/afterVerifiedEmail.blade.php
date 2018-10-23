<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
<div>Dear {{$name}},</div>
<div>
    <h3>Thank you for completing the registration process.</h3>
    <p>Welcome to our portal! From here, you can submit your business proposal and also see your proposal status.</p>
    <p>Follow us on -</p>
    <ul>
        <li>
            <a href="{{$ld}}" >
                <i class="fa fa-linkedin" aria-hidden="true"></i>
                LinkedIn
            </a>
        </li>
        <li>
            <a href="{{$fb}}" >
                <i class="fa fa-facebook" aria-hidden="true"></i>
                Facebook
            </a>
        </li>
        <li>
            <a href="{{$ld}}" >
                <i class="fa fa-twitter" aria-hidden="true"></i>
                Twitter
            </a>
        </li>
    </ul>
</div><br/>
<div>
    Thanks & Regards,
    <br/>
    Athena Venture & Equities Ltd
</div>
</body>
</html>