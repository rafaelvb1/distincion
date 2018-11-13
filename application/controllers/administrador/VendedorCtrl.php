<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VendedorCtrl extends CI_Controller {


	private $ctgTiendaTabla      = "ctg_tienda";
	private $usuariosVendedorDb  = "usuario_vendedor";
	private $urlRedireccionUsuarios   = "admin/usuarios-listado";


	function VendedorCtrl()
	{
		parent::__construct();
		// VALIDACION DE SESION
		if(!validar_sesion()){
			redirect(base_url().LOGIN);
		}		
		$this->usuarioSesion = $this->session->userdata('usuario');
		$this->load->model("Vendedores_model","mVendedores");
		$this->load->model("Sucursal_model"  ,"mSucursal");
		$this->load->model("Reportes_model","mReportes");

	}


	function index(){
		$this->dashboardUsuario();
	}

	function dashboardVendedor(){

		$data['ubicacion']  = array('Dashboard','Vendedores por Aprobar');
		$data['titulo']     ='Listado de Vendedores por Tienda';
		$data['contenido']  ="administrador/vendedores/listado_tiendas_vendedores.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/vendedores/js/inicio.php";

		// OBTENER LISTADO DE TIENDAS
		$data['listadoTiendas'] = $this->mVendedores->obtenerTiendasVendedoresPorEstatus();

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}

	/**
	* Obtiene el listado de vendedores que han solicitado acceso a la aplicación
	*/
	function obtenerVendedoresPorAprobar($tiendaId = 0){

		$data['ubicacion']  = array('Dashboard','Vendedores por Aprobar');
		$data['titulo']     ='Vendedores por Aprobar';
		$data['contenido']  ="administrador/vendedores/listado_vendedores_por_aprobar.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/vendedores/js/inicio.php";

		// OBTENER LISTADO DE TIENDAS
		$data['vendedorPorAprobar'] = $this->mVendedores->obtenerVendedoresPorTiendaPorEstatus(0,"0,1,2,3","porEstatus");

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');
	}

	/**
	* Obtiene el listado de vendedores por tienda
	*/
	function obtenerVendedoresPorTienda($tiendaId = 0){

		$data['ubicacion']  = array('Dashboard','Vendedores');
		$data['contenido']  ="administrador/vendedores/listado_vendedores.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/vendedores/js/inicio.php";

		// OBTENER LISTADO DE TIENDAS
		$data['listadoVendedores'] = $this->mVendedores->obtenerVendedoresPorTiendaPorEstatus($tiendaId,"0","porTienda");
		
		// CONCATENA NOMBRE TIENDA
		$data['titulo']     ='Listado de Vendedores '."<b>".$data['listadoVendedores'][0]['nombre_tienda']."</b>";

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');
	}	


	function verDatosPersonalesVendedor($vendedorId = 0,$origen, $tipo="aprobacion"){


		$data['ubicacion']  = array('Dashboard','Detalle de Vendedor');
		$data['titulo']     ='Datos del Vendedor';
		$data['contenido']  ="administrador/vendedores/detalle_vendedor.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/vendedores/js/inicio.php";

		// OBTENER LISTADO DE TIENDAS
		$data['listadoTiendas'] = $this->entidad->getModelBase($this->ctgTiendaTabla,'id,nombre,estatus','nombre','ASC',null);

		// OBTENER LISTADO DE VENDEDORES POR TIENDA
		$data['detalleVendedor'] = $this->mVendedores->obtenerVendedoresPorTiendaPorEstatus($vendedorId,"0","porUsuario");

		// OBTENER LISTADO DE SUCURSALES
		$data['listadoSucursales'] = $this->mSucursal->obtenerDetalleSucursal($data['detalleVendedor'][0]['id_sucursal'],"sucursal");

		// CTG CIUDADADES
		$data['ctgCiudades'] = $this->entidad->getModelBase("estados",'id,nombre,abrev','nombre','ASC',null);

		// CTG LOCALIDADES
		$data['localidades'] = null;

		if (isset($data['detalleVendedor'][0]['estado_id'])) {
			$data['localidades'] = $this->entidad->getModelBase("municipios",'id,nombre','nombre','ASC',array('estado_id'=>$data['detalleVendedor'][0]['estado_id']));
		}		

		$data['tipo'] = $tipo;
		$data['urlRedireccion'] = $origen;

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');		

	}	

	function aprobarRechazarVendedor(){

		$datos = $this->input->post();

		$idVendedor = $datos['id_vendedor'];
		$accion    = $datos['accion'];
		$urlRedireccion = $datos['url_redireccion'];

		// REMOVER DATOS QUE NO VAN EN EL UPDATE
		unset($datos["id_vendedor"]);
		unset($datos["accion"]);
		unset($datos["url_redireccion"]);
		unset($datos["municipio"]);
		unset($datos["estado"]);
		unset($datos["tienda"]);


		if ($accion == "edicion") {
			$mensaje = "modificado" ;
		}else{
			$estatus = ( $accion == "Aprobar" ? 2:4 );
			$mensaje = ( $accion == "Aprobar" ? "aprobado":"rechazado" );
		}

		

		$datos['estatus'] = $estatus;
		$datos['usuario_modificacion'] = $this->usuarioSesion;
		$datos['fecha_modificacion']   = HOY;

		$respuesta = $this->entidad->update($this->usuariosVendedorDb,"id_vendedor",$idVendedor,$datos);

		if ($respuesta > 0) {
			$mensaje = "El usuario fue ".$mensaje;
			$tipoFlashData = "exitoso";
		}else{
			$mensaje = "El registro no puedo ser actualizado";
			$tipoFlashData = "error";
		}

		$this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->encrypt->decode($urlRedireccion));
	}
	
	
      function generarCodigo(){
    
         $data['ubicacion']  = array('Dashboard','Código de registro');
         $data['titulo']     ='Generador de código';
         $data['contenido']  ="administrador/vendedores/vendedor_codigo.php";
         
         $this->load->helper('string');
          
          $codigoActivacion = random_string('alnum', 12);
          $mensaje = "";
          
          $datos = array(
                          'fecha_creacion' => date("Y-m-d H:i:s") ,
                          'estatus' => 1,
                          'usuario_creacion'=>$this->usuarioSesion,
                          'codigo'=>$codigoActivacion
                  );
    
          $respuesta = $this->entidad->save($this->usuariosVendedorDb, $datos );
    
          if( $respuesta > 0 ){
            $mensaje = "El código de activación es: ".$codigoActivacion;
          }else{
            $mensaje = "Error, el código no se pudo crear";
          }
    
          $data['mensaje'] = $mensaje;
    
          // SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
          $this->load->vars($data);
          // CARGA TEMPLATE DEFAULT
          $this->load->view('template');
      }   
      
      
      function obtenerEstadisticasVendedor($usuario){
    
		 $data['ubicacion']  = array('Dashboard','Vendedores','Visitas');
		 $data['titulo']     ='Visitas últimos 8 días';
		 $data['contenido']  ="administrador/vendedores/vendedor_estadistica.php";
		 //JS EXTERNO
		 $data['js_externo'] ="administrador/usuarios/js/inicio.php";

		 // OBTENER LISTADO DE TIENDAS
		 $data['visitasVendedor'] = $this->mReportes->obtenerVisitasPorUsuarioNumeroDias($usuario);
		 $data['visitasVendedorMasaje'] = $this->mReportes->obtenerVisitasPorUsuarioNumeroDiasMasaje($usuario);
		 $data['visitasVendedorMecanismo'] = $this->mReportes->obtenerVisitasPorUsuarioNumeroDiasMecanismo($usuario);
		 $data['visitasVendedorLogin'] = $this->mReportes->obtenerVisitasPorUsuarioNumeroDiasLogin($usuario);

		 // SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		 $this->load->vars($data);
		 // CARGA TEMPLATE DEFAULT
		 $this->load->view('template');
      }       


	private function validaDiferenciaFechas($fechaInicial,$fechaFinal){

			$fecha1 = new DateTime($fechaInicial);
			$fecha2 = new DateTime($fechaFinal);

			$fecha = $fecha1->diff($fecha2);

			return $fecha->h;
	}




}