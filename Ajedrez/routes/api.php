<?php

use Illuminate\Http\Request;

use App\User;

use App\Partidas;

use App\Movimientos;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

header('Access-Control-Allow-Origin: *');

session_start();
$_SESSION["fil"]=1;
$_SESSION["col"]=5;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

//-X-X-X-X-XX-X-X-X-X-X-INFORMACIÓN-X-X-X-X-X-X-X-X-X-X-X-\\	

(User Login):if(Auth::attempt(['email'=> $variable1,'email'=> $variable1,]){
};
(Response JSON):return response()->json($champ);

!!RECUERDA!! LLAMAMOS A LA RUTA ASÍ --> curl "URL"/api/"ruta".
//EJEMPLO//
//return response()->json(['msg'=>$mensaje->msg,'user'=> $user,'idMensaje'=>$mensaje->id]);
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//-X-X-X-X-XX-X-X-X-X-X-REGISTRO-X-X-X-X-X-X-X-X-X-X-X-\\	
Route::get('/registrar/{name}/{email}/{password}',function(request $request,$name,$email,$password){
	$nombre = $name;
	$correo = $email;
	$contrasenya = bcrypt($password);
	$registroOk = "Registrado correctamente";
	
	//Creamos usuario
	$createUser = new User();
	$createUser->name = $nombre;
	$createUser->email = $correo;
	$createUser->password = $contrasenya;
	$createUser->api_token = str_random(50);
	$createUser->save();

	//Redirigimos a la ruta principal
	$url = 'http://127.0.0.1:8000/api';
	echo "Usuario registrado correctamente!";
	//header("Access-Control-Allow-Origin: *");
	return $registroOk;
});
//-X-X-X-X-XX-X-X-X-X-X-LOGIN-X-X-X-X-X-X-X-X-X-X-X-\\	
Route::get('/login/{user}/{password}',function(request $request,$email,$password){

	if(Auth::attempt(/*$userdata*/['email' => $email,'password'=> $password])){
            //Logueo correcto...
		$token = md5(uniqid(rand(),TRUE));
        //$token = "prueba";
        $newToken = User::select()->where('email',$email)->first();
        $newToken->api_token = $token;
        $newToken->save();
        $user = Auth::user()->name;
        return response()->json(['token'=>$token,'Usuario'=>$user]);
    };
});
Route::post('/login/{user}/{password}',function(request $request,$email,$password){

	if(Auth::attempt(/*$userdata*/['email' => $email,'password'=> $password])){
            //Logueo correcto...
		$token = md5(uniqid(rand(),TRUE));
        $newToken = User::select()->where('email',$email)->first();
        $newToken->api_token = $token;
        $newToken->save();
        $user = Auth::user()->name;
        return response()->json(['token'=>$token,'Usuario'=>$user]);
    }
});

//-X-X-X-X-XX-X-X-X-X-X-PARTIDA-X-X-X-X-X-X-X-X-X-X-X-\\	
Route::get('/partida/add/{id}/{token}/{user}',function(request $request,$id,$token,$user){
	//$id = id partida
	//$token = token usuario
	$userx = User::where('api_token',$token)->first();
	if($userx->name == $user){
		$partidaJugador1 = Partidas::where('user1',$user)->first();
		$partidaJugador2 = Partidas::where('user2',$user)->first();

		if($partidaJugador1){
			$partidaId = Partidas::where('id',$id)->first();
			if($partidaJugador1->id == $partidaId->id){
				$mensaje = "100";//User 1 es tu partida!
				$partidaId = Partidas::where('id',$id)->first();
				$userEnemigo = $partidaId->user2;

				return response()->json(['mensaje'=>$mensaje,'enemigo'=>$userEnemigo,'idPartida'=>$id]);
			}else{
				$mensaje = "1";//User 1 ya estas jugando a una partida!
				return response()->json(['mensaje'=>$mensaje]);
			}
		}else if($partidaJugador2){
			$partidaId = Partidas::where('id',$id)->first();
			if($partidaJugador2->id == $partidaId->id){
				$mensaje = "200";//User 2 es tu partida!
				$partidaId = Partidas::where('id',$id)->first();
				$userEnemigo = $partidaId->user1;

				return response()->json(['mensaje'=>$mensaje,'enemigo'=>$userEnemigo,'idPartida'=>$id]);
			}else{
				$mensaje = "1.1";//User 2 ya estas jugando a una partida!
				return response()->json(['mensaje'=>$mensaje]);
			}
		}else{
			$partida = Partidas::where('id',$id)->first();
			if($partida->user1 == $user || $partida->user2 == $user){
				$mensaje = "2";//No puedes entrar en esta partida! ya estas dentro.
				return response()->json(['mensaje'=>$mensaje]);
			}else{
				if($partida->info == "0"){				
					if($partida->user1 == "vacio"){
						$partida->user1 = $user;
						$partida->info = "1";
						$partida->save();
						$mensaje = "3";
						return response()->json(['mensaje'=>$mensaje]);
					}else if($partida->user2 == "vacio"){
						$partida->user2 = $user;
						$partida->info = "1";
						$partida->save();
						$mensaje = "4";
						return response()->json(['mensaje'=>$mensaje]);
					}
				}else if($partida->info == "1"){
					if($partida->user1 == "vacio"){
						$partida->user1 = $user;
						$partida->info = "2";
						$partida->save();
						$mensaje = "5";
						return response()->json(['mensaje'=>$mensaje]);

					}else if($partida->user2 == "vacio"){
						$partida->user2 = $user;
						$partida->info = "2";
						$partida->save();
						$mensaje = "6";
						return response()->json(['mensaje'=>$mensaje]);
					}
				}else{	
					$mensaje = "7";//Pardida llena
					return response()->json(['mensaje'=>$mensaje]);
				}
			}
		}
	}else{
		$mensaje = "8";
		return response()->json(['mensaje'=>$mensaje]);
	}
});

//-X-X-X-X-XX-X-X-X-X-X-MOSTRAR-PARTIDAS-X-X-X-X-X-X-X-X-X-X-X-\\	
Route::get('/partidas',function(request $request){
	$partidas = Partidas::all();
    return response()->json(['partida1'=>$partidas[0],'partida2'=>$partidas[1],'partida3'=>$partidas[2],'partida4'=>$partidas[3]]);
			
});
//Mostrar movimientos guardados
Route::get('/movimiento/{idpartida}',function(request $request,$idpartida){
	$movmientoPartida = Movimientos::where('id',$idpartida)->first();

    return response()->json(['ultpos1'=>$movmientoPartida->ultpos1,'ultficha1'=>$movmientoPartida->ultficha1,'ultname1'=>$movmientoPartida->ultname1,'ultpos2'=>$movmientoPartida->ultpos2,'ultficha2'=>$movmientoPartida->ultficha2,'ultname2'=>$movmientoPartida->ultname2]);		
});
//hacer movimiento
Route::get('/movimiento/{idpartida}/{idUser}/{fila}/{columna}',function(request $request,$idPartida,$idUser,$fila,$columna){

 	$ultMov = Movimientos::select()->orderBy('id', 'desc')->first();
	$movimiento = new Movimientos();
	  $defFil = $ultMov->fila;
	  $defCol= $ultMov->col;

	  if($defFil-1==$fila && $defCol==$columna || $defFil+1==$fila && $defCol==$columna && $fila < 9 && $fila > 0 && $columna < 9 && $columna > 0){
	    $msj="Movimiento correcto y realizado";
	    $movimiento->idPartida=$idPartida;
	    $movimiento->idUser = $idUser;
	    $movimiento->fila = $fila;
	    $movimiento->col = $columna;
	    $movimiento->save();
	    $_SESSION["fil"] = $fila;
	  	$_SESSION["col"] = $columna;
	  	$poscion = "Fila: ".$fila." Columna: ".$columna;
	    return response()->json(['mensaje'=>$msj, 'poscion'=>$poscion]);
	  }else if($defFil==$fila && $defCol-1==$columna || $defFil==$fila && $defCol+1==$columna && $fila < 9 && $fila > 0 && $columna < 9 && $columna > 0){
	    $msj="Movimiento correcto y realizado";
	    $movimiento->idPartida=$idPartida;
	    $movimiento->idUser = $idUser;
	    $movimiento->fila=$fila;
	    $movimiento->col=$columna;
	    $movimiento->save();
	    $_SESSION["fil"] = $fila;
	  	$_SESSION["col"] = $columna;
	    $poscion = "Fila: ".$fila." Columna: ".$columna;
	    return response()->json(['mensaje'=>$msj, 'poscion'=>$poscion]);
	  }else if($defFil-1==$fila && $defCol-1==$columna || $defFil+1==$fila && $defCol+1==$columna && $fila < 9 && $fila > 0 && $columna < 9 && $columna > 0){
	    $msj="Diagonal correcta y realizada";
	    $movimiento->idPartida=$idPartida;
	    $movimiento->idUser = $idUser;
	    $movimiento->fila=$fila;
	    $movimiento->col=$columna;
	    $movimiento->save();
	    $_SESSION["fil"] = $fila;
	  	$_SESSION["col"] = $columna;
	    $poscion = "Fila: ".$fila." Columna: ".$columna;
	    return response()->json(['mensaje'=>$msj, 'poscion'=>$poscion]);
	  }else{
	    $msj="Movimiento incorrecto";
	    return response()->json(['mensaje'=>$msj]);
	  }	
});


