<pre>
<?php
//Cube Sumation
//dummy values
/**
* N = Tamaño del cubo
* x,y,z = coordenada del elemento dentro del cubo
* W = Elemento dentro de una de las coordenadas del cubo
* 
* T = El número de pruebas
* M = El número de operaciones
* operacion = Linea de texto con la operación que se debe llevar a cabo
*/

readInput();

function crearCubo($N){
//crear el array de 3 dimensiones con los valores en 0
	$cube=array_fill(1, $N, array_fill(1, $N, array_fill(1, $N, 0)));
	return $cube;
}

//echo $cube[1][1][1]."<br>";
function operarCubo($cube,$operacion){
	$token = strtok($operacion, " ");
	if (strcmp($token, "UPDATE") == 0) {
		list( ,$x,$y,$z,$W) = explode(" ", $operacion);
		$cube[$x][$y][$z]=$W;
		//mostrarResultado($cube[$x][$y][$z]);
		//echo "cubo en la posición $x $y $z: ".$cube[$x][$y][$z]."<br>";
	} else if (strtok($token, "QUERY")==0) {
		list( ,$x1,$y1,$z1,$x2,$y2,$z2) = explode(" ", $operacion);
		//$suma = (float)$cube[$x1][$y1][$z1] + (float)$cube[$x2][$y2][(int)$z2];
		$suma = sumaInclusiva($cube,$x1,$y1,$z1,$x2,$y2,$z2);
		mostrarResultado($suma);
	} else{
		mostrarResultado("Hubo un error o la operación no era la correcta");
	}
	//print_r($cube);
	return $cube;
}

function sumaInclusiva($cube,$x1,$y1,$z1,$x2,$y2,$z2){
	$suma = (float)$cube[$x1][$y1][$z1];
	for ($i=(float)$x1; $i < (float)$x2; $i++) { 
		for ($j=(float)$y1; $j < (float)$y2; $j++) { 
			for ($k=(float)$z1; $k < (float)$z2; $k++) { 
					$suma = $suma + (float)$cube[$i+1][$j+1][$k+1];
			}
		}
	}
	return $suma;
}

function readInput(){
	$gestor = @fopen("sample_input.txt", "r");
	//$primeraLinea = false;
	if ($gestor) {
		$testcases = fgets($gestor);
		//$primeraLinea = true;
		for ($i=0; $i < $testcases ; $i++) {
			$base = fgets($gestor);
			list($N,$queries) = explode(" ", $base);
			$cube = crearCubo($N);
			$lineas = 0;
			while ($lineas < $queries) {
				//print_r($cube);
				$operacion = fgets($gestor);
				$cube = operarCubo($cube,$operacion);
				$lineas++;
			}
		}
		fclose($gestor);
	}
}

function mostrarResultado($result){
	echo $result."<br>";
}
?>
</pre>
