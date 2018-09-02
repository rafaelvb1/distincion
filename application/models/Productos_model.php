<?php

class Productos_model extends CI_Model {


    public function __construct(){
                // Call the CI_Model constructor
    	parent::__construct();
    }

	function obtenerProductos($id = 0, $busquedaPor = "id"){

        $resultado = array();
        $params    = array();

        $sql = "SELECT 
                pro.id_producto,
                pro.nombre,
                pro.ancho,
                pro.alto,
                pro.profundo,
                pro.color_id,
                pro.tapiz_id,
                pro.mecanismo_id,
                pro.categoria_id,
                pro.masaje_id,
                pro.estatus,
                cat.nombre nombre_cat,
                col.nombre color_cat,
                tapiz.nombre tapiz_nombre,
                meca.nombre mecanismo_nombre,
                masaje.nombre masaje_nombre,
                pro.usuario_creacion creado_por,
                pro.fecha_creacion,
                pro.sku,
                pro.mecanismo,
                pro.masaje,
                pro.id_producto_especial
                FROM 
                productos pro
                inner join ctg_categorias cat on cat.id = pro.categoria_id
                inner join ctg_colores col on col.id = pro.color_id
                inner join ctg_tapiz tapiz on tapiz.id = pro.tapiz_id
                inner join ctg_mecanismos meca on meca.id = pro.mecanismo_id
                left join  ctg_masaje masaje on masaje.id = pro.masaje_id ";

        if ($busquedaPor == "id") {
            $sql .=" WHERE pro.id_producto = ? order by cat.nombre,pro.nombre asc ";
            $params = array($id);
        }

        $q=$this->db->query($sql,array($id));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }
    
    function obtenerProductosEspecial($id = 0, $busquedaPor = "id"){

        $resultado = array();
        $params    = array();

        $sql = "SELECT 
                pro.id_producto,
                pro.nombre,
                pro.ancho,
                pro.alto,
                pro.profundo,
                pro.color_id,
                pro.tapiz_id,
                pro.mecanismo_id,
                pro.categoria_id,
                pro.masaje_id,
                pro.estatus,
                cat.nombre nombre_cat,
                col.nombre color_cat,
                tapiz.nombre tapiz_nombre,
                meca.nombre mecanismo_nombre,
                masaje.nombre masaje_nombre,
                pro.usuario_creacion creado_por,
                pro.fecha_creacion,
                pro.sku,
                pro.mecanismo,
                pro.masaje
                FROM 
                productos pro
                inner join ctg_categorias cat on cat.id = pro.categoria_id
                inner join ctg_colores col on col.id = pro.color_id
                inner join ctg_tapiz tapiz on tapiz.id = pro.tapiz_id
                inner join ctg_mecanismos meca on meca.id = pro.mecanismo_id
                left join  ctg_masaje masaje on masaje.id = pro.masaje_id ";

        if ($busquedaPor == "id") {
            $sql .=" WHERE pro.id_producto_especial = ? order by cat.nombre,pro.nombre asc ";
            $params = array($id);
        }

        $q=$this->db->query($sql,array($id));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();
        
        $q-> free_result();

        return $resultado;

	}



    function obtenerTiendasPorProducto($id = 0){

        $resultado = array();

        $sql = "select 
                tienda.id,
                tienda.nombre,
                IFNULL(pt.producto_id,0) producto
                from ctg_tienda tienda
                LEFT JOIN producto_tienda pt on pt.tienda_id = tienda.id and pt.producto_id = ?
                GROUP by tienda.id ";


        $q=$this->db->query($sql,array($id));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        $this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }
    
    
    
	function filterProductos( $where){

        $resultado = array();
        $params    = array();

        $sql = "SELECT 
                pro.id_producto,
                pro.nombre,
                pro.ancho,
                pro.alto,
                pro.profundo,
                pro.color_id,
                pro.tapiz_id,
                pro.mecanismo_id,
                pro.categoria_id,
                pro.masaje_id,
                pro.estatus,
                cat.nombre nombre_cat,
                col.nombre color_cat,
                tapiz.nombre tapiz_nombre,
                meca.nombre mecanismo_nombre,
                masaje.nombre masaje_nombre,
                pro.usuario_creacion creado_por,
                pro.fecha_creacion,
                ptienda.tienda_id
                FROM 
                productos pro
                inner join ctg_categorias cat on cat.id = pro.categoria_id
                inner join ctg_colores col on col.id = pro.color_id
                inner join ctg_tapiz tapiz on tapiz.id = pro.tapiz_id
                inner join ctg_mecanismos meca on meca.id = pro.mecanismo_id
                inner join producto_tienda ptienda on ptienda.producto_id = pro.id_producto
                left join  ctg_masaje masaje on masaje.id = pro.masaje_id WHERE ".$where;


        $q=$this->db->query($sql);

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        $this->db->last_query();
        
        $q-> free_result();

        return $resultado;

	}    





}