<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\pokemon;
use App\tipo;
use App\poke_tipo;
use DB;
use App\caramelos;
use Session;
use Redirect;

class pokemonController extends Controller{
    
public function home(){

	$tCaramelos=caramelos::all();
	$tipos=tipo::all();
 	return view('/home', compact('tipos','tCaramelos'));

}

public function mostrarPokemons($id){

$pokemons=DB::table('poke_tipo as pk')
->join('pokemon as p','pk.id_pokemon','=','p.id')
->join('tipos as t','pk.id_tipo','=','t.id')
->select('p.id','p.nombre','p.descripcion','p.imagen','p.caramelos','p.ataque')
//->select('*')
->where('t.id','=',$id)
->get();

$tipo=tipo::find($id);
$tipos=tipo::all();
$tCaramelos=caramelos::all();

return view('/pokemon', compact('tipo','tipos','pokemons','tCaramelos'));

}

public function darPoder($id){
 //dd($id);

//nombre del pokemon
$pokeNombre=DB::table('pokemon as p')
->select('p.nombre')
->where('p.id','=',$id)
->get();

$nombreP=head(head($pokeNombre));

//caramelos necesarios para subir poder
$cPokemon=DB::table('pokemon as p')
->select('p.caramelos')
->where('p.id','=',$id)
->get();

//caramelos totales en la tabla items
$C_caramelos=DB::table('items as i')
->select('i.total_caramelos')
->where('i.id','=','1')
->get();

//poder de ataque de pokemon
$poderPokemon=DB::table('pokemon as p')
->select('p.ataque')
->where('p.id','=',$id)
->get();

//variables tipo int para poder hacer operaciones aritmeticas(pasa de tipo array a tipo int)
$totalCaramelosItems=head(head($C_caramelos));
$caramelosNecesariosPokemon=head(head($cPokemon));
$poderDeAtaque=head(head($poderPokemon));


//resta los caramelos necesarios para poder subir "poder" al pokemon de los caramelos totales de la tabla items
if ($totalCaramelosItems<$caramelosNecesariosPokemon){
	Session::flash('avisoDanger','Caramelos insuficientes para subir poder :(');
    return Redirect::back();

} else {

	$resta=$totalCaramelosItems-$caramelosNecesariosPokemon;
	$nuevoPoder=$poderDeAtaque+$caramelosNecesariosPokemon;
	//echo ($resta);
	//dd($nuevoPoder);

//aqui se guarda el nuevo poder del pokemon en la tabla pokemon
$pokemon=pokemon::find($id);
$pokemon->ataque=$nuevoPoder;
$pokemon->save();
//aqui se guarda el total de caramelos restantes en la tabla items
$item=caramelos::find(1);
$item->total_caramelos=$resta;
$item->save();
}

//mensaje que regresa el nombre del pokemon, poder anterior y poder nuevo
Session::flash('avisoSuccess','Poder incrementado a '.$nombreP.' de '.$poderDeAtaque.' a '.$nuevoPoder);
return Redirect::back();
//return Redirect('/mostrarPokemons/',compact('tipoP'));
//dd($nombre);
}

public function pdfPokemon($id){
//dd($id);
/*
$poke=DB::table('poke_tipo as pk')
->join('pokemon as p','pk.id_pokemon','=','p.id')
->join('tipos as t','pk.id_tipo','=','t.id')
->select('p.nombre','p.descripcion','p.imagen','p.caramelos','p.ataque','t.tipo')
//->select('*')
->where('p.id','=',$id)
->get();*/

 //$p=head($poke);
 //dd($p);

  $poke=pokemon::select('nombre','descripcion','imagen','ataque')
  ->where('id','=',$id)
  ->get();
  
   $vista=view('pdfPoke',compact('poke'));
   $dompdf=\App::make('dompdf.wrapper');
   $dompdf->loadHTML($vista);
   return $dompdf->stream('pokemon.pdf');
}

public function duelo(){

$pokemon=pokemon::all();
$tipos=tipo::all();
$tCaramelos=caramelos::all();


	return view('/duelo',compact('pokemon','tipos','tCaramelos'));
}

public function pelea(){

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
	$tags[$i]=$valores[$i];


	if ($i>1) {
		Session::flash('avisoDanger','Debes seleccionar solo 2 pokémons para combatir');
    return Redirect::back();
	}

}

//id de los pokemons seleccionados
$poke1Id=$tags[0];
$poke2Id=$tags[1];

$poke1=pokemon::select('id','nombre','animacion','ataque','animacion_ataque','salud')
  ->where('id','=',$poke1Id)
  ->first();
  
 $poke2=pokemon::select('id','nombre','animacion','ataque','animacion_ataque','salud')
  ->where('id','=',$poke2Id)
  ->first();

  $tipos=tipo::all();
  $tCaramelos=caramelos::all();

return view('/pelea',compact('poke1','poke2','tipos','tCaramelos'));

}

public function ganador($id){


}


}