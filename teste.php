<?php

//echo date("Y-m-d H:i:s");
$servername = "localhost";
$username = "rafaeladm";
$password = "rafaeladm";
$dbname = "resultadonacional";
$conteudo = file_get_contents("https://resultadonacional.com/resultado/ultimos");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$json = json_decode($conteudo, true);

//print_r($json);

foreach ($json["data"] as $resultado) {
	//echo "<p>"; 
	//echo $resultado["RESULTADO"] . " | ";
	$result = $resultado["RESULTADO"];
	//echo $resultado["DATA_HORA_FORMATADO"] . " | ";
	$datahora = $resultado["DATA_HORA_FORMATADO"];
	//echo $resultado["TIPO_RESULTADO"] . " | ";
	$tiporesultado = $resultado["TIPO_RESULTADO"];
	//echo $resultado["ID_CONCURSO"] . " | ";
	$idconcurso = $resultado["ID_CONCURSO"];
	//echo $resultado["NO_LOTERIA"] . " | ";
	$noloteria = $resultado["NO_LOTERIA"];
	//echo $resultado["NO_APELIDO"] . " | ";
	$noapelido = $resultado["NO_APELIDO"];
	//echo $resultado["ID_LOTERIA"] . " | ";
	$idloteria = $resultado["ID_LOTERIA"];
	//echo "</p>";

	// $conn
	$sql = "INSERT INTO sorteio(Resultado, DataHora, TipoResultado, IdConcurso, NoLoteria, NoApelido, IdLoteria)
	VALUES ('$result', '$datahora', '$tiporesultado', '$idconcurso', '$noloteria','$noapelido', '$idloteria');";

	//tá faltando executar a string sql declarada acima....

	// consegue verificar e corrigir o problema? sim mas vc apagou a primeira variavel a do resultado 

	#$row = mysqli_fetch_array($conn, $sql);

	$res = mysqli_query($conn, $sql);


	$erro = mysqli_error($conn);

	if($erro){
		echo $erro;
	}
}

$sql2 = "SELECT * FROM sorteio";
$teste = mysqli_query($conn, $sql2) or die("Bad Query: $sql2");

echo"<table border='1'>";
echo"<tr><td>Resultado</td><td>Data e Hora</td><td>Tipo de Resultado</td><td>ID Concurso</td><td>Nome Loteria</td><td>Apelido</td><td>ID Loteria</td></tr>";
while($row = mysqli_fetch_assoc($teste)){
	echo"<tr><td>{$row['Resultado']}</td><td>{$row['DataHora']}</td><td>{$row['TipoResultado']}</td><td>{$row['IdConcurso']}</td><td>{$row['NoLoteria']}</td><td>{$row['NoApelido']}</td><td>{$row['IdLoteria']}</td></tr>";
}



?>