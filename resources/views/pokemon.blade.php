@extends('index')

@section('encabezado')
    <h2>Pokémones tipo: {{$tipo->tipo}}</h2>
@stop

@section('contenido')


@if(Session::has('avisoSuccess'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('avisoSuccess')}}
    </div>
@endif

@if(Session::has('avisoDanger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('avisoDanger')}}
    </div>
@endif

    <div class="row well">
    @foreach($pokemons as $p)
        <div class="col-md-5">
            <div class="thumbnail">
                 <h4 class="text-right">Ataque: {{$p->ataque}}</h4>
                <img src="data:image/png;base64,<?php echo base64_encode($p->imagen); ?>">
                    <div class="caption">

                                <h4 class="text-center">{{$p->nombre}}</h4>
                                <p>{{$p->descripcion}}</p>
                                <p align="center">
                                    <a href="{{url('/pdfPokemon')}}/{{$p->id}}" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-file">PDF</span></a> 
                                    <a href="{{url('/darPoder')}}/{{$p->id}}" class="btn btn-danger" role="button">Poder <span class="badge">{{$p->caramelos}} 
                                    <img src="{{asset ("images/caramelo.png")}}" height="15"> </span> </a>
                                </p>
                                
                    </div>
            </div>
        </div>
          @endforeach
    </div>



@stop