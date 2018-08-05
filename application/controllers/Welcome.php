<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function Welcome()
	{
		parent::__construct();
		// VALIDACION DE SESION
		$this->load->library('form_validation');
	}

	/**
	* Este controlador sera usado para el login de administrador y aspirante
	*/
	public function loginAdministrador()
	{
		$this->load->view('login_administrador');
	}

	public function cerrarSession(){
		
		if ($this->session->userdata('id_usuario')) {
			$this->session->sess_destroy();
			redirect('admin/inicio');
		}
	}

	public function validarLoginAdministrador(){
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div></br>');

		$this->form_validation->set_rules('usuario', ' Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', ' Contraseña ', 'trim|max_length[15]|xss_clean');


		if ($this->form_validation->run() == FALSE){
        	$this->loginAdministrador();
        }else{

        	// VALIDA LOS ACCESOS DEL USUARIO , SOLO SE PERMITE SU INGRESO SI TIENE UN PROCESO PENDIENTE
        	$accesos = $this->entidad->getModelBase('usuario_admin','usuario,id_usuario,nombre,apellido_paterno,tipo,email,estatus,tipo,password','id_usuario','ASC',array('usuario'=>strtolower($this->input->post('usuario')),'password'=>$this->input->post('password'),'estatus'=> 1 )  );
        	
        	if (empty($accesos)) {
        		$this->session->set_flashdata('mensaje', '<div class="alert alert-info">Acceso no permitido.</div>');
        		$this->loginAdministrador();
        	}else{
        		$this->session->id_usuario       = $accesos[0]['id_usuario'];
        		$this->session->usuario          = $accesos[0]['usuario'];
				$this->session->nombre           = $accesos[0]['nombre'];
				$this->session->apellido_paterno = $accesos[0]['apellido_paterno'];
				$this->session->email            = $accesos[0]['email'];
				$this->session->estatus          = $accesos[0]['estatus'];
				$this->session->password          = $accesos[0]['password'];
				$this->session->isAdmin          = ($accesos[0]['tipo'] == 'admin' ? true:false );
				$this->session->logged_in        = true;

        		redirect('admin/inicio');
        	}

        }

	}
	
	
	public function misDatosPersonales(){
	     $data['ubicacion']  = array('Mis Perfil',);
		 $data['titulo']     ='Visualiza o actualiza tu información';
		 $data['contenido']  ="administrador/dashboard/mis_datos.php";

		 // OBTENER LISTADO DE TIENDAS
		 $data['datos'] =  $this->session->all_userdata();

		 // SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		 $this->load->vars($data);
		 // CARGA TEMPLATE DEFAULT
		 $this->load->view('template');
	}
	
	
	public function actualizarDatosPersonales(){
	    
		$this->form_validation->set_rules('password', ' Contraseña ', 'trim|min_length[6]|max_length[15]|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('error', 'Algo falló, los datos no pudieron ser actualizados, verificar que ingresaste los datos correctamente');
        }else{
            $nvoPassword = $this->input->post('password');
            if( $this->input->post('password') != $this->session->password ){
                $nvoPassword = $this->input->post('password');
            }else{
                $nvoPassword = $this->session->password;
            }
            
            $this->entidad->update(
                                    'usuario_admin',
                                    'id_usuario',
                                    $this->session->id_usuario,
                                    array(  'email'=>$this->input->post('email'),
                                            'apellido_paterno' => $this->input->post('apellido_paterno'),
                                            'nombre' => $this->input->post('nombre'),
                                            'tipo' => $this->input->post('tipo'),
                                            'estatus' => $this->input->post('estatus'),
                                            'password' => $nvoPassword,
                                            'fecha_modificacion' => HOY,
                                            'usuario_modificacion'=>$this->session->usuario
                                    )
            );
            
            $this->session->set_flashdata('exitoso', 'Los datos se actualizaron con éxito, para poder ver los datos actualizador favor de cerrar y volver a iniciar sesión en el sistema.');
        }
        
        
        $this->misDatosPersonales();
		
	}	
	

}
