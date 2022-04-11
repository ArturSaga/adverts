<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="/main.css" rel="stylesheet">
    <title>Задача 1</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="fon">
                <div class="pull-left">
                    <div class="weather">
                        Погода в городе: {{$data['weather']['name']}}<br>
                        Температура на улице: {{$data['weather']['main']->temp_min. '°C'}}<br>
                        Относительная влажность: {{$data['weather']['main']->humidity. '%'}}<br>
                        Скорость ветра: {{$data['weather']['wind']->speed.'км/ч'}}<br>
                    </div>
                </div>
                <div class="pull-right">
                    <button type="button">Обновить</button>
                </div>
                <div class="top">
                    <table>
                        @foreach($data['curse']['name'] as $value)
                            <th>
                                {{ $value }}
                            </th>
                        @endforeach
                        <tr>
                            @foreach($data['curse']['value'] as $elem)
                                <td>
                                    {{ $elem }}
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $('button').on('click', function() {
        $.get('http://127.0.0.1:8002/task1', function(data){
            console.log(data);
        });
    });


</script>
