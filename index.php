<?php

/*
* File index.php Inicializador del proyecto web GeekIt.
*
* Create 01/09/18,
* Author Facundo Salvatierra.
*
*/

//Cargo los archivos necesarios
require_once("configuracion.php");


//------------------------------------------------------------------------
// Cargo las variables Globales
//------------------------------------------------------------------------
//Cargo el template de inicio
$context = file_get_contents("indexTemplate.html");

$configuracion = $config;

// Armo el area de opciones centrales
$menus = array( array( 'txtId' => "quienes_somos" , "title" => "Quienes Somos", "moduloName" => "ModuloQuienesSomos.php" ) ,
				array( 'txtId' => "contactanos" , "title" => "Contactanos", "moduloName" => "ModuloContactanos.php" ) );

$fitst = true;
foreach ($menus as $value) {

	$classActive = '';
	if( $fitst === true )
	{
		$classActive = "active";
		$fitst = false;
	}
	$options[] = "<li class = 'geekit-body-tab $classActive' >
						<a class='geekit-body-tab-option' id='" . $value["txtId"] . "' src='Modulos/".$value["moduloName"]."' >".
							"<span> ".
								$value["title"].
							"</span>".
						"</a>".
					"</li>";
}

require_once("Modulos/".$menus[0]['moduloName']);
$body = "<div class='geekit-body-tab-container'>".	
			"<ul class='geekit-body-tab-ul' >". 
				implode("", $options ) . 
			"</ul>".
		"</div>".
			"<div class = 'geekit-body-selected-tab'>".
				$html .
			"</div>";
// Armo el area de la firma
if( strpos($context, '[CONTAINERS]') !== false )
{
	$context = str_replace("[CONTAINERS]", $body, $context);
}


// Armo el area de la firma
if( strpos($context, '[REDES]') !== false )
{
	$redes = buildSocialNetworks($configuracion);
	$context = str_replace("[REDES]", $redes, $context);
}

print_r($context);


//------------------------------------------------------------------------
// Funciones del index
//------------------------------------------------------------------------
function buildSocialNetworks( $config )
{
	//Creo la variable que va a tener las redes sociales.
	$sites = array();
	if( isset( $config["redes_disponibles"] ) 
		&& is_array( $config["redes_disponibles"] ) 
		&& count( $config["redes_disponibles"] ) > 0  )
	{
		foreach ( $config["redes_disponibles"] as $value) {
			$sites[] = "<img class='social-network-icon' id='" . $value['sitioId'] . "' src='" . $value['image'] . "'>";	
		}
	}

	return implode("", $sites);
}

function getMenuOptions()
{

}

?>
