<!DOCTYPE html>
<html>

<head>
    <style>
        .button {
            background-color: #000;
            /* Aapka theme color */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <h2>Password Reset Request</h2>
    <p>Aapne **Custom Couture** account ka password reset karne ki request ki thi.</p>
    <p>Niche diye gaye button par click karke apna naya password set karein:</p>

    <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" class="button" style="color: #ffffff;">
        Reset Password
    </a>

    <p>Agar aapne ye request nahi ki, toh is email ko ignore karein. Ye link 60 minutes tak valid hai.</p>
    <br>
    <p>Shukriya,<br>Team Custom Couture</p>
</body>

</html>
