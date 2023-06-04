<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RAPOR</title>
  <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
  <style>
    * {
      margin:0;
      font-family: Helvetica,'Helvetica Neue';
    }
    .table td,.table th,.table{
      border-collapse: collapse;
    }
    .table td{
      text-align:center;
      padding-top:0.5rem;
      padding-bottom:0.5rem;
      padding-left:0.75rem;
      padding-right:0.75rem;
      border:1px solid black;
    }
    .table-header {
      font-weight:bold;
      font-size:18px;
    }
  </style>
</head>
<body>
    @yield('body')
</body>
</html>
