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
                    and tipo_visita = 'detalle'
                GROUP BY fecha_visita,mueble order by fecha_visita asc ";

        $q=$this->db->query($sql,array($dias,$usuario));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }
    function obtenerVisitasPorUsuarioNumeroDiasMasaje($usuario = 0, $dias = 8){

        $resultado = array();

        $sql = "SELECT COUNT(mueble)cantidad,mueble,usuario,fecha_visita,ctg_masaje.nombre,ctg_masaje.id
                from visitas
                inner join ctg_masaje on ctg_masaje.id = visitas.mueble
                where  
                    fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() and usuario = ?
                    and tipo_visita = 'masaje'
                GROUP BY fecha_visita,mueble order by fecha_visita asc ";

        $q=$this->db->query($sql,array($dias,$usuario));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }
    function obtenerVisitasPorUsuarioNumeroDiasMecanismo($usuario = 0, $dias = 8){

        $resultado = array();

        $sql = "SELECT COUNT(mueble)cantidad,mueble,usuario,fecha_visita,ctg_mecanismos.nombre,ctg_mecanismos.id
                from visitas
                inner join ctg_mecanismos on ctg_mecanismos.id = visitas.mueble
                where  
                    fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() and usuario = ?
                    and tipo_visita = 'mecanismo'
                GROUP BY fecha_visita,mueble order by fecha_visita asc ";

        $q=$this->db->query($sql,array($dias,$usuario));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }
    function obtenerVisitasPorUsuarioNumeroDiasLogin($usuario = 0, $dias = 8){

        $resultado = array();

        $sql = "SELECT COUNT(visitas.usuario)cantidad,fecha_visita,usuario_vendedor.nombre
        from visitas inner join usuario_vendedor on usuario_vendedor.id_vendedor = visitas.usuario 
        where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() and visitas.usuario= ?
        and tipo_visita = 'login' GROUP BY fecha_visita,visitas.usuario order by fecha_visita asc";

        $q=$this->db->query($sql,array($dias,$usuario));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

	}
	
	
	function obtenerMueblesMasVisitadosPorNumeroDias( $dias = 8,$tipo= 'detalle' ){

        $resultado = array();

        $sql = "SELECT productos.nombre,COUNT(mueble)cantidad
                from visitas inner join productos on productos.id_producto = visitas.mueble 
                where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() 
                and tipo_visita = ? GROUP BY mueble";

        $q=$this->db->query($sql,array($dias,$tipo));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }	
    
    //ESTADISTICAS MASAJE
    function obtenerMasajeMasVisitadosPorNumeroDias( $dias = 8,$tipo= 'masaje' ){

        $resultado = array();

        $sql = "SELECT ctg_masaje.nombre,COUNT(mueble)cantidad
                from visitas inner join ctg_masaje on ctg_masaje.id = visitas.mueble 
                where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() 
                and tipo_visita = ? GROUP BY mueble";

        $q=$this->db->query($sql,array($dias,$tipo));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }	
    
    function obtenerMecamismoMasVisitadosPorNumeroDias( $dias = 8,$tipo= 'mecanismo' ){

        $resultado = array();

        $sql = "SELECT ctg_mecanismos.nombre,COUNT(mueble)cantidad
                from visitas inner join ctg_mecanismos on ctg_mecanismos.id = visitas.mueble 
                where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() 
                and tipo_visita = ? GROUP BY mueble";

        $q=$this->db->query($sql,array($dias,$tipo));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }	

    function obtenerLoginVendedorPorNumeroDias( $dias = 8,$tipo= 'login' ){

        $resultado = array();

        $sql = "SELECT usuario_vendedor.nombre,COUNT(visitas.usuario)cantidad
        from visitas inner join usuario_vendedor on usuario_vendedor.id_vendedor = visitas.usuario 
        where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() 
        and tipo_visita = ? GROUP BY visitas.usuario";

        $q=$this->db->query($sql,array($dias,$tipo));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }
        
        //echo $this->db->last_query();

        //$this->db->last_query();
        
        $q-> free_result();

        return $resultado;

    }

    //estadisticas dashboard por tienda



    //estadisticas dashboard por tienda
    function obtenerMueblesMasVisitadosPorNumeroDiasAndTienda( $tienda= 0 ){

        $resultado = array();

        $sql = "SELECT ti.nombre ,ti.id as id_tienda,us.id_vendedor,us.usuario,vi.usuario as id_usuario ,count(*), vi.tipo_visita FROM distapp_mobil.visitas as vi
        join usuario_vendedor as us
        on vi.usuario=us.id_vendedor
        join sucursal as su
        on su.id_sucursal=us.sucursal_id
        join ctg_tienda as ti
        on ti.id=su.tienda_id ";
        
        if($tienda>0)
        $sql .="where ti.id=?";

        $sql .=" group by vi.usuario ,tipo_visita 
        order by id_vendedor";


        $q=$this->db->query($sql,array($tienda));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        //echo $this->db->last_query();

        //$this->db->last_query();

        $q-> free_result();

        $idTemporal=0;
		$idTemporalAnterior=0;
		$registroTemporal=array();
		$registroTemporalAnterior=array();
		$listadoTabla=array();


		foreach ($resultado  as $registro) {
			
			
			
			if($idTemporal==0){
				$idTemporal=$registro['id_vendedor'];

				$registroTemporal["usuario"] = $registro['usuario'];
				$registroTemporal["tienda"] = $registro['id_tienda'];
				$registroTemporal["detalle"] = 0;
				$registroTemporal["total"] = 0;
				$registroTemporal["masaje"] = 0;
				$registroTemporal["mecanismo"] = 0;
			}else{
				$idTemporal=$registro['id_vendedor'];
				if($idTemporalAnterior!=$idTemporal){
					$registroTemporalAnterior["total"] = $registroTemporalAnterior["total"] +$registroTemporalAnterior["detalle"]+$registroTemporalAnterior["masaje"]+$registroTemporalAnterior["mecanismo"];
					array_push(	$listadoTabla,$registroTemporalAnterior);	
					$registroTemporal=array();
					$registroTemporal["usuario"] = $registro['usuario'];
					$registroTemporal["tienda"] = $registro['id_tienda'];
					$registroTemporal["detalle"] = 0;
					$registroTemporal["total"] = 0;
					$registroTemporal["masaje"] = 0;
					$registroTemporal["mecanismo"] = 0;
				}

			}

			
			$registroTemporalAnterior=$registroTemporal;

			if($registro['tipo_visita']=='detalle')
				$registroTemporal["detalle"] = $registro['count(*)'];
			if($registro['tipo_visita']=='login')
				$registroTemporal["login"] = $registro['count(*)'];
			if($registro['tipo_visita']=='masaje')
				$registroTemporal["masaje"] = $registro['count(*)'];
			if($registro['tipo_visita']=='mecanismo')
				$registroTemporal["mecanismo"] = $registro['count(*)'];

            
		
			$idTemporalAnterior=$registro['id_vendedor'];
		
		}
		array_push(	$listadoTabla,$registroTemporalAnterior);	
		$resultado=$listadoTabla;

        return $resultado;

    }
    //estadisticas dashboard por tienda
    function obtenerMueblesMasVisitadosPorNumeroDiasAndTienda2( $tienda= 0, $fechaInicio, $fechaFin ){

        $resultado = array();

        $sql = "SELECT ti.nombre ,ti.id as id_tienda,us.id_vendedor,us.usuario,vi.usuario as id_usuario ,count(*), vi.tipo_visita FROM distapp_mobil.visitas as vi
        join usuario_vendedor as us
        on vi.usuario=us.id_vendedor
        join sucursal as su
        on su.id_sucursal=us.sucursal_id
        join ctg_tienda as ti
        on ti.id=su.tienda_id
        where ";

       if($tienda>0)
           $sql .=" ti.id=? and vi.fecha_visita >= ? and vi.fecha_visita <=? ";

        if($tienda<=0)
            $sql .="  vi.fecha_visita >= ? and vi.fecha_visita <=? ";

        $sql .=" group by vi.usuario ,tipo_visita 
        order by id_vendedor";


        $q=$this->db->query($sql,array($tienda));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        //echo $this->db->last_query();

        //$this->db->last_query();

        $q-> free_result();

        $idTemporal=0;
        $idTemporalAnterior=0;
        $registroTemporal=array();
        $registroTemporalAnterior=array();
        $listadoTabla=array();


        foreach ($resultado  as $registro) {



            if($idTemporal==0){
                $idTemporal=$registro['id_vendedor'];

                $registroTemporal["usuario"] = $registro['usuario'];
                $registroTemporal["tienda"] = $registro['id_tienda'];
                $registroTemporal["detalle"] = 0;
                $registroTemporal["total"] = 0;
                $registroTemporal["masaje"] = 0;
                $registroTemporal["mecanismo"] = 0;
            }else{
                $idTemporal=$registro['id_vendedor'];
                if($idTemporalAnterior!=$idTemporal){
                    $registroTemporalAnterior["total"] = $registroTemporalAnterior["total"] +$registroTemporalAnterior["detalle"]+$registroTemporalAnterior["masaje"]+$registroTemporalAnterior["mecanismo"];
                    array_push(	$listadoTabla,$registroTemporalAnterior);
                    $registroTemporal=array();
                    $registroTemporal["usuario"] = $registro['usuario'];
                    $registroTemporal["tienda"] = $registro['id_tienda'];
                    $registroTemporal["detalle"] = 0;
                    $registroTemporal["total"] = 0;
                    $registroTemporal["masaje"] = 0;
                    $registroTemporal["mecanismo"] = 0;
                }

            }


            $registroTemporalAnterior=$registroTemporal;

            if($registro['tipo_visita']=='detalle')
                $registroTemporal["detalle"] = $registro['count(*)'];
            if($registro['tipo_visita']=='login')
                $registroTemporal["login"] = $registro['count(*)'];
            if($registro['tipo_visita']=='masaje')
                $registroTemporal["masaje"] = $registro['count(*)'];
            if($registro['tipo_visita']=='mecanismo')
                $registroTemporal["mecanismo"] = $registro['count(*)'];



            $idTemporalAnterior=$registro['id_vendedor'];

        }
        array_push(	$listadoTabla,$registroTemporalAnterior);
        $resultado=$listadoTabla;

        return $resultado;

    }

    //ESTADISTICAS MASAJE
    function obtenerMasajeMasVisitadosPorNumeroDiasAndTienda( $dias = 8,$tipo= 'masaje', $tienda= 'tienda' ){

        $resultado = array();

        $sql = "SELECT ctg_masaje.nombre,COUNT(mueble)cantidad
                from visitas inner join ctg_masaje on ctg_masaje.id = visitas.mueble 
                where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() 
                and tipo_visita = ? GROUP BY mueble";

        $q=$this->db->query($sql,array($dias,$tipo));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        //echo $this->db->last_query();

        //$this->db->last_query();

        $q-> free_result();

        return $resultado;

    }

    function obtenerMecamismoMasVisitadosPorNumeroDiasAndTienda( $dias = 8,$tipo= 'mecanismo', $tienda= 'tienda' ){

        $resultado = array();

        $sql = "SELECT ctg_mecanismos.nombre,COUNT(mueble)cantidad
                from visitas inner join ctg_mecanismos on ctg_mecanismos.id = visitas.mueble 
                where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() 
                and tipo_visita = ? GROUP BY mueble";

        $q=$this->db->query($sql,array($dias,$tipo));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        //echo $this->db->last_query();

        //$this->db->last_query();

        $q-> free_result();

        return $resultado;

    }

    function obtenerLoginVendedorPorNumeroDiasAndTienda( $dias = 8,$tipo= 'login', $tienda= 'tienda' ){

        $resultado = array();

        $sql = "SELECT usuario_vendedor.nombre,COUNT(visitas.usuario)cantidad
        from visitas inner join usuario_vendedor on usuario_vendedor.id_vendedor = visitas.usuario 
        where fecha_visita >= DATE_SUB(CURDATE(), INTERVAL ? DAY) and fecha_visita <=CURDATE() 
        and tipo_visita = ? GROUP BY visitas.usuario";

        $q=$this->db->query($sql,array($dias,$tipo));

        if ($q->num_rows() > 0) {

            $resultado=$q->result_array();
        }

        //echo $this->db->last_query();

        //$this->db->last_query();

        $q-> free_result();

        return $resultado;

    }





}