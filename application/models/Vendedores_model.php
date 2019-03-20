<?php

class Vendedores_model extends CI_Model {


    public function __construct(){
                // Call the CI_Model constructor
    	parent::__construct();
    }

	function obtenerVendedores($id = 0,$busquedaPor = "estatus"){

        $resultado = array();

        $sql = "select
                es.nombre estado_nombre,
                mu.nombre municipio_nombre ,
                su.nombre_sucursal,
                ctg_tienda.nombre,
                vend.nombre,
                vend.apellido_paterno,
                vend.apellido_materno,
                vend.correo,
                vend.celular,
                vend.estatus,
                vend.codigo,
                vend.fecha_codigo
                from usuario_vendedor vend
                inner join sucursal su on su.id_sucursal = vend.sucursal_id
                inner join ctg_tienda ct on ct.id = su.tienda_id
                inner join estados es on su.estado = es.id
                inner join municipios mu on mu.id = su.municipio
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


    function obtenerTiendasVendedoresPorEstatus(){

        $resultado = array();

        $sql = " SELECT ctg.id,
                ctg.nombre,
                ctg.path_foto,
                count(su.tienda_id) activo
                FROM usuario_vendedor vendedor
                inner JOIN sucursal su on su.id_sucursal = vendedor.sucursal_id
                inner join ctg_tienda ctg on ctg.id = su.tienda_id
                GROUP by su.tienda_id order by ctg.nombre asc ";

        $q=$this->db->query($sql);

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();

        $q-> free_result();

        return $resultado;

    }


    function obtenerVendedoresPorTiendaPorEstatus($llave=0,$estatus = 0, $tipo = 'porTienda'){

        $resultado = array();
        $valores   = array();

        $sql = "SELECT
                vendedor.id_vendedor,
                vendedor.nombre nombre_vendedor,
                vendedor.apellido_paterno,
                vendedor.apellido_materno,
                vendedor.codigo,
                vendedor.fecha_codigo,
                vendedor.correo,
                vendedor.celular,
                vendedor.usuario,
                vendedor.password,
                vendedor.fecha_creacion,
                su.id_sucursal,
                su.nombre_sucursal,
                su.nombre_completo_contacto contacto_sucursal,
                su.telefono_contacto telefono_sucursal,
                su.comentarios_contacto comentarios_sucursal,
                estados.nombre estado_nombre,
                municipios.nombre municipio_nombre,
                estados.id estado_id,
                municipios.id municipio_id,
                ctg.nombre nombre_tienda,
                ctg.id id_tienda
                FROM
                usuario_vendedor vendedor
                left JOIN sucursal su on su.id_sucursal = vendedor.sucursal_id
                left join ctg_tienda ctg on ctg.id = su.tienda_id
                left join estados on estados.id = su.estado
                left join municipios on municipios.id = su.municipio
                WHERE";

        if ($tipo == 'porTienda') {

            $sql .="
                ctg.id = ?
                order by ctg.nombre asc";

            array_push($valores,$llave);

        }else if ($tipo == 'porEstatus'){

            $sql .=" vendedor.estatus in (?)
                     order by ctg.nombre asc";
            array_push($valores,$estatus);
        }else{

            // porUsuario
            $sql .="
                vendedor.id_vendedor = ?
                order by ctg.nombre asc";

            array_push($valores,$llave);
        }

        $q=$this->db->query($sql,$valores);

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        //echo $this->db->last_query();

        $q-> free_result();

        return $resultado;
    }

    function obtenerVendedoresPorTiendaPorEstatusPorSucursal($tiendaId=0,$sucursalId = "0"){

        $resultado = array();
        $valores   = array();

        $sql = "SELECT
                vendedor.id_vendedor,
                vendedor.nombre nombre_vendedor,
               
                vendedor.devicetoken,
                su.id_sucursal,
                su.nombre_sucursal,
                ctg.nombre nombre_tienda,
                ctg.id id_tienda
                FROM
                usuario_vendedor vendedor
                left JOIN sucursal su on su.id_sucursal = vendedor.sucursal_id
                left join ctg_tienda ctg on ctg.id = su.tienda_id
                WHERE";

       

            $sql .="
                ctg.id = ?
                ";

            array_push($valores,$tiendaId);

       

            $sql .="and vendedor.estatus in (2)
                    ";

                    
            
       
            // porUsuario
            $sql .="and vendedor.sucursal_id in (
                ";
                $sql .=  $sucursalId;

                $sql .=") ";
            
        

        $q=$this->db->query($sql,$valores);

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

       // echo $this->db->last_query();

        $q-> free_result();

        return $resultado;
    }

    function validarVendedorValido($correo = "",$celular=""){

          $resultado = array();

          $sql = "select
                  vend.id_vendedor
                  from usuario_vendedor vend
                  where vend.correo = ? or vend.celular = ?  ";


          $q=$this->db->query($sql,array($correo,$celular));
          //echo $this->db->last_query();

          $total = $q->num_rows();

          $q-> free_result();

          return $total;

  	}
  	
  	 
    function validarCodigoValido($codigo = ""){

          $resultado = null;

          $sql = "select
                  TIMESTAMPDIFF(MINUTE , vend.fecha_creacion, now() ) AS diferencia 
                  from usuario_vendedor vend
                  where vend.codigo = ? and vend.estatus = 1 ";


          $q=$this->db->query($sql,array($codigo));
          //echo $this->db->last_query();

          if ($q->num_rows() > 0) {
    
                $resultado=$q->row_array();
          }
    
          $this->db->last_query();
    
          $q-> free_result();
    
          return $resultado;

  	}  	

    function obtenerMueblesPorTiendaCategoria($tiendaId,$categoriaId){
        

          $resultado = array();

          $sql = "SELECT *, (select path from producto_fotos where producto_id = producto_tienda.producto_id limit 1 ) path FROM productos
                  inner join producto_tienda on producto_tienda.producto_id = productos.id_producto
                  where
                  producto_tienda.tienda_id = ?
                  and productos.estatus = 1
                  order by productos.nombre ";

        $q=$this->db->query($sql,array($tiendaId));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();

        $q-> free_result();

        return $resultado;

  	}
  	
  	
    function obtenerMueblesPorTienda($tiendaId){

          $resultado = array();

          $sql = "SELECT *, (select path from producto_fotos where producto_id = producto_tienda.producto_id limit 1 ) path FROM productos
                  inner join producto_tienda on producto_tienda.producto_id = productos.id_producto
                  where
                  producto_tienda.tienda_id = ?
                  and productos.estatus = 1
                  and productos.id_producto_especial is null 
                  order by productos.orden";

        $q=$this->db->query($sql,array($tiendaId));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();

        $q-> free_result();
        //echo $this->db->last_query();
        return $resultado;

      }  	
      function obtenerMueblesPedidoEspecial($tiendaId,$productoId){

        $resultado = array();

        $sql = "SELECT *, (select path from producto_fotos where producto_id = producto_tienda.producto_id limit 1 ) path FROM productos
                inner join producto_tienda on producto_tienda.producto_id = productos.id_producto
                where
                producto_tienda.tienda_id = ?
                and productos.id_producto_especial = ?
                order by productos.orden";



      $q=$this->db->query($sql,array($tiendaId,$productoId));

      //echo $this->db->last_query();

      if ($q->num_rows() > 0) {

          $resultado=$q->result_array();
      }

      $this->db->last_query();

      $q-> free_result();

      return $resultado;

    }   
  	
    function validarCredencialesVendedor($usuario,$credencial){

          $resultado = array();

          $sql = "SELECT id_vendedor,apellido_paterno,apellido_materno,correo,su.tienda_id from 
			usuario_vendedor uv 
			inner join sucursal su on su.id_sucursal = uv.sucursal_id
			where 
			uv.correo = ? and 
			uv.password= ? and 
			uv.estatus = 2 and 
			uv.en_sesion = 0 ";
			
        $q=$this->db->query($sql,array($usuario,$credencial));
        
      //  return $this->db->last_query();

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        //$this->db->last_query();

        $q-> free_result();

        return $resultado;

  	}   	
  	
  	function checkemailidexist($table = NULL, $data = array()){
        $query = $this->db->get_where($table,$data);
        if($query->num_rows()){
            return 1;
        }else{
            return 0;
        }
    }
    
    
   function updatepassword($table = NULL, $searchData = array(), $updateData = array()){
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
    
    function getuserdetail($table = NULL, $userId = NULL){
        
        if($table != NULL && $userId != NULL){
             $sql = "SELECT $table.nombre as fullname, $table.celular as cellphone, $table.correo as useremail, $table.sucursal_id as branch  FROM $table LEFT JOIN sucursal ON $table.sucursal_id = sucursal.id_sucursal LEFT JOIN ctg_tienda ON ctg_tienda.id =  sucursal.tienda_id WHERE $table.id_vendedor = $userId";
            
             $q = $this->db->query($sql);
        
          //  return $this->db->last_query();
    
            if ($q->num_rows() > 0) {
    
                $resultdata = $q->result_array();
            }
    
            //$this->db->last_query();
    
            $q-> free_result();
    
            return $resultdata;
            
            }
        
        
        
    }
    
     function userupdatedata($table = NULL, $searchData = array(), $updateData = array()){
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
    
    function getresult($table = NULL){
        
        if($table != NULL){
            
            $where = '';
            
            if($table == 'productos' || $table == 'ctg_masaje' || $table == 'ctg_categorias'){
                $where = ' WHERE estatus = 1';
            }
            
            $sql = "SELECT * FROM $table  $where ";
            
             $q = $this->db->query($sql);
    
            if ($q->num_rows() > 0) {
    
                $resultdata = $q->result_array();
            }
    
    
            $q-> free_result();
    
            return $resultdata;
            
            
        }
        
    }

    function getresultProductos(){
        
        
            $table = 'productos';
            $where = ' WHERE estatus = 1 order by orden';
            
            $sql = "SELECT * FROM $table  $where ";
            
             $q = $this->db->query($sql);
    
            if ($q->num_rows() > 0) {
    
                $resultdata = $q->result_array();
            }

            $q-> free_result();
    
            return $resultdata;
    }
    
    
     function updatelogindata($table = NULL, $searchData = array(), $updateData = array()){
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
