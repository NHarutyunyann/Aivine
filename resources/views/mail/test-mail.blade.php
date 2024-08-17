<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/mail.css">
    <title>Aivine</title>
</head>
<body>
<section class="mail-seccess section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="success-inner">
                    <h1><i class="fa fa-envelope"></i><span>{{ $name }}</span></h1>
                    <p>{{ $email }}</p>
                </div>
                <p>{{ $msg }}</p>
            </div>
        </div>
    </div>
</section>
</body>
</html>