<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//============================== # ADMINISTRADOR

// # LOGIN
$route['admin/distincion-login']         = 'Welcome/loginAdministrador';
$route['admin/distincion-login-validar'] = 'Welcome/validarLoginAdministrador';
$route['admin/cerrar-sesion']            = 'Welcome/cerrarSession';


// # INICIO
$route['admin/inicio'] = 'administrador/DashboardCtrl/dashboardAdministrador';


// # CATALOGOS
$route['admin/catalogos-listado']                         = 'administrador/CatalogoCtrl/dashboardCatalogos';
$route['admin/catalogos-nombre-tiendas']                  = 'administrador/CatalogoCtrl/ctgTiendas';
$route['admin/catalogos-categorias-productos']            = 'administrador/CatalogoCtrl/ctgCategorias';
$route['admin/catalogos-mecanismo-productos']             = 'administrador/CatalogoCtrl/ctgMecanismos';
$route['admin/catalogos-colores-productos']               = 'administrador/CatalogoCtrl/ctgColores';
$route['admin/catalogos-tapiz-productos']                 = 'administrador/CatalogoCtrl/ctgTapiz';
$route['admin/catalogos-masaje-productos']                = 'administrador/CatalogoCtrl/ctgMasaje';
$route['admin/catalogos-mail-categoria']                  = 'administrador/CatalogoCtrl/ctgMailCategoria';
$route['admin/catalogos-desactivar/(:any)/(:num)/(:num)/(:any)'] = 'administrador/CatalogoCtrl/actualizaEstatusCatalogo/$1/$2/$3/$4';
$route['admin/catalogos-crear/(:any)/(:num)/(:any)']      = 'administrador/CatalogoCtrl/saveCatalogo/$1/$2/$3';
$route['admin/localidades-json/(:num)']                   = 'administrador/TiendaCtrl/obtenerLocalidades/$1';


// # TIENDAS
$route['admin/tiendas-listado']                        = 'administrador/TiendaCtrl/dashboardTienda';
$route['admin/tienda-detalle/(:any)']                  = 'administrador/TiendaCtrl/detalleTienda/$1';
$route['admin/tiendas-crear-sucursal/(:any)/(:num)/(:num)'] = 'administrador/TiendaCtrl/mostrarSucursalCrear/$1/$2/$3';
$route['admin/tiendas-sucursal-save']                  = 'administrador/TiendaCtrl/saveSucursal';
$route['admin/tienda-detalle-contacto-json/(:num)']    = 'administrador/TiendaCtrl/verDetalleContacto/$1';
$route['admin/tienda-desactivar/(:num)/(:num)/(:num)'] = 'administrador/TiendaCtrl/actualizaEstatusTienda/$1/$2/$3';
$route['admin/sucursales-listado-localidad-json/(:num)/(:num)']  = 'administrador/TiendaCtrl/tiendasPorLocalidad/$1/$2';
$route['admin/sucursales-listado-tienda-json/(:num)']  = 'administrador/TiendaCtrl/sucursalesPorTienda/$1';
$route['admin/subir-foto-tienda-logo']                 = 'administrador/TiendaCtrl/subirTiendaFoto';


// # USUARIOS
$route['admin/usuarios-listado']                  = 'administrador/UsuarioCtrl/dashboardUsuario';
$route['admin/usuarios-crear/(:any)']             = 'administrador/UsuarioCtrl/saveUsuario/$1';
$route['admin/usuarios-reenviar-password/(:num)'] = 'administrador/UsuarioCtrl/reenviarPassword/$1';
$route['admin/usuarios-detalle-json/(:num)']      = 'administrador/UsuarioCtrl/verUsuarioDetalle/$1';
$route['admin/usuarios-genera-password-json']     = 'administrador/UsuarioCtrl/generaPassword';


// # VENDEDORES
$route['admin/listado_vendedores_por_aprobar']         = 'administrador/VendedorCtrl/obtenerVendedoresPorAprobar';
$route['admin/vendedor-detalle/(:num)/(:any)/(:any)']  = 'administrador/VendedorCtrl/verDatosPersonalesVendedor/$1/$2/$3';
$route['admin/aprobar-rechazar-vendedor']              = 'administrador/VendedorCtrl/aprobarRechazarVendedor';
$route['admin/vendedores-tienda-listado']              = 'administrador/VendedorCtrl/dashboardVendedor';
$route['admin/listado-vendedores-por-tienda/(:num)']   = 'administrador/VendedorCtrl/obtenerVendedoresPorTienda/$1';


// # PRODUCTOS
$route['admin/listado-productos']                    = 'administrador/ProductosCtrl/dashboardProductos';
$route['admin/detalle-producto/(:num)']              = 'administrador/ProductosCtrl/verProducto/$1';
$route['admin/subir-foto-producto']                  = 'administrador/ProductosCtrl/subirFoto';
$route['admin/salvar-producto']                      = 'administrador/ProductosCtrl/salvarProducto';
$route['admin/marcar-foto-principal/(:num)/(:num)']  = 'administrador/ProductosCtrl/marcarFotoPrincipal/$1/$2';
$route['admin/foto-eliminar/(:num)']                 = 'administrador/ProductosCtrl/eliminarFoto/$1';
$route['admin/video-eliminar/(:num)']                = 'administrador/ProductosCtrl/eliminarVideo/$1';
$route['admin/video-mecanismo-eliminar/(:num)']      = 'administrador/ProductosCtrl/eliminarVideoMecanismo/$1';
$route['admin/video-masaje-eliminar/(:num)']      = 'administrador/ProductosCtrl/eliminarVideoMasaje/$1';

/*$route['admin/vendedores-listado']                     = 'administrador/VendedorCtrl/dashboardVendedor';
$route['admin/listado_tiendas_vendedores_por_aprobar'] = 'administrador/VendedorCtrl/obtenerTiendasVendedoresPorAprobar';
$route['admin/listado_vendedores_por_aprobar/(:num)']  = 'administrador/VendedorCtrl/obtenerVendedoresPorAprobar/$1';
$route['admin/vendedor_detalle/(:num)/(:any)']         = 'administrador/VendedorCtrl/verDatosPersonalesVendedor/$1/$2';
$route['admin/aprobar_rechazar_vendedor']              = 'administrador/VendedorCtrl/aprobarRechazarVendedor';*/



/*
// # SOLICITUD VACANTE
$route['aplicar']        = 'Welcome/aplicarPuesto';
$route['aplicar-puesto'] = 'Welcome/guardarSolicitudPuesto';
$route['emailmarketing'] = 'Welcome/emailmarketing';


// # DASHBOARD
$route['admin/inicio'] = 'administrador/DashboardCtrl/dashboardAdministrador';

// #ASPIRANTES
$route['admin/aspirante/aspirante-alta']    = 'administrador/AspiranteCtrl/altaAspirante';
$route['admin/aspirante/aspirante-listado'] = 'administrador/AspiranteCtrl/listadoAspirante';
$route['admin/aspirante/aspirante-save']    = 'administrador/AspiranteCtrl/guardaAspirante';

// #VACANTES
$route['admin/vacante/vacante-alta']        = 'administrador/VacanteCtrl/altaVacante';
$route['admin/vacante/vacante-listado'] 	= 'administrador/VacanteCtrl/listaVacante';
$route['admin/vacante/vacante-save']    	= 'administrador/VacanteCtrl/guardaVacante';
$route['admin/vacante/vacante-lista-examen-puesto/(:num)'] = 'administrador/VacanteCtrl/obtenerExamenPuesto/$1';

// #PUESTO
$route['admin/puesto/puesto-alta']      = 'administrador/PuestoCtrl/altaPuesto';
$route['admin/puesto/puesto-listado']   = 'administrador/PuestoCtrl/listaPuesto';
$route['admin/puesto/puesto-save']      = 'administrador/PuestoCtrl/guardarPuesto';

// #EXAMEN
$route['admin/examen/examen-alta']      = 'administrador/ExamenCtrl/altaExamen';
$route['admin/examen/examen-listado']   = 'administrador/ExamenCtrl/listaExamen';
$route['admin/examen/examen-save']      = 'administrador/ExamenCtrl/guardarExamen';



//============================== # ASPIRANTE

//$route['login']                = 'aspirante/AspiranteCtrl';$route['examen-login']         = 'Welcome/loginAspirante';
$route['examen-valida']        = 'Welcome/valida';
$route['logout']               = 'aspirante/AspiranteCtrl/logout';
$route['verify-user']          = 'aspirante/AspiranteCtrl/login';
$route['mis-examenes']         = 'aspirante/AspiranteCtrl/dashboard';
$route['examen/(:num)/(:num)'] = 'aspirante/ExamenCtrl/index/$1/$2';
$route['examen/verPregunta/(:num)/(:num)/(:num)/(:num)'] = 'aspirante/ExamenCtrl/verPregunta/$1/$2/$3/$4';
$route['examen/verPregunta/(:num)/(:num)'] = 'aspirante/ExamenCtrl/verPregunta/$1/$2';

$route['examen/finalizar/(:num)/(:num)']     = 'aspirante/ExamenCtrl/finalizarExamen/$1/$2';*/