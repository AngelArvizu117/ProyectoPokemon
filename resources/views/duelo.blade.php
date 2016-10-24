@extends('index')

@section('encabezado')
    <h2>Batalla Pokémon: </h2> <h4>Selecciona dos pokémons para combatir y ganar caramelos</h4>
@stop

@section('contenido')

@if(Session::has('avisoDanger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('avisoDanger')}}
    </div>
@endif

    <div class="row well">
    @foreach($pokemon as $p)
    <form action="{{url('/pelea')}}">
        <div class="col-md-2">
            <div class="thumbnail">
            <h4 class="text-center">{{$p->nombre}}</h4>
                <img src="data:image/png;base64,<?php echo base64_encode($p->imagen); ?>">
                    <div class="caption">
                           <input type="checkbox" name="{{$p->nombre}}" value="{{$p->id}}">
                    </div>
            </div>
        </div>
          @endforeach
           <input type="submit" value="Pelear">
    </div>
</form>


@stop