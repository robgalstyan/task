<html>
<head></head>
<body>
Your registration was successful, you just need to verify email.
Click the link below for verification:
{{ url('email/verify').'?email='.$user->email.'&token='.$token }}
</body>
</html>