<?php

class Sucursal_model extends CI_Model {


    public function __construct(){
                // Call the CI_Model constructor
    	parent::__construct();
    }

    /**
    * Guarda en una sola tabla por medio de transacción
    */
	function obtenerDetalleSucursal($id = 0,$busquedaPor = "tienda"){

        $resultado = array();

        $sql = "select 
                ct.id id_tienda,
                ct.nombre nombre_tienda,
                ct.estatus as estatus_tienda, 
                es.nombre estado_nombre, 
                mu.nombre municipio_nombre, 
                su.nombre_sucursal , 
                su.codigo codigo_sucursal, 
                su.id_sucursal ,
                su.estatus estatus_sucursal,
                su.usuario_creacion creada_por ,
                su.nombre_completo_contacto,
                su.telefono_contacto,
                su.correo_contacto,
                su.estado estado_id,
                su.municipio municipio_id,
                su.comentarios_contacto,
                su.cp
                from sucursal su 
                inner join estados es on su.estado = es.id
                inner join municipios mu on mu.id = su.municipio
                inner join ctg_tienda ct on ct.id = su.tienda_id
                where ";

        if ($busquedaPor == "tienda") {
            $sql .=" su.tienda_id = ? ";
        }else{
            $sql .=" su.id_sucursal = ? ";
        }

        $q=$this->db->query($sql,array($id));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();
        
        $q-> free_result();

        return $resultado;

	}


}