<!DOCTYPE html>
<html>
<head>
	<title>PDF Pokemon</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css">
            .row{

                border: 5px solid #333;
                background: lightgray;
                border-radius: 15px;
            }
        </style>
</head>
<body>

@foreach($poke as $p)

<center>

  <div class="row">
        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
                <img src="data:image/png;base64,<?php echo base64_encode($p->imagen); ?>">
                <div class="caption">
                    <h1>{{$p->nombre}}</h1>
                    <p>{{$p->descripcion}}</p>
                    <p>Poder de ataque: <h3 bold>{{$p->ataque}}</h3> </p>
                </div>
          </div>
        </div>
    </div>
</center>

@endforeach

</body>
</html>