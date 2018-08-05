<?php

class Reportes_model extends CI_Model {


    public function __construct(){
                // Call the CI_Model constructor
    	parent::__construct();
    }

	function obtenerVisitasPorUsuarioNumeroDias($usuario = 0, $dias = 8){

        $resultado = array();

        $sql = "SELECT COUNT(mueble)cantidad,mueble,usuario,fecha_visita,productos.nombre,productos.id_producto
                from visitas
                inner join productos on productos.id_producto = visitas.mueble
                where  
                    fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() and usuario = ?
                GROUP BY fecha_visita,mueble order by fecha_visita asc ";

        $q=$this->db->query($sql,array($dias,$usuario));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

	}
	
	
	function obtenerMueblesMasVisitadosPorNumeroDias($dias = 8){

        $resultado = array();

        $sql = "SELECT productos.nombre,COUNT(mueble)cantidad
                from visitas inner join productos on productos.id_producto = visitas.mueble 
                where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() GROUP BY mueble";

        $q=$this->db->query($sql,array($dias));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

	}	





}