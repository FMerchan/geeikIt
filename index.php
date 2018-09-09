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

?>
