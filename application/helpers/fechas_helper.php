<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cFecha'))
{
	/**
	* traduce la fecha a formato deseado
	* @param String fecha - fecha a formatear
	* @param String $formato - Formato al cual se desea convertir
	*/
	function cFecha($fecha="",$formato="Y/m/d")
	{
		return date($formato, strtotime($fecha));
	}   
}


if ( ! function_exists('cFeHuman'))
{
	/**
	* traduce la fecha a formato humano dia-nombre dia-nombre mes-año
	* @param String fecha - fecha a formatear
	* @param int $tipo - 
	*/
	function cFeHuman($fecha="",$tipo=1)
	{

		if ($fecha === "") {
			$fecha = date('Y-m-d H:i:s');
		}

		$pfecha= date("Y-m-d H:i:s", strtotime($fecha));

		$pfecha = new DateTime($fecha);

		$dia = convertirDia(strtolower( $pfecha->format('l') ),"corto");
		$mes = convertirMes(strtolower( $pfecha->format('F') ),"corto");

		$diaL = convertirDia(strtolower( $pfecha->format('l') ),"largo");
		$mesL = convertirMes(strtolower( $pfecha->format('F') ),"largo");

		switch ($tipo) {
			// Sa 31-Ago-2013 nombre dia número dia/Mes/anio
			case 1:
				$fecha = $dia." ".$pfecha->format('d')."-".$mes."-".$pfecha->format('Y');
			break;
			case 2:
			// dd-mm-yy
				$fecha= date("d-m-Y", strtotime($fecha));
			break;
			case 3:
			// dd-mm-yy 5: 45 pm
				$fecha = $pfecha->format('d')."-".$mes."-".$pfecha->format('Y')." ".$pfecha->format('g:i A');
			break;
			case 4:
				$fecha = $diaL." ".$pfecha->format('d')."-".$mesL."-".$pfecha->format('Y')." ".$pfecha->format('g:i A');
			break;
		}

		return $fecha;

	}   

	/**
	* Convertir el mes a humano y regresa el nombre largo o corto
	* @param String $mes - nombre del mes en ingles
	* @param String $tipo - corto | largo
	* @return String
	*/
	function convertirMes($mes,$tipo="corto"){

		$mCorto =""; $mLargo="";

		switch ($mes) {
			case 'january':
				$mCorto="Ene";
				$mLargo="Enero";
			break;
			case 'february':
				$mCorto="Feb";
				$mLargo="Febrero";
			break;
			case 'march':
				$mCorto="Mar";
				$mLargo="Marzo";
			break;
			case 'april':
				$mCorto="Abr";
				$mLargo="Abril";
			break;
			case 'may':
				$mCorto="May";
				$mLargo="Mayo";
			break;
			case 'june':
				$mCorto="Jun";
				$mLargo="Junio";
			break;
			case 'july':
				$mCorto="Jul";
				$mLargo="Julio";
			break;
			case 'august':
				$mCorto="Ago";
				$mLargo="Agosto";
			break;    
			case 'september':
				$mCorto="Sep";
				$mLargo="Septiembre";
			break;
			case 'october':
				$mCorto="Oct";
				$mLargo="Octubre";
			break;
			case 'november':
				$mCorto="Nov";
				$mLargo="Noviembre";
			break;
			case 'december':
				$mCorto="Dic";
				$mLargo="Diciembre";
			break;        
		}

		if ($tipo === "corto") {
			return $mCorto;
		}else{
			return $mLargo;
		}
	}


    /**
    * Convierte el día a humano y regresa el corto o largo
    * @param String $mes - nombre del mes en ingles
	* @param String $tipo - corto | largo
	* @return String
    */
	function convertirDia($dia,$tipo="corto"){

		$dCorto = ""; $dLargo = "";

		switch ($dia) {
			case 'monday':
			$dCorto="Lun";
			$dLargo="Lunes";
			break;
			case 'tuesday':
			$dCorto="Mar";
			$dLargo="Martes";
			break;
			case 'wednesday':
			$dCorto="Mier";
			$dLargo="Miércoles";
			break;
			case 'thursday':
			$dCorto="Jue";
			$dLargo="Jueves";
			break;
			case 'friday':
			$dCorto="Vi";
			$dLargo="Viernes";
			break;
			case 'saturday':
			$dCorto="Sab";
			$dLargo="Sábado";
			break;
			case 'sunday':
			$dCorto="Dom";
			$dLargo="Domingo";
			break;
		}

		if ($tipo === "corto") {
			return $dCorto;
		}else{
			return $dLargo;
		}

	}
}