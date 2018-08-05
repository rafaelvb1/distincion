<?php

class Mensajes_model extends CI_Model {


    public function __construct(){
                // Call the CI_Model constructor
    	parent::__construct();
    }

	function obtenerMensajes($tipo,$id,$limit){

        $resultado = array();

        $sql = "SELECT * FROM mensajes WHERE para_tipo=? and para_id=? order by id desc limit ? ";

        $q=$this->db->query($sql,array($tipo,$id,$limit));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

	}


}