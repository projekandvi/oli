<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h2>User Page.. halo {{Auth::guard('pengguna')->user()->email}}</h2>
  <br>
  <a href="/logoutBaru">Logout {{ Auth::guard('pengguna')->user()->email }} ??</a>
</body>
</html>