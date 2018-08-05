<?php isadministrador(); ?>
                    <div class="row">
                        <!--<form action="#" id="form_sample_3">-->
                        <?php echo form_open('admin/tiendas-sucursal-save','id=form_alta_sucursal') ?>
                        <div class="col-md-6">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-blue"></i>
                                            <span class="caption-subject font-blue sbold uppercase">Datos de la sucursal</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->                                   
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> <?php echo MSN_ERROR ?> </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> <?php echo MSN_EXITO ?> </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo ( isset( $detalleSucursal[0]['nombre_sucursal'] ) ? $detalleSucursal[0]['nombre_sucursal'] : null ) ?>" class="form-control" name="nombre_sucursal" id="nombre_sucursal">
                                                <label for="nombre_sucursal">Nombre Sucursal</label>
                                                <div class="form-control-focus"> </div>
                                            </div> 

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo ( isset( $detalleSucursal[0]['codigo_sucursal'] ) ? $detalleSucursal[0]['codigo_sucursal'] : null ) ?>" class="form-control" name="codigo" id="codigo">
                                                <label for="codigo">Código</label>
                                                <div class="form-control-focus"> </div>
                                            </div>    

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="estado" id="estado">
                                                    <option value="-1">--</option>
                                                <?php foreach ($ctgCiudades  as $key => $valCiudades) { ?>
                                                    <option <?php echo isset( $detalleSucursal[0]['estado_id'] ) ? ($detalleSucursal[0]['estado_id'] == $valCiudades['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valCiudades['id'] ?>"><?php echo $valCiudades['nombre']." - ".$valCiudades['abrev'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Estado</label>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                 <select class="form-control" name="municipio" id="municipio">
                                                 <?php 
                                                 if (!empty($localidades)) { 
                                                    foreach ($localidades as $key => $valLocalidades) { ?>
                                                     <option <?php echo isset( $detalleSucursal[0]['municipio_id'] ) ? ($detalleSucursal[0]['municipio_id'] == $valLocalidades['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valLocalidades['id'] ?>" ><?php echo $valLocalidades['nombre'] ?></option>
                                                 <?php } } ?>
                                                </select>
                                                <label for="municipio">Localidad</label>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" maxlength="5" value="<?php echo ( isset( $detalleSucursal[0]['cp'] ) ? $detalleSucursal[0]['cp'] : "" ) ?>" class="form-control" name="cp" id="cp">
                                                <label for="cp">CP</label>
                                                <div class="form-control-focus"> </div>
                                            </div> 
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="estatus" id="estatus">
                                                     <option value="-1">--</option>
                                                    <option <?php echo isset( $detalleSucursal[0]['estatus_sucursal'] ) ? ($detalleSucursal[0]['estatus_sucursal'] == "1" ? "selected='selected'":""):"" ?> value="1">Activo</option>
                                                    <option <?php echo isset( $detalleSucursal[0]['estatus_sucursal'] ) ? ($detalleSucursal[0]['estatus_sucursal'] == "0" ? "selected='selected'":""):"" ?> value="0">Desactivo</option>
                                                </select>
                                                <label for="estatus">Estatus</label>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>


                        <div class="col-md-6">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-blue"></i>
                                            <span class="caption-subject font-blue sbold uppercase">Datos de Gerente</span>
                                    </div>
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->                                   
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo ( isset( $detalleSucursal[0]['nombre_completo_contacto'] ) ? $detalleSucursal[0]['nombre_completo_contacto'] : "" ) ?>" class="form-control" name="nombre_completo_contacto" id="nombre_completo_contacto">
                                                <label for="nombre_completo_contacto">Nombre Completo</label>
                                                <div class="form-control-focus"> </div>
                                            </div> 

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo ( isset( $detalleSucursal[0]['telefono_contacto'] ) ? $detalleSucursal[0]['telefono_contacto'] : "" ) ?>" class="form-control" name="telefono_contacto" id="telefono_contacto">
                                                <label for="telefono_contacto">Lada - Teléfono</label>
                                                <div class="form-control-focus"> </div>
                                            </div>    

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo ( isset( $detalleSucursal[0]['correo_contacto'] ) ? $detalleSucursal[0]['correo_contacto'] : "" ) ?>" class="form-control" name="correo_contacto" id="correo_contacto">
                                                <label for="correo_contacto">Correo</label>
                                                <div class="form-control-focus"> </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <textarea class="form-control" name="comentarios_contacto"><?php echo ( isset( $detalleSucursal[0]['comentarios_contacto'] ) ? $detalleSucursal[0]['comentarios_contacto'] : "" ) ?></textarea>
                                                <label for="comentarios_contacto">Comentarios</label>
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>    

                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                            
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->                                   
                                        <div class="form-body">
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-10">
                                                        <input type="submit" value="<?php echo ($idSucursal > 0 ? 'Editar Sucursal':'Crear Sucursal'); ?>" class="btn btn-lg blue m-icon-big" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- END VALIDATION STATES-->
                        </div> 
                        <input type="hidden" name="tienda_id" value="<?php echo $tiendaId?> " />
                        <input type="hidden" name="id_sucursal" value="<?php echo $idSucursal ?>" />
                        <input type="hidden" name="municipio_id" value="<?php echo isset( $detalleSucursal[0]['municipio_id'] ) ? $detalleSucursal[0]['municipio_id']:""; ?>" />
                        </form>
                        <!-- END FORM-->
                    </div> 