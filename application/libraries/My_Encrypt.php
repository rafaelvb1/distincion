<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Encrypt extends CI_Encrypt

{

	function encode($string,$key='') {
	    $ret = parent::encode($string,'');

	    $ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));

	    return $ret;
	}

	function decode($string,$key='') {
	    $string = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));

	    return parent::decode($string,'');
	} 


}  

?>