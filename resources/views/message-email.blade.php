<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style >
    body {
      background-color: #fafafa;
    }
    .container {
      width: 70%;
      margin: auto;
    }
    .flex {
      display: flex;
      flex-direction: column;
      align-items: center;
      border: 1px grey;
      border-radius: 5px;
    }
    hr {
      width: 100%;
      color: gray;
      margin: 5% 0;
    }
    </style>
  </head>
  <body>
    <div class="container">

      <div class="flex">
        <h2>{{$action}}</h2>
        <br>
        <hr>
        <div class="">
          Appartamento interessato: {{$apart -> description}}
          <br>
          <br>
          Recapito: {{$msg -> email}}
          <br>
          <br>
          Contenuto del messaggio: {{$msg -> message}}
        </div>

      </div>
    </div>
  </body>
</html>
