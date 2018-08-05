<?php isadministrador(); ?>
 <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title blue">
                                    <div class="caption font-dark">
                                        <i class="icon-basket font-dark"></i>
                                        <span class="caption-subject bold uppercase"> <?php echo  $datosTienda[0]['nombre'] ?></span>
                                    </div>
                                    <div class="actions">
                                        <a href="#subirFoto"  data-toggle="modal" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Agregar Foto </a>
                                        <a href="<?php echo base_url(); ?>admin/tiendas-crear-sucursal/<?php echo $this->encrypt->encode( $datosTienda[0]['nombre'] ); ?>/<?php echo $datosTienda[0]['id'] ?>/0" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Agregar Sucursal </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <?php if (!empty($listadoSucursales)) { ?>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> Código </th>
                                                <th> Sucursal </th>
                                                <th> Estado </th>
                                                <th> Ciudad </th>
                                                <th> Estatus </th>
                                                <th> Creada Por </th>
                                                <th> &nbsp; </th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                <?php  foreach ($listadoSucursales as $key => $valSucursales) { ?>
                                       
                                            <tr class="odd gradeX">
                                                <td> <?php echo $valSucursales['codigo_sucursal'] ?> </td>
                                                <td> <?php echo $valSucursales['nombre_sucursal'] ?> </td>
                                                <td> <?php echo $valSucursales['estado_nombre'] ?> </td>
                                                <td> <?php echo $valSucursales['municipio_nombre'] ?> </td>
                                                <td> <?php echo ($valSucursales['estatus_sucursal'] == 1 ? "Activo":"Desactivo" )?> </td>
                                                <td> <?php echo $valSucursales['creada_por'] ?> </td>
                                                <td> 
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs normal dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actiones
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="<?php echo base_url(); ?>admin/tiendas-crear-sucursal/<?php echo $this->encrypt->encode( $datosTienda[0]['nombre'] ); ?>/<?php echo $datosTienda[0]['id'] ?>/<?php echo $valSucursales['id_sucursal']; ?>" title="Actualizar Datos" >
                                                                    <i class="fa fa-edit"></i>Editar</a>
                                                            </li>
                                                            <li>
                                                                <a href="#verDetalleContacto" onClick="verDetalleContacto(<?php echo $valSucursales['id_sucursal'] ?>)" data-toggle="modal" title="Ver Contacto" >
                                                                    <i class="fa fa-edit"></i>Contacto</a>
                                                            </li>
                                                            <li>
                                                                <?php if ( $valSucursales['estatus_sucursal'] == 1 ){ ?>
                                                                    <a href="<?php echo base_url(); ?>admin/tienda-desactivar/<?php echo $valSucursales['id_sucursal'] ?>/0/<?php echo $valSucursales['id_tienda'] ?>" > <i class="fa fa-edit"></i>Desactivar</a>
                                                                <?php }else{ ?>
                                                                    <a href="<?php echo base_url(); ?>admin/tienda-desactivar/<?php echo $valSucursales['id_sucursal'] ?>/1/<?php echo $valSucursales['id_tienda'] ?>" > <i class="fa fa-edit"></i>Activar</a>
                                                                <?php } ?> 
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        
                            <?php } echo "</tbody></table>"; } ?>                                        
                        <!-- END EXAMPLE TABLE PORTLET-->
</div>



                        <div class="modal fade" id="verDetalleContacto" tabindex="-1" role="verDetalleContacto" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Datos de Contacto</span>
                                            </div>
                                        </div>

                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->                                   
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <div class="form-control form-control-static" id="nombre_completo_contacto"></div>
                                                        <label for="nombre_completo_contacto">Nombre Completo</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div> 

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <div class="form-control form-control-static" id="telefono_contacto"></div>
                                                        <label for="telefono_contacto">Lada - Teléfono</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>    

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <div class="form-control form-control-static" id="correo_contacto"></div>
                                                        <label for="correo_contacto">Correo</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <div class="form-control form-control-static" id="comentarios_contacto"></div>
                                                        <label for="comentarios_contacto">Comentarios</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>                               
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>  


<div class="modal fade" id="subirFoto" tabindex="-1" role="subirFoto" aria-hidden="true">
                        <?php echo form_open_multipart('/admin/subir-foto-tienda-logo');?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Subir Foto   * Tam recomendado (ancho)205px x (alto)156px</span>
                                            </div>
                                        </div>

                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->                                   
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="file" name="userfile" size="20" />
                                                        <label for="usuario">Foto</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                                                                          
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn green">Crear</button>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>                               
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                            <input type="hidden" name="tienda_id" value="<?php echo $tiendaId ?>" />
                    </form>
</div>                          