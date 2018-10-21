<?php
ini_set("display_errors", "0");
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Vendedor extends REST_Controller {

  private $usuarioVendedorDb  = "usuario_vendedor";
  private $usuarioAdminDb     = "usuario_admin";
  private $visitasMueble      = "visitas";

	 function __construct(){

        // Construct the parent class
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Vendedores_model','mVendedores');
        $this->load->model('Productos_model','mProducto');
        $this->load->model("Agentes_model","mAgente");
        $this->load->model("Mensajes_model","mMensajes");
    }

    /**
    * Obtener listado de vendedores por estatus
    * Get list all sellers
    */
    public function listadoVendedoresEstatus_get($estatus){

        $vendedores = $this->mVendedores->obtenerVendedoresPorTiendaPorEstatus(0,$estatus,"porEstatus");

        $this->response( $vendedores, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }


    /**
    * Valida las credenciales del vendedor
    * Validate seller credentials
    */
    function validarCredencialesVendedor_post(){
        $data = json_decode(file_get_contents("php://input"));
        $usuario = $data->username;
        $credencial = $data->password;
        $devicetoken = $data->devicetoken;
        
        $accesos =$this->mVendedores->validarCredencialesVendedor( strtolower(trim($usuario)) , trim($credencial) ) ;
          
        if( !empty($accesos) ){
            
            $wheredata =array( 'usuario' =>  $usuario);
            $updatedata =array( 'devicetoken' => $devicetoken );
            $this->mVendedores->updatelogindata( 'usuario_vendedor', $wheredata,   $updatedata ) ;
             
           $response = array("status" => "true", "message" => "Registration successfully completed, please login!", "data" => $accesos[0]);
        }else{
          $response = array("status" => "false", "message" => "Invalid emailid or password");
        }       
        $this->response($response, REST_Controller::HTTP_OK);
    }

    /**
    * Guarda todos las paginas visitadas durante la navegacion
    * en el sitio.
    * Save furniture visited
    */
    public function guardarVisitasVendedor_post(){
    
        //TODO: implement
    }


    /**
    * Alta de vendedor
    * create seller
    */
    public function guardaAltaVendedor_post(){

      $datos = json_decode(file_get_contents('php://input'),true);
      $bandera = true;
      $mensaje = "";

      // Buscar si correo ya existe
      $isValido = $this->mVendedores->validarVendedorValido($datos['correo'],$datos['celular']);

      if( $isValido == 0 ){

        $codigoActivacion = random_string('alnum', 12);
        

        $datos['codigo'] = $codigoActivacion;
        $datos['estatus'] = 1;
        $datos['fecha_creacion'] = HOY;
        $datos['usuario_creacion'] = 'system';

        $respuesta = $this->entidad->save($this->usuarioVendedorDb, $datos );

        if($respuesta > 0){

            $codigoActivacion.= $respuesta;

            $mensaje = "Su código es: ".$codigoActivacion." , favor de comunicarse al () para autorizar su registro.";
        }else{
          $mensaje = "Error, no pudo ser procesada su solicitud, favor de intentar mas tarde";
          $bandera = false;
        }

      }else{
        $mensaje = "El correo y/o celular ya se encuentran asociados a un usuario, favor de comunicarse a distinción para validar sus datos";
        $bandera = false;
      }

      $this->response([
          'status'  => $bandera,
          'message' => $mensaje
      ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

    }


    /**
    * Buscar vendedores por código postal
    * Search seller by postal code
    */
    public function buscarVendedorPorCodigo_post(){

      //$codigo = json_decode(file_get_contents('php://input'),true);
      $codigo = json_decode(file_get_contents('php://input'),true);

      //$vendedorPorCodigo = $this->entidad->getModelBase($this->usuarioVendedorDb,'id_vendedor,nombre,apellido_paterno,apellido_materno,codigo,fecha_creacion,celular,correo','id_vendedor','ASC',array('codigo'=>$codigo,'estatus'=>1));
      $listaVendedorPorCodigo = $this->entidad->getModelBase($this->usuarioVendedorDb,'id_vendedor,nombre,apellido_paterno,apellido_materno,codigo,fecha_creacion,celular,correo','id_vendedor','ASC',array('codigo'=>$codigo['codigo'],'estatus'=>1));

      //$this->response( $vendedorPorCodigo, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
      $this->response( $listaVendedorPorCodigo , REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    /**
    * Obtener mueble por tienda y categoria
    * Get furniture by store and category
    */
    public function obtenerMueblesPorTiendaYCategoria_get($tiendaId,$categoriaId){
        //echo "hello"; die;
			$tiendaId    = intval($tiendaId);
			$categoriaId = intval($categoriaId);
			$muebles = $this->mVendedores->obtenerMueblesPorTiendaCategoria($tiendaId,$categoriaId); 
		//	echo $this->db->last_query(); exit;
            if(!empty($muebles)) {
                foreach($muebles as $val) {
                    $val['path'] = $val['path'] != '' &&  file_exists( $_SERVER['DOCUMENT_ROOT'].'/img.muebles/'.$val['path'] ) ? base_url().'img.muebles/'.$val['path'] :  base_url().'img.muebles/no-image.png' ;
                    $arr[] = $val;
                }
                $response = array("status" => "true", "message" => "Found", "data" => $arr);
            } else {
                $response = array("status" => "false", "message" => "Not found");
            }
			$this->response($response, REST_Controller::HTTP_OK);
		}
		
		
    /**
    * Obtener mueble por tienda 
    * Get furniture by store 
    */
    public function obtenerMueblesPorTienda_get($tiendaId){
			$tiendaId    = intval($tiendaId);
			$muebles = $this->mVendedores->obtenerMueblesPorTiendaCategoria($tiendaId);

			$this->response($muebles, REST_Controller::HTTP_OK);
		}		
		
    /**
    * Obtener detalle mueble por Id
    * Get furniture detail and pictures by Id
    */
    public function obtenerProductoPorId_get($productoId){
			$productoId= intval($productoId);
			$mueble = $this->mProducto->obtenerProductos($productoId);
			$fotos  = $this->entidad->getModelBase("producto_fotos",'id_foto,path,orden,producto_id','orden','ASC',array('producto_id'=>$productoId));
            $videos  = $this->entidad->getModelBase("producto_videos",'id_video,path,nombre','id_video','ASC',array('producto_id'=>$productoId));
                  
            $arr = array();
			if(!empty($fotos)) {
			    foreach($fotos as $val) {
			        $val['path'] = $val['path'] != '' &&  file_exists( $_SERVER['DOCUMENT_ROOT'].'/img.muebles/'.$val['path'] ) ? base_url().'img.muebles/'.$val['path'] :  base_url().'img.muebles/no-image.png' ;
			        $arr[] = $val;
			    }
			}
            $mueble['fotos'] = $arr;
            $mueble['videos'] = $videos;
			
			if(!empty($mueble)){
			     $response = array("status" => "true", "message" => "data found", "data" => $mueble);
			}else{
			    $response = array("status" => "false", "message" => "data not found");
			}

			$this->response($response, REST_Controller::HTTP_OK);
	}	
	
	
    /**
    * Registrar visitas de productos
    * Post save furniture visited products $usuarioId=userId, $muebleId=furnitureId, $fechaVisita=dateVisitedFurniture, $tipoVisita= typeVisit
    */
    public function guardarVisita_post(){
			$data = json_decode(file_get_contents("php://input"));
			
			$usuarioId = $data->user_id;
			$muebleId = $data->furniture_id;
            $fechaVisita = date("Y-m-d");
            $tipoVisita = $data->type_visit;
			
			$resp  = $this->entidad->save($this->visitasMueble,array('usuario'=>$usuarioId,'mueble'=>$muebleId,'fecha_visita'=>$fechaVisita,'tipo_visita'=>$tipoVisita));
			
			if($resp > 0){
			    $response = array("status" => "true", "message" => "Visted user added");
			}else{
			    $response = array("status" => "false", "message" => "Some error occurred!");
			} 
        
         $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
			
	}	

    /**
    * Guardar vendedor
    * save seller
    * @params $codigo-code write by user
    * @params $correo- email write by user
    * @params $celular- cellphone write by user
    * @params $nombre- name
    * @params $paterno- last name
    * @params $materno- last name
    * @params $sucursal- branch office
    * @params $usuario- user to access app
    * @params $password- password to access app
    */
    public function guardarVendedor_post(){
        
        /*$codigo ="QOH9SREFP1UB";
		$correo="vljc2007@gmail.com";
		$celular="8114186913";
		$nombre="julio3";
		$paterno="paterno3";
		$materno="materno3";
		$sucursal="10";
		$usuario="julio3";
		$password="12346";*/
		$data = json_decode(file_get_contents("php://input"));
		$codigo = $data->code;
		$correo = $data->email;
		$celular = $data->cellphone;
		$nombre = $data->first_name;
		$paterno = $data->father_name;
		$materno = $data->mother_name;
		$sucursal = $data->branch_office;
		$usuario = $data->username;
		$password = $data->password; 
		$devicetoken = $data->devicetoken; 
		
		if(!empty($codigo) && !empty($celular) && !empty($correo) && !empty($password) && !empty($usuario)) {
		   $mensaje = null;        
          // SEARCH IF CODE IS TRUE
          $codeResp = $this->mVendedores->validarCodigoValido($codigo);
          
        //  print_r($codeResp); exit; 
    
          if( $codeResp === null){
              $response = array("status" => "false", "message" => "Code does not exit.");
          }else if( $codeResp['diferencia'] > 45 ){
              $response = array("status" => "false", "message" => "Code expired more than 45 minutes passed.");
              
          } else {
    
              // VALID EMAIL AND CELLPHONE
              $isValido = $this->mVendedores->validarVendedorValido($correo,$celular);
        
              if( $isValido > 0 ){
                  $response = array("status" => "false", "message" => "The mail and / or cell phone are already registered.");
                  
              }else{
                  $estatus = 1;
        
                  $datos = array(
                                  'nombre'=>$nombre,
                                  'apellido_paterno'=>$paterno,
                                  'apellido_materno'=>$materno,
                                  'sucursal_id'=>$sucursal,
                                  'celular'=>$celular,
                                  'correo'=>$correo,
                                  'usuario' => $usuario,
                                  'password'=>$password,
                                  'devicetoken' => $devicetoken, 
                                  'fecha_codigo'=> date("Y-m-d H:i:s"),
                                  'estatus'=>2
                          );
        
                  $respuesta = $this->entidad->update($this->usuarioVendedorDb,'codigo',$codigo,$datos);
        
                  if( $respuesta > 0 ){
                      
                        $to = "$correo";
                        $subject = "Regsitration successfully completed!.";
                        $txt = "Hello User, Your registration on furniture app successfully completed, please login";
                        $headers = "From: distiction app <Vljc2004@gmail.com>" . "\r\n";
                        
                        $isSend = mail($to,$subject,$txt,$headers);
            
            
                    $msg = "Ready! Now you can enter from the application with the user and mail you entered";
                    $response = array("status" => "true", "message" => $msg);
                    //TODO ENVIAR EMAIL
                  }else{
                    $estatus = 0;
                    //$mensaje = "Lo sentimos, tu cuenta no pudo ser creada, por favor solicita un código nuevo";
                    $msg = "Sorry, your account could not be created, please request a new code";
                    $response = array("status" => "false", "message" => $msg);
                  }
              }	
          }
		} else {
		    $response = array("status" => "true", "message" => "Invalid request");
		}
      	$this->response($response, REST_Controller::HTTP_OK);
        
    }
    
    
        /**
    * Valida las credenciales del vendedor
    * Validate seller credentials
    */
    function forgetpassword_post(){
        $data = json_decode(file_get_contents("php://input"));
        $email =  strtolower(trim($data->email));
        $checkdata = array( 'correo' =>  $email);
        $isEmailIdExist = $this->mVendedores->checkemailidexist( 'usuario_vendedor',   $checkdata ) ;
        if( $isEmailIdExist ){
            $newpass = rand(100000000,9999999999);
            // $this->load->library('email');
    
            // $this->email->from('hemant.ypsilon@gmail.com', 'Hemant Rawat');
            // $this->email->to("$email");
            // $this->email->subject('Change Password.');
            // $this->email->message("Hello user, your new password is $newpass ");
            
            // $isSend =  $this->email->send();
            
            
            $to = "$email";
            $subject = "Cambio Password.";
            $txt = "Hola, tu nueva contraseña es $newpass ";
            $headers = "From: distiction app <Vljc2004@gmail.com>" . "\r\n";
            
            $isSend = mail($to,$subject,$txt,$headers);
            
           if($isSend){
             $wheredata =array( 'correo' =>  $email);
             $updatedata =array( 'password' => $newpass );
             $this->mVendedores->updatepassword( 'usuario_vendedor', $wheredata,   $updatedata ) ;
             $response = array("status" => "true", "message" => "Tu password fue enviado al correo registrado");
           }else{
               $response = array("status" => "false", "message" => "Correo no enviado!");
           }
               
        }else{
          $response = array("status" => "false", "message" => "Email no existe");
        }       
        $this->response($response, REST_Controller::HTTP_OK);
    }


  function getuserdetail_get($userId){
      if(isset($userId) && $userId != ''){
          $data = $this->mVendedores->getuserdetail('usuario_vendedor', $userId);
          if(!empty($data)){
             
                $tiendaId = intval($data[0]['tienda_id']);  
    			$sucursalId = intval($data[0]['sucursal_id']);
    			$surcusales= $this->mAgente->obtenerSucursalPorLocalidadTienda($tiendaId,$sucursalId);
            
                $response = array("status" => "true", "message" => "Data found", "data" => $data[0], "branch" => $surcusales[0]);
          }else{
               $response = array("status" => "false", "message" => "Data not found!");
          }
      }else{
           $response = array("status" => "false", "message" => "User id not found!");
      }
      $this->response($response, REST_Controller::HTTP_OK);
  }
  
  
  function userupdate_post(){
		$data = json_decode(file_get_contents("php://input"));
		$correo = $data->email;
		$nombre = $data->first_name;
		$userid = $data->userid;
        
        $updateData = array('correo' => $correo, 'nombre' => $nombre);
        $whereData = array('id_vendedor' => $userid);
        
        $isUpdate = $this->mVendedores->userupdatedata('usuario_vendedor', $whereData, $updateData);
        
        if($isUpdate){
            $getUserData = $this->mVendedores->getuserdetail('usuario_vendedor', $userid);
            $response = array("status" => "true", "message" => "User updated", "data" => $getUserData[0]);
        }else{
            $response = array("status" => "false", "message" => "User not updated");
        }
      $this->response($response, REST_Controller::HTTP_OK);
    }
    
    
  function getproductrelatedinfo_get(){
      
       $whereData = array('estatus' => 1);
      
       $product = $this->mVendedores->getresult('productos');
       $tienda = $this->mVendedores->getresult('producto_tienda');
       $images = $this->mVendedores->getresult('producto_fotos');
        
        if($product){
            $response = array("status" => "true", "message" => "data found", "product" => $product, "tienda" => $tienda, "images" => $images);
        }else{
            $response = array("status" => "false", "message" => "data not found");
        }
      $this->response($response, REST_Controller::HTTP_OK);
  }
  
  
    function detailproduct_get(){
      
       $whereData = array('estatus' => 1);
      
       $masaje = $this->mVendedores->getresult('ctg_masaje');
       $categorias = $this->mVendedores->getresult('ctg_categorias');
        
        if($masaje || $categorias){
            $response = array("status" => "true", "message" => "data found", "masaje" => $masaje, "categorias" => $categorias);
        }else{
            $response = array("status" => "false", "message" => "data not found");
        }
      $this->response($response, REST_Controller::HTTP_OK);
  }
  
    function filter_get($type,$storeId,$data1,$data2){
      
        /**		$type="profundo";
		$data1="99";
		$data2="107";
		$storeId="11";*/
		
        switch ($type) {
            case "color":
                $where = "  pro.color_id = ".$data1;
                break;
            case "tapiz":
                $where = " pro.tapiz_id = ".$data1;
                break;
            case "mecanismo":
                $where = " pro.mecanismo_id = ".$data1;
                break;
            case "masaje":
                $where = " pro.masaje_id = ".$data1;
                break;
            case "categoria":
                $where = " pro.categoria_id = ".$data1;
                break;
            case "ancho":
                $where = " pro.ancho >= ".$data1." and pro.ancho <= ".$data2;
                break; 
            case "alto":
                $where = " pro.alto >= ".$data1." and pro.alto <= ".$data2;
                break;
            case "profundo":
                $where = " pro.profundo >= ".$data1." and pro.profundo <= ".$data2;
            break;    
        }
        
        
        $data  = $this->mProducto->filterProductos($where." and ptienda.tienda_id=".$storeId." order by pro.nombre asc");
        
        $response = array("status" => "true", "message" => "data found", "filter" => $data);
        
        $this->response($response, REST_Controller::HTTP_OK);
      
    }
    
    
    function getMessagesByStore($storeId){
        
        $response = array("status" => "true", "message" => "data found", "data" => $this->mMensajes->obtenerMensajes("tienda",$storeId,20));
        
        $this->response($response, REST_Controller::HTTP_OK);
    }
    
    
    function getMessagesByUser($sellerId){
        
        $response = array("status" => "true", "message" => "data found", "data" => $this->mMensajes->obtenerMensajes("vendedor",$sellerId,20));
        
        $this->response($response, REST_Controller::HTTP_OK);
    }    


}
