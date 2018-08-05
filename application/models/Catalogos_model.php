<?php

class Catalogos_model extends CI_Model {


    public function __construct(){
        // Call the CI_Model constructor
    	parent::__construct();
    }

    /**
    /* Obtiene los nombres de los puestos
    /* $campoOrder campo de la base de datos sobre el cual aplicar el ordenamiento
    /* $orderTipo  ordenamiento DESC-ASC
    /* $propiedad  campo de la BD sobre la cual buscar
    /* $valores    array sobre los cuales buscara el campo, por ejemplo array('juan','pedro',10)
    */
    function getCtgPuestos($campoOrder,$tipoOrder,$propiedad,$valores){
        
        $resultado = array();

        $this->db->select('idctg_puesto,nombre_puesto,estatus');
        $this->db->where_in($propiedad,$valores);
        $this->db->order_by($campoOrder, $tipoOrder);
        $q = $this->db->get('ctg_puesto');

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();
        
        $q-> free_result();

        return $resultado;
    }


    function getExamenPorPuesto($puestoId){

        $resultado = array();

        $sql = "SELECT ex.id_examen, ex.nombre_examen FROM examen ex
                INNER JOIN puesto_examen ON puesto_examen.`examen_id` = ex.id_examen
                WHERE puesto_examen.ctg_puesto_id = ? ORDER BY ex.nombre_examen ASC ";

        $q = $this->db->query($sql,intval($puestoId));

        //echo $this->db->last_query();

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }




}