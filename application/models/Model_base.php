<?php

class Model_base extends CI_Model {


    public function __construct(){
                // Call the CI_Model constructor
    	parent::__construct();
    }

    /**
    * Guarda en una sola tabla por medio de transacción
    */
	function save($tabla,$data){

		$this->db->trans_start();

		$this->db->insert($tabla, $data); 
        $id = $this->db->insert_id();

		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return 0;
        }else{
            $this->db->trans_commit();
            return $id;
        }

	}


    /**
    * Actualizar en una sola tabla por medio de transacción
    */
    function update($tabla,$campoId,$id,$data){

        $this->db->trans_start();

        $this->db->where($campoId, $id);
        $this->db->update($tabla, $data); 

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return 0;
        }else{
            $this->db->trans_commit();
            return 1;
        }

    }    


    /**
    * Eliminar en una sola tabla por medio de transacción
    */
    function delete($tabla,$campoId,$id){

        $this->db->trans_start();

        $this->db->where($campoId, $id);
        $this->db->delete($tabla); 

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return 0;
        }else{
            $this->db->trans_commit();
            return 1;
        }

    }     

    /**
    * Actualizar en una sola tabla por medio de transacción
    */
    function updateBatch($tabla,$campoId,$data){

        $this->db->update_batch($tabla, $data, $campoId);

    }     


    /**
    * Recibe un array asociativo , la llave es la tabla y el valor un array con datos a insertar
    */
    function saveArray($datos){

        $this->db->trans_start();


        foreach ($datos as $tabla => $campos) {
            $this->db->insert($tabla, $campos); 
            echo $this->db->last_query();
        }

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return 0;
        }else{
            $this->db->trans_commit();
            return 1;
        }

    }    


    /**
    * Obtiene datos básicos de una sola tabla
    * @param $tabla nombre de la tabla 
    * @param $parametros campos a obtener de la tabla separados por ,
    * @param $campoOrder campo sobre el cual va a ordear el listado
    * @param $tipoOrder DESC-ASC
    * @param $arrayWhere array() con parámetros aplicar al where
    */
    function getModelBase($tabla,$parametros,$campoOrder,$tipoOrder,$arrayWhere){
        
        $resultado = array();

        $this->db->select($parametros);
        if(!empty( $arrayWhere) ){
            $this->db->WHERE($arrayWhere);    
        }
        $this->db->order_by($campoOrder, $tipoOrder);
        $q = $this->db->get($tabla);

         if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();

        //echo "</br>";
        //echo $this->db->last_query(); 
        
        $q-> free_result();

        return $resultado;
    }




}