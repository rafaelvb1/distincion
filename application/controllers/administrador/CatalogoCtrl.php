<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CatalogoCtrl extends CI_Controller {


	private $ctgTiendaTabla              = "ctg_tienda";
	private $urlRedireccionTienda        = "admin/catalogos-nombre-tiendas";
	private $ctgCategoriasProductosTabla = "ctg_categorias";
	private $urlCategoriasProductosTabla = "admin/catalogos-categorias-productos";
	private $ctgMecanismosProductosTabla = "ctg_mecanismos";
	private $urlMecanismosProductosTabla = "admin/catalogos-mecanismo-productos";	
	private $ctgColoresProductosTabla    = "ctg_colores";
	private $urlColoresProductosTabla    = "admin/catalogos-colores-productos";
	private $ctgTapizProductosTabla      = "ctg_tapiz";
	private $urlTapizProductosTabla      = "admin/catalogos-tapiz-productos";	
	private $ctgMasajeProductosTabla     = "ctg_masaje";
	private $urlMasajeProductosTabla     = "admin/catalogos-masaje-productos";	
	private $ctgMailTabla                = "ctg_mail_categoria";
	private $urlRedireccionCategoria     = "admin/catalogos-mail-categoria";

	private $urlRedireccionDashboardCataogos = "administrador/CatalogoCtrl/dashboardCatalogos";
	private $usuarioSesion;


	function CatalogoCtrl()
	{
		parent::__construct();
		// VALIDACION DE SESION
		$this->usuarioSesion = $this->session->userdata('usuario');
		if(!validar_sesion()){
			redirect(base_url().LOGIN);
		}

	}


	function index(){
		$this->dashboardCatalogos();
	}


	function dashboardCatalogos(){

		$data['ubicacion']  = array(base_url().DASHBOARD => 'Dashboard','Catálogos');
		$data['titulo']     ='Catálogos';
		$data['contenido']  ="administrador/catalogos/listado_catalogos.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}



	function ctgMailCategoria(){

		$data['ubicacion']      = array(base_url().DASHBOARD =>'Dashboard',base_url().'admin/catalogos-listado' =>'Catálogos','#'=>'Categoría correo');
		$data['titulo']         ='Catálogo Correo';
		$data['contenido']      ="administrador/catalogos/generico_crud_catalogos.php";
		$data['tipoCatalogoBd'] = $this->ctgMailTabla; // NOMBRE DE LA TABLA 
		$data['urlRedireccion'] = $this->urlRedireccionCategoria; // URL A LA QUE REDIRECCIONARÁ TERMINADO EL FLUJO
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// OBTENER DATOS DEL CATÁLOGO
		$data['ctgDatos'] = $this->entidad->getModelBase($this->ctgMailTabla,'id,usuario_creacion,usuario_modificacion,nombre,estatus,fecha_creacion,fecha_modificacion','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}


	function ctgMasaje(){

		$data['ubicacion']      = array(base_url().DASHBOARD =>'Dashboard',base_url().'admin/catalogos-listado' =>'Catálogos','#'=>'Estilo Masaje');
		$data['titulo']         ='Catálogo Estilo Masaje';
		$data['contenido']      ="administrador/catalogos/generico_crud_catalogos.php";
		$data['tipoCatalogoBd'] = $this->ctgMasajeProductosTabla; // NOMBRE DE LA TABLA 
		$data['urlRedireccion'] = $this->urlMasajeProductosTabla; // URL A LA QUE REDIRECCIONARÁ TERMINADO EL FLUJO
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// OBTENER DATOS DEL CATÁLOGO
		$data['ctgDatos'] = $this->entidad->getModelBase($this->ctgMasajeProductosTabla,'id,usuario_creacion,usuario_modificacion,nombre,estatus,fecha_creacion,fecha_modificacion','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}	


	function ctgColores(){

		$data['ubicacion']      = array(base_url().DASHBOARD =>'Dashboard',base_url().'admin/catalogos-listado' =>'Catálogos','#'=>'Colores Productos');
		$data['titulo']         ='Catálogo Colores Productos';
		$data['contenido']      ="administrador/catalogos/generico_crud_catalogos.php";
		$data['tipoCatalogoBd'] = $this->ctgColoresProductosTabla; // NOMBRE DE LA TABLA 
		$data['urlRedireccion'] = $this->urlColoresProductosTabla; // URL A LA QUE REDIRECCIONARÁ TERMINADO EL FLUJO
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// OBTENER DATOS DEL CATÁLOGO
		$data['ctgDatos'] = $this->entidad->getModelBase($this->ctgColoresProductosTabla,'id,usuario_creacion,usuario_modificacion,nombre,estatus,fecha_creacion,fecha_modificacion','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}	


	function ctgTapiz(){

		$data['ubicacion']      = array(base_url().DASHBOARD =>'Dashboard',base_url().'admin/catalogos-listado' =>'Catálogos','#'=>'Tapiz Productos');
		$data['titulo']         ='Catálogo Tapíz Productos';
		$data['contenido']      ="administrador/catalogos/generico_crud_catalogos.php";
		$data['tipoCatalogoBd'] = $this->ctgTapizProductosTabla; // NOMBRE DE LA TABLA 
		$data['urlRedireccion'] = $this->urlTapizProductosTabla; // URL A LA QUE REDIRECCIONARÁ TERMINADO EL FLUJO
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// OBTENER DATOS DEL CATÁLOGO
		$data['ctgDatos'] = $this->entidad->getModelBase($this->ctgTapizProductosTabla,'id,usuario_creacion,usuario_modificacion,nombre,estatus,fecha_creacion,fecha_modificacion','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}		



	function ctgTiendas(){

		$data['ubicacion']      = array(base_url().DASHBOARD =>'Dashboard',base_url().'admin/catalogos-listado' =>'Catálogos','#'=>'Nombre Tiendas');
		$data['titulo']         ='Catálogo Nombre Tiendas';
		$data['contenido']      ="administrador/catalogos/generico_crud_catalogos.php";
		$data['tipoCatalogoBd'] = $this->ctgTiendaTabla; // NOMBRE DE LA TABLA 
		$data['urlRedireccion'] = $this->urlRedireccionTienda; // URL A LA QUE REDIRECCIONARÁ TERMINADO EL FLUJO
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// OBTENER DATOS DEL CATÁLOGO
		$data['ctgDatos'] = $this->entidad->getModelBase($this->ctgTiendaTabla,'id,usuario_creacion,usuario_modificacion,nombre,estatus,fecha_creacion,fecha_modificacion','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}	


	function ctgCategorias(){

		$data['ubicacion']      = array(base_url().DASHBOARD =>'Dashboard',base_url().'admin/catalogos-listado' =>'Catálogos','#'=>'Categorias Productos');
		$data['titulo']         ='Categorías de Productos';
		$data['contenido']      ="administrador/catalogos/generico_crud_catalogos.php";
		$data['tipoCatalogoBd'] = $this->ctgCategoriasProductosTabla; // NOMBRE DE LA TABLA 
		$data['urlRedireccion'] = $this->urlCategoriasProductosTabla; // URL A LA QUE REDIRECCIONARÁ TERMINADO EL FLUJO
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// OBTENER DATOS DEL CATÁLOGO
		$data['ctgDatos'] = $this->entidad->getModelBase($this->ctgCategoriasProductosTabla,'id,usuario_creacion,usuario_modificacion,nombre,estatus,fecha_creacion,fecha_modificacion','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}	


	function ctgMecanismos(){

		$data['ubicacion']      = array(base_url().DASHBOARD =>'Dashboard',base_url().'admin/catalogos-listado' =>'Catálogos','#'=>'Mecanismos Productos');
		$data['titulo']         ='Mecanismos de Productos';
		$data['contenido']      ="administrador/catalogos/generico_crud_catalogos.php";
		$data['tipoCatalogoBd'] = $this->ctgMecanismosProductosTabla; // NOMBRE DE LA TABLA 
		$data['urlRedireccion'] = $this->urlMecanismosProductosTabla; // URL A LA QUE REDIRECCIONARÁ TERMINADO EL FLUJO		
		
		//JS EXTERNO
		$data['js_externo'] ="administrador/catalogos/js/inicio.php";

		// OBTENER DATOS DEL CATÁLOGO
		$data['ctgDatos'] = $this->entidad->getModelBase($this->ctgMecanismosProductosTabla,'id,usuario_creacion,usuario_modificacion,nombre,estatus,fecha_creacion,fecha_modificacion','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}	

	/**
	*  Realiaza la operacion de guardado/update genérica, si ID es null crea, si no , actualiza
	*  @param $tipoCatalogoBd - nombre de la tabla en la base de datos
	*  @param $id          - campo llave de la bd
	*  @param $redireccion - ruta a donde va a rediccionar al terminar la operacion
	*/
	function saveCatalogo($tipoCatalogoBd = "",$id = 0,$redireccion = ""){

		$respuesta = -1;
		$mensaje   = "";
		$datos     = $this->input->post();

		if ($id > 0) {

			$datos['usuario_modificacion'] = $this->usuarioSesion;
			$datos['fecha_modificacion'] = HOY;
			$id = $datos['id'];

			// REMOVER ID DEL ARRAY PARA NO AFECTARLO EN EL UPDATE
			$keyRemove = array_search($id, $datos);
			unset($datos[$keyRemove]);

			$respuesta = $this->entidad->update($tipoCatalogoBd,"id",$id,$datos);
			if ($respuesta == 1) {
				$mensaje = "El registro fue actualizado con éxito.";
			}else{
				$mensaje = "El registro no pudo ser actualizado o la información no tenia modificaciones";
			}

		}else{

			$datos['fecha_creacion'] = HOY;
			$datos['estatus'] = 1;
			$datos['usuario_creacion'] = $this->usuarioSesion;
			$respuesta = $this->entidad->save($tipoCatalogoBd,$datos);
			if ($respuesta == 1) {
				$mensaje = "El registro se creo con éxito.";
			}else{
				$mensaje = "El registro no pudo ser creado";
			}

		}
		
		redirect($this->encrypt->decode($redireccion));
	}

	/**
	*  Realiaza la operacion de guardado genérica
	*  @param $tipoCatalogoBd - nombre de la tabla en la base de datos
	*  @param $id - id sobre el cual ejecutar la operacion
	*  @param $estatus - estatus a colocar en la tabla
	*  @param $redireccion - ruta a donde va a rediccionar al terminar la operacion
	*/
	function actualizaEstatusCatalogo($tipoCatalogoBd,$id,$estatus,$redireccion){

		$respuesta = $this->entidad->update($tipoCatalogoBd,"id",$id,array('estatus'=>$estatus,'usuario_modificacion'=>$this->usuarioSesion));
		$tipoFlashData = "";

		if ($respuesta == 1) {
			$mensaje = "El registro fue actualizado con éxito.";
			$tipoFlashData = "exitoso";
		}else{
			$mensaje = "El registro no puedo ser actualizado o la información no tenia modificaciones";
			$tipoFlashData = "error";
		}

		$this->session->set_flashdata($tipoFlashData,$mensaje);
		
		redirect($this->encrypt->decode($redireccion));
	}	


}