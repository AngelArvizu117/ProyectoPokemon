@extends('index')

<!--Empieza el section-->
@section('encabezado')
<h2>Batalla Pokémon: {{$poke1->nombre}} VS {{$poke2->nombre}}</h2>
@stop
@section('contenido')

<div class="row well">
	<div class="col-md-5">
		<div class="thumbnail">
			<h4 class="text-right">Ataque: {{$poke1->ataque}}</h4>
			<img src="data:image/gif;base64,<?php echo base64_encode($poke1->animacion); ?>" class="imgA" id="idP1">
			<div class="caption">
				<h4 class="text-center">{{$poke1->nombre}}</h4>
				<h4 class="text-center">Salud: <h4 id="salud1" class="text-center">{{$poke1->salud}} </h4> </h4>
				<a href="#"  id="luchar" class="btn btn-danger" align="center">atacar</a>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="thumbnail">
			<h4 class="text-right">Ataque: {{$poke2->ataque}}</h4>
			<img src="data:image/gif;base64,{{base64_encode($poke2->animacion)}}" class="imgB" id="idP2">
			<div class="caption">
				<h4 class="text-center">{{$poke2->nombre}}</h4>
				<h4 class="text-center">Salud: <h4 id="salud2" class="text-center">{{$poke2->salud}} </h4> </h4>
			</div>
		</div>
	</div>
</div>
<h2 class="text-center">Resumen de pelea: <h4 id="ataco" class="text-center"> </h4> </h2>
<a href="" id=""></a>
@stop

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#luchar').click(function(event) {
			event.preventDefault();
			lucha(1);
		});
		function atacaP1() {
			document.getElementById('idP1').src = "data:image/gif;base64,{{base64_encode($poke1->animacion_ataque)}}";
			setTimeout(function() {
				ParaAtaque1();
			},2000);
		}
		function ParaAtaque1() {
			document.getElementById('idP1').src = "data:image/gif;base64,{{base64_encode($poke1->animacion)}}";
		}
		function atacaP2() {
			document.getElementById('idP2').src = "data:image/gif;base64,{{base64_encode($poke2->animacion_ataque)}}";
			setTimeout(function() {
				ParaAtaque2();
			},2000);
		}
		function ParaAtaque2() {
			document.getElementById('idP2').src = "data:image/gif;base64,{{base64_encode($poke2->animacion)}}";

		}

    function aleatorio(a,b) {
         return Math.round(Math.random()*(b-a)+parseInt(a));
         }


    var V=aleatorio(30,35);
    var B=aleatorio(1,2);
    var E=aleatorio(1,2);

		var potenciaAtaque1=0.1*B*E*(V/25)*{{$poke1->ataque}};
		var potenciaAtaque2=0.1*B*E*(V/25)*{{$poke2->ataque}};
		var saludP1={{$poke1->salud}};
		var saludP2={{$poke2->salud}};
		var turnoS=1;

		function lucha(turno){
			var turno1=Math.round(Math.random()*1);
			var s1;
			var s2;
			if (turno!=turnoS)
				return;
			if(turno==0){
				atacaP2();
				turnoS=1;
				saludP1-=potenciaAtaque2;
				if (saludP1<=0) {
					saludP1=0;
				}
				document.getElementById("salud1").innerHTML = Math.round(saludP1);
				document.getElementById("ataco").innerHTML =document.getElementById("ataco").innerHTML + "<br/> pokemon {{$poke2->nombre}} ataco con "+Math.round(potenciaAtaque2)+" de daño.";
				if (saludP1==0) {
					document.getElementById("ataco").innerHTML = document.getElementById("ataco").innerHTML + "<br/> pokemon {{$poke2->nombre}} a ganado la batalla.";
         
          $.ajax({
  url : '{{ url('/ganador/'.$poke2->id) }}',
  type : 'GET',
  dataType : 'json',
  success : function(json) {
    console.log(json);
  },
    error : function(xhr, status) {
    alert('Disculpe, existió un problema');
  }
});
				}
				return;
			}

			if(turno==1){
				atacaP1();
				turnoS=0;
				saludP2-=potenciaAtaque1;
				if (saludP2<=0) {
					saludP2=0;
				}
				document.getElementById("salud2").innerHTML = Math.round(saludP2);
				document.getElementById("ataco").innerHTML = document.getElementById("ataco").innerHTML + "<br/> pokemon {{$poke1->nombre}} ataco con "+Math.round(potenciaAtaque1)+" de daño.";
				if (saludP2==0) {
					document.getElementById("ataco").innerHTML = document.getElementById("ataco").innerHTML + "<br/> pokemon {{$poke1->nombre}} a ganado la batalla.";
         
          $.ajax({
  url : '{{ url('/ganador/'.$poke1->id) }}',
  type : 'GET',
  dataType : 'json',
  success : function(json) {
    console.log(json);
  },
    error : function(xhr, status) {
    alert('Disculpe, existió un problema');
  }
});
					return;
				}
				setTimeout(function() {
					lucha(0);
				},2000);
			}
		}
	});
</script>

@stop