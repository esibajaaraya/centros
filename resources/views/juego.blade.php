<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="resources/css/poker.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- JQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    </head>
    <body>
    <div class="container-sm">
        <div class="row">
            <div class="col">
                <input type="hidden" id="turno_id" value="{{$turno->id}}">
                <h4>{{$juego->nombre}}</h4>
                <p id="pozo">Pozo: {{$juego->pozo}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div style="border-radius: 20px; position: relative; width: 100%; height: 200px; background: rgb(34,101,9); background: radial-gradient(circle, rgba(34,101,9,1) 80%, rgba(12,12,47,1) 100%);" class="col justify-content-md-center">
                <img style="position: relative; top: 25px; left: 50px; height: 150px" src="{{ URL::asset("/images/" . $cartas[0]->carta->nombre."_".$cartas[0]->palo->id.".png") }}">
                <img id="carta_juego" style="position: relative; top: 25px; left: 100px; height: 150px" src="{{ URL::asset("/images/back.png") }}">
                <img style="position: relative; top: 25px; left: 150px; height: 150px" src="{{ URL::asset("/images/" . $cartas[1]->carta->nombre."_".$cartas[1]->palo->id.".png") }}">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <div class="card h-100 border-primary mb-3" >
                    <!--img height="100px" src="" class="card-img-top" alt="{{$turno->jugador->nombre}}"-->
                    <div class="card-body">
                        <h5 class="card-title">{{$turno->jugador->nombre}}</h5>
                        <div class="btn-group" role="group">
                            <a onclick="$('#apuesta').val($('#min').val()); jugar()" class="btn btn-outline-primary">Minima</a>
                            <div class="input-group">
                                <input id="apuesta" type="number" class="form-control" placeholder="Apuesta" min="{{ $juego->minima }}" max="{{ $juego->pozo }}" step="{{ $juego->minima }}" value="{{ $juego->minima }}">
                                <input type="hidden" id="min" value="{{ $juego->minima }}">
                                <input type="hidden" id="max" value="{{ $juego->pozo }}">
                                <a  onclick="jugar()" class="btn btn-outline-primary" type="button" id="apuesta">Apostar</a>
                            </div>
                            <a onclick="$('#apuesta').val($('#max').val()); jugar()" class="btn btn-outline-primary">Todo</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <table class="table table-sm table-hover">
                    <tr>
                        <th>Pos.</th>
                        <th>Nombre</th>
                        <th>Dinero</th>
                    </tr>
                    @foreach($jugadores as $jugador)
                    <tr>
                        <td>{{$jugador->orden}}</td>
                        <td>{{$jugador->jugador->nombre}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <textarea cols="25" rows="10" id="log" readonly>Inicia el juego.&#10Turno de {{$turno->jugador->nombre}}.&#10</textarea>
            </div>
        </div>
    </div>

        <script type="text/javascript">
            function refrescar(juego) {
                $.ajax({
                    url: '/refrescar/'+ juego,
                    type: 'GET',
                    success: function (response) {
                        if (response) {
                            $('#pozo').html("Pozo: " + response.pozo);
                            $('#max').val(response.pozo);
                            $('#apuesta').attr('max', response.pozo);
                            $('#apuesta').val(response.minima);
                            $('#carta_juego').attr('src', 'images/' + response.carta_juego);
                            $('#log').append(response.resultado + '\r\n');
                        } else {
                            jugar();
                        }
                    }
                });
            }

            function intervalo() {
                intervalo=setInterval(refrescar({{$turno->juego_id}}),1000);
            }

            function jugar() {
                $.ajax({
                    url: '/jugar/'+ $('#turno_id').val() + '/'+ $('#apuesta').val(),
                    type: 'GET',
                    success: function (response) {
                        if (response) {
                            $('#pozo').html("Pozo: " + response.pozo);
                            $('#max').val(response.pozo);
                            $('#apuesta').attr('max', response.pozo);
                            $('#apuesta').val(response.minima);
                            $('#carta_juego').attr('src', 'images/' + response.carta_juego);
                            $('#log').append(response.resultado + '\r\n');
                        } else {
                            jugar();
                        }
                    }
                });
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
