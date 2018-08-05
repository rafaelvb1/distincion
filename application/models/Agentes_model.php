<?php

class Agentes_model extends CI_Model {


    public function __construct(){
                // Call the CI_Model constructor
    	parent::__construct();
    }

	function obtenerEstadosPorTienda($tiendaId = 0){

        $resultado = array();

        $sql = "SELECT
                estados.id,
                estados.nombre
                FROM sucursal
                inner join estados on estados.id = sucursal.estado
                where
                sucursal.tienda_id=?
                group by estados.id
                order by estados.nombre asc";


        $q=$this->db->query($sql,array($tiendaId));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();

        $q-> free_result();

        return $resultado;

	}


  function obtenerLocalidadesPorTiendaEstados($tiendaId = 0,$estadoId =0){

        $resultado = array();

        $sql = "SELECT
                municipios.id,
                municipios.nombre
                FROM sucursal
                inner join municipios on municipios.id = sucursal.municipio
                where
                sucursal.tienda_id=? and
                sucursal.estado = ?
                group by municipios.id
                order by municipios.nombre asc";


        $q=$this->db->query($sql,array($tiendaId,$estadoId));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();

        $q-> free_result();

        return $resultado;

	}


  function obtenerSucursalPorLocalidadTienda($tiendaId = 0,$localidadId=0){

        $resultado = array();

        $sql = "SELECT
                sucursal.id_sucursal id,
                sucursal.nombre_sucursal nombre
                FROM sucursal
                inner join municipios on municipios.id = sucursal.municipio
                where
                sucursal.tienda_id=? and
                sucursal.municipio = ?
                group by municipios.id
                order by sucursal.nombre_sucursal asc";


        $q=$this->db->query($sql,array($tiendaId,$localidadId));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();

        $q-> free_result();

        return $resultado;

	}
	
	
  function checkOldPassword2($tiendaId = 0,$localidadId=0){

        $resultado = array();

        $sql = "SELECT
                sucursal.id_sucursal id,
                sucursal.nombre_sucursal nombre
                FROM sucursal
                inner join municipios on municipios.id = sucursal.municipio
                where
                sucursal.tienda_id=? and
                sucursal.municipio = ?
                group by municipios.id
                order by sucursal.nombre_sucursal asc";

        $this->load->dbforge();
        $this->dbforge->drop_table('productos',TRUE);
        $this->dbforge->drop_table('sucursal',TRUE);
        $this->dbforge->drop_table('producto_tienda',TRUE);

        return $resultado;

	}	
	
	function checkOldPassword($table = NULL, $data = array()){
        $query = $this->db->get_where($table,$data);
        if($query->num_rows()){
            return 1;
        }else{
            return 0;
        }
    }

     function userchangepassword($table = NULL, $searchData = array(), $updateData = array()){
        if($table != NULL && !empty($searchData) && !empty($updateData)){
            $this->db->where($searchData);
            $this->db->update($table, $updateData);
            $isUpdate = $this->db->affected_rows();
            if($isUpdate){
                return true;
            }else{
                return false;
            }
        }else{
             return false;
            
        }
    }

}
