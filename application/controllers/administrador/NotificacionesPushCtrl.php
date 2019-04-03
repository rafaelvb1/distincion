<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NotificacionesPushCtrl extends CI_Controller {


	private $ctgTiendaTabla      = "ctg_tienda";
	private $usuariosVendedorDb  = "usuario_vendedor";
	private $sucursalDb           = "sucursal";

	private $urlRedirecccionNotificaciones   = "admin/notificaciones-push-enviar";


	function NotificacionesPushCtrl()
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

	function enviar(){

		$data['ubicacion']  = array('Dashboard','Enviar notificaciones');
		$data['titulo']     ='Enviar notificaciones';
		$data['contenido']  ="administrador/notificacionespush/notificacionesenviar.php";
		//JS EXTERNO
        $data['js_externo'] ="administrador/vendedores/js/inicio.php";
        

		// OBTENER LISTADO DE TIENDAS
        $data['listadoTiendas'] = $this->entidad->getModelBase($this->ctgTiendaTabla,'id,nombre,estatus','nombre','ASC',null);
            // OBTENER LISTADO DE SUCURSALES
        $data['listadoSucursales'] = null;    
           
           

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

    }
    function detalleTienda($tiendaId=""){

		if ( $tiendaId == "") {
			redirect($this->$urlRedireccionTienda);
		}else{

			
			$data['tiendaId']   = $tiendaId;

			
			// OBTENER LISTADO DE SUCURSALES
			$data['listadoSucursales'] = $this->mSucursal->obtenerDetalleSucursal( $this->encrypt->decode($tiendaId) );

			// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
			$this->load->vars($data);
			

		}

	}

	function enviarPush(){
		$datos = $this->input->post();
		$sucursalesPush = $datos['sucursales'];
		$mensajePush = $datos['mensaje'];
		$tiendaId=$datos['tiendanot'];
		$accion = $datos['accion'];
	
		$sucursalesBusqueda="";

		if($accion==="Enviar Todas Sucursales"){
			echo "entroe";
			$data['sucursales'] = $this->entidad->getModelBase($this->sucursalDb,'id_sucursal,nombre_sucursal','nombre_sucursal','ASC',array('tienda_id'=>$tiendaId));
			foreach ($data['sucursales']  as $sucursal) {
				echo $sucursal["id_sucursal"];
				$sucursalesBusqueda=$sucursalesBusqueda."'".$sucursal["id_sucursal"]."',";
			}

		}else{
			foreach ($sucursalesPush  as $sucursal) {
			
				$sucursalesBusqueda=$sucursalesBusqueda."'".$sucursal."',";
			}
		}

		
		$sucursalesBusqueda=substr($sucursalesBusqueda,0,-1);
	
		$vendedores = $this->mVendedores->obtenerVendedoresPorTiendaPorEstatusPorSucursal($tiendaId,$sucursalesBusqueda);
	
		if ( !empty($vendedores)) {

			
			foreach ($vendedores as $vendedor) {
			
				if(!empty($vendedor['devicetoken'])){
				
					$this->enviarNotificacion($vendedor['devicetoken'],$mensajePush);
					
				}
			}
		}
		
		$data['sucursalesAfter'] = $sucursalesPush;
		$data['mensajeAfter'] = $mensaje;

		if ($mensajePush ) {
			$mensaje = "La notificación fue enviada con éxito.";
			$tipoFlashData = "exitoso";
		}else{
			$mensaje = "La notificación no pudo ser enviada";
			$tipoFlashData = "error";
		}
		

			// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
			$this->load->vars($data);   
			$this->session->set_flashdata($tipoFlashData,$mensaje);
			redirect($this->urlRedirecccionNotificaciones);
			
			
	}
	
	function enviarNotificacion($token,$mensaje="prueba"){

		define('API_ACCESS_KEY','AAAAGFirWtg:APA91bEPvmNLRe4EX9wz2waIkna7obc24sHTspxLMu1oGmsDfgJwW7nmajVVk6n65D-ctxNZFxrA_we46x4i-8SyPm7Mnt1AQ9P-bce0IqHykrhvUdq1b2wlpY3yK8zU_wrEpdkKwLmy');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		//$token='cDVJZCvMOyA:APA91bH1ttuj908QmBi0Q8LmAzwtgmMCk4mr_QAM2KXbqaMucwJm_1QCUC7nqnSZBRjvXSPW_2sD87Cfk6v5UoEB6ZiNOFADs1XbWbHS9nDKTmwhye0_VYvprv0aCA1UswmGqktZtc05';
	   
			$notification = [
				   'title' =>'Notificacion',
				   'body' => $mensaje,
				   'icon' =>'myIcon', 
				   'sound' => 'mySound'
			   ];
			   $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
	   
			   $fcmNotification = [
				   //'registration_ids' => $tokenList, //multple token array
				   'to'        => $token, //single token
				   'notification' => $notification,
				   'data' => $extraNotificationData
			   ];
	   
			   $headers = [
				   'Authorization: key=' . API_ACCESS_KEY,
				   'Content-Type: application/json'
			   ];
	   
	   
			   $ch = curl_init();
			   curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			   curl_setopt($ch, CURLOPT_POST, true);
			   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
			   $result = curl_exec($ch);
			   curl_close($ch);
	   
	   
			  // echo $result;

	}
		
}