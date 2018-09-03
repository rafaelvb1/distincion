<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductosCtrl extends CI_Controller {


	private $productosTabla           = "productos";
	private $productoFotosTabla       = "producto_fotos";
	private $productoVideosTabla      = "producto_videos";
	private $productoVideosMecanismoTabla= "producto_video_mecanismo";
	private $productoVideosMasajeTabla= "producto_video_masaje";
    //private $videosTabla       = "videos";
	private $productosTienda          = "producto_tienda";
	private $productosPedidosEspeciales          = "producto_producto_especial";
	private $urlRedireccionProductos  = "admin/listado-productos";
	private $urlRedirDetalleProductos = "admin/detalle-producto";
	private $usuarioSesion;


	function ProductosCtrl()
	{
		parent::__construct();
		// VALIDACION DE SESION
		$this->usuarioSesion = $this->session->userdata('usuario');
		$this->load->model('Productos_model','mProductos');

		if(!validar_sesion()){
			redirect(base_url().LOGIN);
		}		

	}


	function index(){
		$this->dashboardCatalogos();
	}

	function dashboardProductos(){

		$data['ubicacion']  = array(base_url().DASHBOARD =>'Dashboard','#'=>'Productos');
		$data['titulo']     ='Listado de Productos';
		$data['contenido']  ="administrador/productos/listado_productos.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/productos/js/inicio.php";

		// LISTADO DE PRODUCTOS 
		$data['listadoProductos'] = $this->mProductos->obtenerProductos('','todos');

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}


	function verProducto($productoId = 0){

	$data['ubicacion']  = array(base_url().DASHBOARD =>'Dashboard',base_url().$this->urlRedireccionProductos =>'Productos','#'=>'Crear Producto');
		$data['titulo']     ='Crear Producto';
		$data['contenido']  ="administrador/productos/detalle_producto.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/productos/js/inicio.php";


		$data['detalleProducto'] = $this->mProductos->obtenerProductos($productoId,"id");
		

		$data['listadoProductos'] = $this->mProductos->obtenerProductosEspecial($productoId,"id");
		$data['productoId']      = $productoId;
		$data['tiendasProducto'] = $this->mProductos->obtenerTiendasPorProducto($productoId);
		$data['fotosProducto']   = $this->entidad->getModelBase("producto_fotos",'id_foto,path,orden,producto_id','orden','ASC',array('producto_id'=>$productoId));
		$data['videosProducto']  = $this->entidad->getModelBase("producto_videos",'id_video,path,producto_id,nombre','id_video','ASC',array('producto_id'=>$productoId));
		$data['videosProductoMecanismo']  = $this->entidad->getModelBase("producto_video_mecanismo",'id_video_mecanismo,path,producto_id,nombre','id_video_mecanismo','ASC',array('producto_id'=>$productoId));
		$data['videosProductoMasaje']  = $this->entidad->getModelBase("producto_video_masaje",'id_video_masaje,path,producto_id,nombre','id_video_masaje','ASC',array('producto_id'=>$productoId));
		// CATALOGOS
		$data['listadoColores']    = $this->entidad->getModelBase("ctg_colores",'id,nombre','nombre','ASC',null);
		$data['listadoTapiz']      = $this->entidad->getModelBase("ctg_tapiz",'id,nombre','nombre','ASC',null);
		$data['listadoMecanismo']  = $this->entidad->getModelBase("ctg_mecanismos",'id,nombre','nombre','ASC',null);
		$data['listadoTiendas']    = $this->entidad->getModelBase("ctg_tienda",'id,nombre','nombre','ASC',null);
		$data['listadoCategorias'] = $this->entidad->getModelBase("ctg_categorias",'id,nombre','nombre','ASC',null);
		$data['listadoMasaje']     = $this->entidad->getModelBase("ctg_masaje",'id,nombre','nombre','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}	

	function verProductoEspecial($productoId = 0){

		$data['ubicacion']  = array(base_url().DASHBOARD =>'Dashboard',base_url().$this->urlRedireccionProductos =>'Productos','#'=>'Pedido Especial Producto');
			$data['titulo']     ='Pedido Especial Producto';
			$data['contenido']  ="administrador/productos/pedido_especial_producto.php";
			//JS EXTERNO
			$data['js_externo'] ="administrador/productos/js/inicio.php";
	
			$data['productoEspecialId']= $productoId;
			$productoId=0;
			$data['detalleProducto'] = $this->mProductos->obtenerProductos($productoId,"id");
			$data['productoId']      = 0;
			
			$data['tiendasProducto'] = $this->mProductos->obtenerTiendasPorProducto($productoId);
			$data['fotosProducto']   = $this->entidad->getModelBase("producto_fotos",'id_foto,path,orden,producto_id','orden','ASC',array('producto_id'=>$productoId));
			$data['videosProducto']  = $this->entidad->getModelBase("producto_videos",'id_video,path,producto_id,nombre','id_video','ASC',array('producto_id'=>$productoId));
	
			// CATALOGOS
			$data['listadoColores']    = $this->entidad->getModelBase("ctg_colores",'id,nombre','nombre','ASC',null);
			$data['listadoTapiz']      = $this->entidad->getModelBase("ctg_tapiz",'id,nombre','nombre','ASC',null);
			$data['listadoMecanismo']  = $this->entidad->getModelBase("ctg_mecanismos",'id,nombre','nombre','ASC',null);
			$data['listadoTiendas']    = $this->entidad->getModelBase("ctg_tienda",'id,nombre','nombre','ASC',null);
			$data['listadoCategorias'] = $this->entidad->getModelBase("ctg_categorias",'id,nombre','nombre','ASC',null);
			$data['listadoMasaje']     = $this->entidad->getModelBase("ctg_masaje",'id,nombre','nombre','ASC',null);
	
			// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
			$this->load->vars($data);
			// CARGA TEMPLATE DEFAULT
			$this->load->view('template');
	
		}	


	function salvarProducto(){

		$datos = $this->input->post();

		$idProducto = $datos['id_producto'];
		$tiendasProductos = $datos['tiendas'];

		unset($datos["id_producto"]);
		if( !empty($tiendasProductos) ){ unset($datos["tiendas"]); } 
		unset($datos["accion"]);


		if ($idProducto == 0) {
			// # CREAR

			$datos['usuario_creacion'] = $this->usuarioSesion;
			$datos['fecha_creacion']   = HOY;		

			$respuesta  = $this->entidad->save($this->productosTabla,$datos);	
			$idProducto = $respuesta;


		}else{
			// # MODIFICAR

			$datos['usuario_modificacion'] = $this->usuarioSesion;
			$datos['fecha_modificacion']   = HOY;

			$respuesta = $this->entidad->update($this->productosTabla,"id_producto",$idProducto,$datos);
		}

		if ($respuesta > 0) {
			$mensaje = "El sillón fue creado/actualizado con éxito.";
			$tipoFlashData = "exitoso";
		}else{
			$mensaje = "El sillón no puedo ser creado/actualizado";
			$tipoFlashData = "error";
		}

		// ASOCIAR TIENDAS
		$this->asociarTiendas($idProducto,$tiendasProductos);

		$this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedireccionProductos);
	}

	function salvarProductoEspecial(){

		$datos = $this->input->post();

		$idProducto = $datos['id_producto'];
		$idProductoEspecial = $datos['id_producto_especial'];
		$tiendasProductos = $datos['tiendas'];
		$datos['pedido_especial']   = true;	

		unset($datos["id_producto"]);
		if( !empty($tiendasProductos) ){ unset($datos["tiendas"]); } 
		unset($datos["accion"]);


		if ($idProducto == 0) {
			// # CREAR

			$datos['usuario_creacion'] = $this->usuarioSesion;
			$datos['fecha_creacion']   = HOY;	
				
			
			$respuesta  = $this->entidad->save($this->productosTabla,$datos);	
			$idProducto = $respuesta;


		}else{
			// # MODIFICAR

			$datos['usuario_modificacion'] = $this->usuarioSesion;
			$datos['fecha_modificacion']   = HOY;

			$respuesta = $this->entidad->update($this->productosTabla,"id_producto",$idProducto,$datos);
		}

		if ($respuesta > 0) {
			$mensaje = "El sillón fue creado/actualizado con éxito.";
			$tipoFlashData = "exitoso";
		}else{
			$mensaje = "El sillón no puedo ser creado/actualizado";
			$tipoFlashData = "error";
		}

		// ASOCIAR TIENDAS
		$this->asociarTiendas($idProducto,$tiendasProductos);

		//$this->asociarProductoEspecial($idProductoEspecial,$idProducto);

		$this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedireccionProductos);
	}

	private function asociarProductoEspecial($productoId,$productoIdEspecial){

			//$this->entidad->delete($this->productosPedidosEspeciales,"id_producto_especial",$productoId);

			//foreach ($tiendas as $valTiendas) {
				$this->entidad->save($this->productosPedidosEspeciales,array('id_producto'=>$productoId,'id_producto_especial'=>$productoIdEspecial));	
			//}
		
		
	}

	private function asociarTiendas($productoId,$tiendas){

		if ( !empty($tiendas)) {

			$this->entidad->delete($this->productosTienda,"producto_id",$productoId);

			foreach ($tiendas as $valTiendas) {
				$this->entidad->save($this->productosTienda,array('producto_id'=>$productoId,'tienda_id'=>$valTiendas));	
			}
		}
		
	}


	function marcarFotoPrincipal($productoId,$fotoId){

		// OBTIENE LAS FOTOS DEL PRODUCTO ORDENAMAS DE MENOR A MAYOR
		$fotos['fotosProducto']   = $this->entidad->getModelBase("producto_fotos",'id_foto,path,orden','orden','ASC',array('producto_id'=>$productoId));

		$pos = 2;
		foreach ($fotos['fotosProducto'] as $key => $valFotos) {
			if( $valFotos['id_foto'] != $fotoId ){
				$this->entidad->update($this->productoFotosTabla,"id_foto",$valFotos['id_foto'],array('orden'=> $pos ));	
				$pos++;
			}

		}

		// ACTUALIZA ORDEN A 1 PARA SER LA PRINCIPAL
		$this->entidad->update($this->productoFotosTabla,"id_foto",$fotoId,array('orden'=>1));

		$this->session->set_flashdata("exitoso","Foto Actualizada");

	}



	function eliminarFoto($fotoId){

		$this->entidad->delete($this->productoFotosTabla,"id_foto",$fotoId);

		$this->session->set_flashdata("exitoso","Foto Actualizada");

	}

	function subirFoto(){

		$data = $this->input->post();

    	$config['upload_path']          = URL_IMG_PRODUCTO;
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 2000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());

                        print_r($error);

            $mensaje = "No se pudo subir la foto, valide que el tamaño del archivo no sea mayor a 2 mb y sea del tipo: jpg o png ".$this->upload->display_errors();
			$tipoFlashData = "error";

        }else{
            $dataFotos = array('upload_data' => $this->upload->data());

            $principal = ( isset($data['principal']) ? '1':'2' );

            $this->entidad->save($this->productoFotosTabla,array('producto_id'=>$data['id_producto'],'path'=>$dataFotos['upload_data']['file_name'],'orden'=>$principal ));	

            $mensaje = "La foto se agrego con éxito.";
			$tipoFlashData = "exitoso";

        }		

        $this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedirDetalleProductos."/".$data['id_producto']);

	}
    function addVideo(){

		$dataVideos = $this->input->post();

            $this->entidad->save($this->productoVideosTabla,array('producto_id'=>$dataVideos['id_producto'],'path'=>$dataVideos['ligaVideo'],'nombre'=>$dataVideos['file_name']));	

            $mensaje = "La liga se agrego con éxito.";
			$tipoFlashData = "exitoso";

    
        $this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedirDetalleProductos."/".$dataVideos['id_producto']);

	}
	function eliminarVideo($videoId){

		$this->entidad->delete($this->productoVideosTabla,"id_video",$videoId);

		$this->session->set_flashdata("exitoso","video Actualizada");

	}
	function eliminarVideoMecanismo($videoId){

		$this->entidad->delete($this->productoVideosMecanismoTabla,"id_video_mecanismo",$videoId);

		$this->session->set_flashdata("exitoso","video Actualizada");

	}
	function eliminarVideoMasaje($videoId){

		$this->entidad->delete($this->productoVideosMasajeTabla,"id_video_masaje",$videoId);

		$this->session->set_flashdata("exitoso","video Actualizada");

	}
	function addVideoMecanismo(){

		$dataVideosMecanismo = $this->input->post();

            $this->entidad->save($this->productoVideosMecanismoTabla,array('producto_id'=>$dataVideosMecanismo['id_producto'],'path'=>$dataVideosMecanismo['ligaVideoMecanismo'],'nombre'=>$dataVideosMecanismo['file_name']));	

            $mensaje = "La liga se agrego con éxito.";
			$tipoFlashData = "exitoso";

    
        $this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedirDetalleProductos."/".$dataVideosMecanismo['id_producto']);

	}
	function addVideoMasaje(){

		$dataVideosMasaje = $this->input->post();

            $this->entidad->save($this->productoVideosMasajeTabla,array('producto_id'=>$dataVideosMasaje['id_producto'],'path'=>$dataVideosMasaje['ligaVideoMasaje'],'nombre'=>$dataVideosMasaje['file_name']));	

            $mensaje = "La liga se agrego con éxito.";
			$tipoFlashData = "exitoso";

    
        $this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedirDetalleProductos."/".$dataVideosMasaje['id_producto']);

	}
	





}