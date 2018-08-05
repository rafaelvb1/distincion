

                    <div class="row">
                        <!--<form action="#" id="form_sample_3">-->
                        <?php echo form_open('admin/aprobar_rechazar_vendedor','id=aprobar-rechazar-vendedor-form') ?>
                        <div class="col-md-6">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-blue"></i>
                                            <span class="caption-subject font-blue sbold uppercase">Datos del Vendedor</span>
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
                                                <div class="form-control form-control-static" id="codigo"><b><?php echo $detalleVendedor[0]['codigo'] ?></b></div>
                                                <label for="codigo">Código</label>
                                                <div class="form-control-focus"> </div>
                                            </div>   

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <div class="form-control form-control-static" id="fecha_codigo"><b><?php echo cFeHuman($detalleVendedor[0]['fecha_codigo'],4) ?></b></div>
                                                <label for="fecha_codigo">Fecha Solicitud Código</label>
                                                <div class="form-control-focus"> </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo $detalleVendedor[0]['nombre_vendedor'] ?>" class="form-control" name="nombre" id="nombre">
                                                <label for="nombre">Nombre</label>
                                                <div class="form-control-focus"> </div>
                                            </div>   

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo $detalleVendedor[0]['apellido_paterno'] ?>" class="form-control" 
                                                name="apellido_paterno" id="apellido_paterno">
                                                <label for="apellido_paterno">Apellido Paterno</label>
                                                <div class="form-control-focus"> </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo $detalleVendedor[0]['apellido_materno'] ?>" class="form-control" 
                                                 name="apellido_materno" id="apellido_materno">
                                                <label for="apellido_materno">Apellido Materno</label>
                                                <div class="form-control-focus"> </div>
                                            </div> 

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo $detalleVendedor[0]['celular'] ?>" class="form-control" name="celular" id="celular">
                                                <label for="celular">Celular</label>
                                                <div class="form-control-focus"> </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo $detalleVendedor[0]['correo'] ?>" class="form-control" name="correo" id="correo">
                                                <label for="correo">Correo</label>
                                                <div class="form-control-focus"> </div>
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
                                            <span class="caption-subject font-blue sbold uppercase">Datos Tienda: <span style="color:black;"> <?php echo $detalleVendedor[0]['nombre_tienda'] ?> </span> Sucursal: <span style="color:black;"> <?php echo $detalleVendedor[0]['nombre_sucursal'] ?>  </span></span>
                                    </div>
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->                                   
                                        <div class="form-body">

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="tienda" id="tienda">
                                                    <option value="-1">--</option>
                                                <?php foreach ($listadoTiendas  as $key => $valTienda) { ?>
                                                    <option <?php echo isset( $detalleVendedor[0]['id_tienda'] ) ? ($detalleVendedor[0]['id_tienda'] == $valTienda['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valTienda['id'] ?>"><?php echo $valTienda['nombre'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Tienda</label>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="estado" id="estado">
                                                    <option value="1">--</option>
                                                <?php foreach ($ctgCiudades  as $key => $valCiudades) { ?>
                                                    <option <?php echo isset( $detalleVendedor[0]['estado_id'] ) ? ($detalleVendedor[0]['estado_id'] == $valCiudades['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valCiudades['id'] ?>"><?php echo $valCiudades['nombre']." - ".$valCiudades['abrev'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Estado</label>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                 <select class="form-control" name="municipio" id="municipio">
                                                 <option value="1">--</option>   
                                                 <?php 
                                                 if (!empty($localidades)) { 
                                                    foreach ($localidades as $key => $valLocalidades) { ?>
                                                     <option <?php echo isset( $detalleVendedor[0]['municipio_id'] ) ? ($detalleVendedor[0]['municipio_id'] == $valLocalidades['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valLocalidades['id'] ?>" ><?php echo $valLocalidades['nombre'] ?></option>
                                                 <?php } } ?>
                                                </select>
                                                <label for="municipio">Localidad</label>
                                            </div> 


                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="sucursal_id" id="sucursal_id">
                                                    <option value="1">--</option>
                                                <?php foreach ($listadoSucursales  as $key => $valSucursales) { ?>
                                                    <option <?php echo isset( $detalleVendedor[0]['id_sucursal'] ) ? ($detalleVendedor[0]['id_sucursal'] == $valSucursales['id_sucursal'] ? "selected='selected'":""):"" ?> value="<?php echo $valSucursales['id_sucursal'] ?>"><?php echo $valSucursales['nombre_sucursal']?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="nombre_completo_contacto">Sucursales</label>
                                                <div class="form-control-focus"> </div>
                                            </div>                                            

                                            <!--<div class="form-group form-md-line-input form-md-floating-label">
                                                <div class="form-control form-control-static" id="codigo"><b><?php echo $detalleVendedor[0]['contacto_sucursal'] ?></b></div>
                                                <label for="telefono_contacto">Gerente</label>
                                                <div class="form-control-focus"> </div>
                                            </div> 

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <div class="form-control form-control-static" id="codigo"><b><?php echo $detalleVendedor[0]['telefono_sucursal'] ?></b></div>
                                                <label for="telefono_contacto">Teléfono</label>
                                                <div class="form-control-focus"> </div>
                                            </div> 

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <div class="form-control form-control-static" id="codigo"><b><?php echo $detalleVendedor[0]['comentarios_sucursal'] ?></b></div>
                                                <label for="telefono_contacto">Comentarios</label>
                                                <div class="form-control-focus"> </div>
                                            </div> -->
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
                                                    <div class="col-md-offset-">
                                                    <?php if ($tipo == "aprobacion") { ?>
                                                        <input type="submit" name="accion" value="Aprobar" class="btn btn-lg blue m-icon-big" />
                                                        <input type="submit" name="accion" value="Rechazar" class="btn btn-lg red m-icon-big" />                                                        
                                                    <?php }else{ ?>
                                                        <input type="submit" value="Editar" class="btn btn-lg blue m-icon-big" />
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- END VALIDATION STATES-->
                        </div> 
                        <input type="hidden" name="id_vendedor" value="<?php echo $detalleVendedor[0]['id_vendedor'] ?>" />
                        <input type="hidden" name="url_redireccion" value="<?php echo $urlRedireccion ?>" />
                        </form>
                        <!-- END FORM-->
                    </div>                       