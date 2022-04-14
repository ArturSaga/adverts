@extends('layout.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Мои локации </h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('locations.create') }}"> Добавить локацию </a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <div class="scroll-table">
                <table class="table table-hover" id="scroll-table">
                    <tr>
                        <th>Название</th>
                        <th>Широта</th>
                        <th>Долгота</th>
                        <th>Описание</th>
                        <th>Действия</th>
                    </tr>
                    @foreach ($locations as $location)
                        <tr>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->latitude }}</td>
                            <td>{{ $location->longitude }}</td>
                            <td>{{ $location->balloon }}</td>
                            <td>
{{--                                <a class="btn btn-light" href="{{ route('locations.show',$location->id) }}">Посмотреть</a>--}}
                                <a class="btn btn-light" href="{{ route('locations.edit',$location->id) }}">Редактировать</a>
                                <form action="{{ route('locations.destroy',$location->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
                <div id="map" style="width: 800px; height: 800px" class="p-3 border bg-light"></div>
            </div>
        </div>
    </div>
    <script type = "text/javascript">
        ymaps.ready(init);
        function init() {
            // Создание карты.
            var location = ymaps.geolocation;
            var myMap = new ymaps.Map("map", {
                center: [53.76, 91.2],
                zoom: 9
            }, {
                searchControlProvider: 'yandex#search'
            })
            location.get({
                mapStateAutoApply: true
            })
                .then(
                    function (result) {
                        // Получение местоположения пользователя.
                        var userAddress = result.geoObjects.get(0).properties.get('text');
                        var userCoodinates = result.geoObjects.get(0).geometry.getCoordinates();
                        // Пропишем полученный адрес в балуне.
                        result.geoObjects.get(0).properties.set({
                            balloonContentBody: 'Адрес: ' + userAddress +
                                '<br/>Координаты:' + userCoodinates
                        });
                        myMap.geoObjects.add(result.geoObjects)
                    },
                    function (err) {
                        console.log('Ошибка: ' + err)
                    }
                )
            var TableList = new Array();
            var table = document.getElementsByClassName("table");
            for(var i=0;i<table.length;i++) {
                var tr = table.item(i).getElementsByTagName("tr");
                TableList[i] = new Array();
                for (var j = 0; j < tr.length; j++) {
                    var td = tr.item(j).getElementsByTagName("td");
                    TableList[i][j] = new Array();
                    for (var f = 0; f < td.length; f++) {
                        TableList[i][j][f] = td.item(f).innerText;
                    }
                }
            }
            var k;
            for(k=1; k<=TableList[0].length; ++k){
                let name = new Array();
                console.log(TableList[0][k][0],TableList[0][k][3])
                let myPlacemark = new ymaps.Placemark([TableList[0][k][1],TableList[0][k][2]], {
                    // Чтобы балун и хинт открывались на метке, необходимо задать ей определенные свойства.
                    balloonContentHeader: TableList[0][k][0],
                    balloonContentBody: TableList[0][k][3],
                    // balloonContentFooter: "Подвал",
                    // hintContent: "Хинт метки"
                });
                myMap.geoObjects.add(myPlacemark);
            }
        }
    </script>
@endsection


