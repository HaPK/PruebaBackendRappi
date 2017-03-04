<pre>
<?php
//Cube Sumation
/**
* N = Tamaño del cubo
* x,y,z = coordenada del elemento dentro del cubo
* W = Elemento dentro de una de las coordenadas del cubo
* x1,y1,z1,x2,y2,z2 = coordenadas del cubo para hacer la suma inclusiva
* 
* T = El número de pruebas
* M = El número de operaciones
* operacion = Linea de texto con la operación que se debe llevar a cabo
*/

readInput();

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

function crearCubo($N){
//crear el array de 3 dimensiones con los valores en 0
	$cube=array_fill(1, $N, array_fill(1, $N, array_fill(1, $N, 0)));
	return $cube;
}

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
	if($x1==$x2){
		if ($y1==$y2) {
			if ($z1==$z2) {
				return $suma;
			} else{
				for ($i=$z1+1; $i < $z2; $i++) { 
					$suma = $suma + $cube[$x1][$y1][$i];				
				}
			}
		} elseif($z1==$z2){
			for ($i=$y1+1; $i < $y2; $i++) { 
					$suma = $suma + $cube[$x1][$i][$z1];
			}
		}
		 else {
			for ($i=$y1+1; $i < $y2; $i++) { 
				for ($j=$z1+1; $j < $z2; $j++) { 
					$suma = $suma + $cube[$x1][$i][$j];
				}
			}	
		}
	} elseif ($y1==$y2) {
		 if ($z1==$z2) {
				for ($i=$x1+1; $i < $x2; $i++) { 
					$suma = $suma + $cube[$i][$y1][$z1];				
				}
			} else {
				for ($i=$x1+1; $i < $x2; $i++) { 
					for ($j=$z1+1; $j < $z2; $j++) { 
						$suma = $suma + $cube[$i][$y1][$j];
					}
				}
			}
	} elseif ($z1==$z2) {
		for ($i=$x1+1; $i < $x2; $i++) { 
					for ($j=$y1+1; $j < $y2; $j++) { 
						$suma = $suma + $cube[$i][$j][$z1];
					}
				}
	} else {
		for ($i=(float)$x1+1; $i < (float)$x2; $i++) { 
			for ($j=(float)$y1+1; $j < (float)$y2; $j++) { 
				for ($k=(float)$z1+1; $k < (float)$z2; $k++) { 
						$suma = $suma + (float)$cube[$i][$j][$k];
				}
			}
		}
	}
	return $suma;
}


function mostrarResultado($result){
	echo $result."<br>";
}
?>
</pre>
