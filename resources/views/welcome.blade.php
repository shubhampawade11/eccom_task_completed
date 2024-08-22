<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }



        .container {
            text-align: center;
            margin-top: 30%;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Welcome to Eccomerce Website</h1>
    <div class="container center-container">
        <a href="{{ route('user.login')}}" class="btn btn-primary">Users</a>
        <a href="{{ route('admin.login')}}" class="btn btn-primary">Admin</a>
    </div>
</body>

</html>