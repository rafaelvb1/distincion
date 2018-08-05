<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TiendaCtrl extends CI_Controller {


	private $ctgTiendaTabla       = "ctg_tienda";
	private $sucursalDb           = "sucursal";
	private $urlRedireccionTienda = "admin/tiendas-listado";
	private $urlRedireccionTiendaDetalle = "admin/tienda-detalle";
	private $busquedaBySucursal ="sucursal";


	function TiendaCtrl()
	{
		parent::__construct();
		// VALIDACION DE SESION
		$this->usuarioSesion = $this->session->userdata('usuario');
		$this->load->model("sucursal_model","mSucursal");
		if(!validar_sesion()){
			redirect(base_url().LOGIN);
		}		

	}


	function index(){
		$this->dashboardTienda();
	}

	function dashboardTienda(){

		$data['ubicacion']  = array(base_url().DASHBOARD =>'Dashboard','#'=>'Tiendas');
		$data['titulo']     ='Tiendas';
		$data['contenido']  ="administrador/tiendas/listado_tiendas.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/tiendas/js/inicio.php";

		// OBTENER LISTADO DE TIENDAS
		$data['listadoTiendas'] = $this->entidad->getModelBase($this->ctgTiendaTabla,'id,nombre,estatus','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}


	function detalleTienda($tiendaId=""){

		if ( $tiendaId == "") {
			redirect($this->$urlRedireccionTienda);
		}else{

			$data['ubicacion']  = array(base_url().DASHBOARD=>'Dashboard','#'=>'Tienda Sucursales');
			$data['titulo']     ='Tienda Sucursales';
			$data['contenido']  ="administrador/tiendas/tiendas_detalle.php";
			//JS EXTERNO
			$data['js_externo'] ="administrador/tiendas/js/inicio.php";
			$data['tiendaId']   = $tiendaId;

			// NOMBRE TIENDA
			$data['datosTienda'] = $this->entidad->getModelBase($this->ctgTiendaTabla,'id,nombre,estatus','nombre','ASC',array('id' => $this->encrypt->decode($tiendaId) ));
			// OBTENER LISTADO DE SUCURSALES
			$data['listadoSucursales'] = $this->mSucursal->obtenerDetalleSucursal( $this->encrypt->decode($tiendaId) );

			// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
			$this->load->vars($data);
			// CARGA TEMPLATE DEFAULT
			$this->load->view('template');

		}

	}


	function mostrarSucursalCrear($nombreTienda="",$tiendaId, $idSucursal = 0){

		$data['ubicacion']  = array(base_url().DASHBOARD=>'Dashboard',base_url().'admin/tienda-detalle/'.$this->encrypt->encode($tiendaId)=>'Tienda Sucursales','#'=>'Crear Sucursal');
		$data['titulo']     ='Crear Sucursal: <b>'. $this->encrypt->decode($nombreTienda)."</b>";
		$data['contenido']  ="administrador/tiendas/crear_sucursal.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/tiendas/js/inicio.php";
		$data['tiendaId']   = $tiendaId;
		$data['idSucursal'] = $idSucursal;

		// CTG CIUDADADES
		$data['ctgCiudades'] = $this->entidad->getModelBase("estados",'id,nombre,abrev','nombre','ASC',null);
		// CTG LOCALIDADES
		$data['localidades'] = null;

		// DATOS DE LA SUCURSAL
		$data['detalleSucursal'] = $this->mSucursal->obtenerDetalleSucursal($idSucursal,$this->busquedaBySucursal);

		if (isset($data['detalleSucursal'][0]['estado_id'])) {
			$data['localidades'] = $this->entidad->getModelBase("municipios",'id,nombre','nombre','ASC',array('estado_id'=>$data['detalleSucursal'][0]['estado_id']));
		}

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');		


	}

	function saveSucursal(){

		$datos = $this->input->post();

		$idSucursal = $datos['id_sucursal'];

		// REMOVER DATOS QUE NO VAN EN EL INSERT
		unset($datos["id_sucursal"]);
		unset($datos["municipio_id"]);		


		if ($idSucursal > 0 ) {
			// # UPDATE
			$datos['fecha_modificacion']   = HOY;
			$datos['usuario_modificacion'] = $this->usuarioSesion;

			$respuesta = $this->entidad->update($this->sucursalDb,"id_sucursal",$idSucursal,$datos);

		}else{
			// # INSERT
			$datos['fecha_creacion']   = HOY;
			$datos['usuario_creacion'] = $this->usuarioSesion;

			$respuesta = $this->entidad->save($this->sucursalDb,$datos);

		}

		if ($respuesta > 0) {
			$mensaje = "El registro fue creado/actualizado con éxito.";
			$tipoFlashData = "exitoso";
		}else{
			$mensaje = "El registro no puedo ser creado/actualizado";
			$tipoFlashData = "error";
		}

		$this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedireccionTiendaDetalle."/".$this->encrypt->encode($datos['tienda_id']));

	}



	function actualizaEstatusTienda($sucursalId,$estatus,$tiendaId){

		$respuesta = $this->entidad->update($this->sucursalDb,"id_sucursal",$sucursalId,array('estatus'=>$estatus,'fecha_modificacion' => HOY,'usuario_modificacion'=>$this->usuarioSesion));
		$tipoFlashData = "";

		if ($respuesta == 1) {
			$mensaje = "El registro fue actualizado con éxito.";
			$tipoFlashData = "exitoso";
		}else{
			$mensaje = "El registro no puedo ser actualizado o la información no tenia modificaciones";
			$tipoFlashData = "error";
		}

		$this->session->set_flashdata($tipoFlashData,$mensaje);
		
		redirect($this->urlRedireccionTiendaDetalle."/".$this->encrypt->encode($tiendaId));
	}	


	function subirTiendaFoto(){

	$data = $this->input->post();
	$tiendaId = $data['tienda_id'];

    	$config['upload_path']          = URL_IMG_TIENDA;
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 2000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());


            $mensaje = "No se pudo subir la foto, valide que el tamaño del archivo no sea mayor a 2 mb y sea del tipo: jpg o png";
			$tipoFlashData = "error";

        }else{
            $dataFotos = array('upload_data' => $this->upload->data());

            $principal = ( isset($data['principal']) ? '1':'2' );

            $this->entidad->update($this->ctgTiendaTabla,"id",$this->encrypt->decode($tiendaId),array('path_foto'=> base_url()."/assets/img_tiendas/".$dataFotos['upload_data']['file_name']) );	

            $mensaje = "La foto se agrego con éxito.";
			$tipoFlashData = "exitoso";

        }		

        $this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedireccionTiendaDetalle."/".$tiendaId);		
	}


	function obtenerLocalidades( $estadoId = 0 ){
		$data['localidades'] = $this->entidad->getModelBase("municipios",'id,nombre','nombre','ASC',array('estado_id'=>$estadoId));
		header('Content-Type: application/json');
    	echo json_encode( $data['localidades'] );
	}

	function verDetalleContacto( $sucursalId = 0 ){
		$data['localidades'] = $this->entidad->getModelBase($this->sucursalDb,'nombre_completo_contacto,telefono_contacto,correo_contacto,comentarios_contacto','nombre_completo_contacto','ASC',array('id_sucursal'=>$sucursalId));
		header('Content-Type: application/json');
    	echo json_encode( $data['localidades'] );
	}	


	function tiendasPorLocalidad($tienda = 0,$municipio = 0){
		$data['sucursales'] = $this->entidad->getModelBase($this->sucursalDb,'id_sucursal,nombre_sucursal','nombre_sucursal','ASC',array('tienda_id'=>$tienda,'municipio'=>$municipio));
		header('Content-Type: application/json');
    	echo json_encode( $data['sucursales'] );
	}


}