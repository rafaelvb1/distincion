<?php isadministrador(); ?>
                    <div class="row">
                        <!--<form action="#" id="form_sample_3">-->
                        <?php echo form_open('admin/salvar-producto','id=salvar-producto') ?>
                        <div class="col-md-6">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-blue"></i>
                                            <span class="caption-subject font-blue sbold uppercase">Datos del Sillón</span>
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
                                                <input type="text" value="<?php echo isset( $detalleProducto[0]['nombre']) ? $detalleProducto[0]['nombre'] :'' ?>" class="form-control" name="nombre" id="nombre">
                                                <label for="codigo">Nombre</label>
                                                <div class="form-control-focus"> </div>
                                            </div>   

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo isset( $detalleProducto[0]['alto']) ? $detalleProducto[0]['alto'] :'' ?>" class="form-control" name="alto" id="alto">
                                                <label for="nombre">Alto</label>
                                                <div class="form-control-focus"> </div>
                                            </div>   

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo isset( $detalleProducto[0]['ancho']) ? $detalleProducto[0]['ancho'] :'' ?>" class="form-control" name="ancho" id="ancho">
                                                <label for="nombre">Ancho</label>
                                                <div class="form-control-focus"> </div>
                                            </div>                                            

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo isset( $detalleProducto[0]['profundo']) ? $detalleProducto[0]['profundo'] :'' ?>" class="form-control" name="profundo" id="profundo">
                                                <label for="nombre">profundo</label>
                                                <div class="form-control-focus"> </div>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="categoria_id" id="categoria_id">
                                                    <option value="-1">--</option>
                                                <?php foreach ($listadoCategorias  as $key => $valCategoria) { ?>
                                                    <option <?php echo isset( $detalleProducto[0]['categoria_id'] ) ? ($detalleProducto[0]['categoria_id'] == $valCategoria['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valCategoria['id'] ?>"><?php echo $valCategoria['nombre'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Categoría</label>
                                            </div>                                            

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="color_id" id="color_id">
                                                    <option value="-1">--</option>
                                                <?php foreach ($listadoColores  as $key => $valColores) { ?>
                                                    <option <?php echo isset( $detalleProducto[0]['color_id'] ) ? ($detalleProducto[0]['color_id'] == $valColores['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valColores['id'] ?>"><?php echo $valColores['nombre'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Color</label>
                                            </div>


                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="tapiz_id" id="tapiz_id">
                                                    <option value="-1">--</option>
                                                <?php foreach ($listadoTapiz  as $key => $valTapiz) { ?>
                                                    <option <?php echo isset( $detalleProducto[0]['tapiz_id'] ) ? ($detalleProducto[0]['tapiz_id'] == $valTapiz['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valTapiz['id'] ?>"><?php echo $valTapiz['nombre'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Tapiz</label>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="mecanismo_id" id="mecanismo_id">
                                                    <option value="-1">--</option>
                                                <?php foreach ($listadoMecanismo  as $key => $valMecanismo) { ?>
                                                    <option <?php echo isset( $detalleProducto[0]['mecanismo_id'] ) ? ($detalleProducto[0]['mecanismo_id'] == $valMecanismo['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valMecanismo['id'] ?>"><?php echo $valMecanismo['nombre'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Mecanismo</label>
                                            </div>     

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <select class="form-control" name="masaje_id" id="masaje_id">
                                                    <option value="-1">--</option>
                                                <?php foreach ($listadoMasaje  as $key => $valMasaje) { ?>
                                                    <option <?php echo isset( $detalleProducto[0]['masaje_id'] ) ? ($detalleProducto[0]['masaje_id'] == $valMasaje['id'] ? "selected='selected'":""):"" ?> value="<?php echo $valMasaje['id'] ?>"><?php echo $valMasaje['nombre'] ?></option>
                                                <?php } ?>
                                                </select>
                                                <label for="estado">Masaje</label>
                                            </div>                                                                                                                                

                                            <div class="form-group form-md-line-input ">
                                                <select class="form-control" name="estatus" id="estatus">
                                                    <option value="-1">--</option>
                                                    <option <?php echo isset( $detalleProducto[0]['estatus'] ) ? ($detalleProducto[0]['estatus'] == "1" ? "selected='selected'":""):"" ?> value="1">Activo</option>
                                                    <option <?php echo isset( $detalleProducto[0]['estatus'] ) ? ($detalleProducto[0]['estatus'] == "0" ? "selected='selected'":""):"" ?> value="0">Desactivo</option>
                                                </select>
                                                <label for="estatus">Estatus</label>
                                            </div>

                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" value="<?php echo isset( $detalleProducto[0]['sku']) ? $detalleProducto[0]['sku'] :'' ?>" class="form-control" name="sku" id="sku">
                                                <label for="nombre">SKU</label>
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
                                            <span class="caption-subject font-blue sbold uppercase">Tiendas Disponibles </span> 
                                    </div>
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->                                   
                                        <div class="form-body">
                                        <?php
                                        if ( !empty($tiendasProducto) ){
                                            foreach ($tiendasProducto as $key => $valTiendasProducto) { ?>
                                            <div class="md-checkbox-list">
                                                <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox1_<?php echo $key ?>" <?php echo ($valTiendasProducto['producto'] > 0 ? 'checked=checked':'' ) ?> name="tiendas[]" value="<?php echo $valTiendasProducto['id'] ?>" class="md-check">
                                                    <label for="checkbox1_<?php echo $key ?>">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> 
                                                    <?php echo $valTiendasProducto['nombre'] ?></label>
                                                </div>
                                            </div>          
                                        <?php 
                                           }
                                        }
                                        ?>
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
                                            <span id="procesandoPetición" class="caption-subject font-blue sbold uppercase">
                                                Fotos  <span id="peticion" ></span>  
                                            </span> 
                                    </div>
                                    <?php if( $productoId > 0 ){ ?>
                                    <div class="actions">
                                        <a href="#subirFoto" data-toggle="modal" class="btn blue btn-sm green">
                                            <i class="fa fa-plus"></i> Agregar Foto 
                                        </a>
                                    </div>
                                    <?php } ?>           
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->        
                                        <div class="form-body">
                                            <div class="mt-element-list">    
                                                <div class="mt-list-container list-news ext-2">
                                                    <ul>
                                                        <?php
                                                        if ( !empty($fotosProducto) ){
                                                            foreach ($fotosProducto as $key => $valFotosProducto) { ?>  
                                                        <li class="mt-list-item">
                                                            <div class="list-thumb">
                                                                 <img alt="" src="<?php echo base_url()."/img.muebles/".$valFotosProducto['path']  ?>">
                                                            </div>
                                                            <h3 class="uppercase">
                                                                Posición <?php echo $valFotosProducto['orden'] ?> <?php if( $valFotosProducto['orden'] == 1 ){ ?><i class="fa fa-asterisk"></i> <?php } ?> 

                                                                <?php if( $valFotosProducto['orden'] != 1 ){ ?>
                                                                <a href="javascript:;" onClick="marcarComoPrincipal(<?php echo $valFotosProducto['producto_id'] ?>,<?php echo $valFotosProducto['id_foto'] ?>);" title="Marcar como Principal" class="btn btn-icon-only blue">
                                                                    <i class="fa icon-link"></i>
                                                                </a>
                                                                <?php } ?>
                                                                <a href="javascript:;" onClick="eliminarFoto(<?php echo $valFotosProducto['id_foto'] ?>,<?php echo $valFotosProducto['producto_id'] ?>);" title="Eliminar Foto" class="btn btn-icon-only red">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                                 
                                                            </h3>
                                                            <p></p>
                                                        </li>
                                                        <?php } } ?>
                                                    </ul>
                                                </div>  
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                        <!--Videos inicio-->
                        <div class="col-md-6">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" glyphicon glyphicon-film font-blue"></i>
                                            <span id="procesandoPetición" class="caption-subject font-blue sbold uppercase">
                                                Videos  <span id="peticion" ></span>  
                                            </span> 
                                    </div>


                                    <?php if( $productoId > 0 ){ ?>
                                    <div class="actions">
                                        <a href="#addVideo" data-toggle="modal" class="btn blue btn-sm green">
                                            <i class="fa fa-plus"></i> Agregar Video 
                                        </a>
                                    </div>
                                    <?php } ?>           
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->        
                                        <div class="form-body">
                                            <div class="mt-element-list">    
                                                <div class="mt-list-container list-news ext-2">
                                                    <ul>
                                                        <?php
                                                        if ( !empty($videosProducto) ){
                                                            foreach ($videosProducto as $key => $valVideosProducto) { ?>  
                                                        <li class="mt-list-item">
                                                            <h3 class="uppercase">
                                                            Video: <?php echo $valVideosProducto['nombre'] ?> 
                                                               <a href="<?php echo $valVideosProducto['path'] ?> " target="_blank" title="Ver Video" class="btn btn-icon-only blue">
                                                                    <i class="glyphicon glyphicon-film"></i>
                                                                </a>
                                                                <a href="javascript:;" onClick="eliminarVideo(<?php echo $valVideosProducto['id_video'] ?>,<?php echo $valVideosProducto['producto_id'] ?>);" title="Eliminar Video" class="btn btn-icon-only red">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </h3>
                                                            <p></p>
                                                        </li>

                                                   

                                                        <iframe width="420" height="315" 
                                                        src="<?php echo $valVideosProducto['path'] ?>" 
                                                        frameborder="0" allowfullscreen>
                                                        </iframe>

                                                        
                                                        <?php } } ?>
                                                    </ul>
                                                </div>  
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                        <!--Videos fin-->
                        <div class="col-md-6" hidden>
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" glyphicon glyphicon-camera font-blue"></i>
                                            <span id="procesandoPetición" class="caption-subject font-blue sbold uppercase">
                                                Fotos Mecanismo <span id="peticion" ></span>  
                                            </span> 
                                    </div>
                                    <?php if( $productoId > 0 ){ ?>
                                    <div class="actions">
                                        <?php if ( empty($detalleProducto[0]['masaje'] ) ){?> 
                                            <a href="#subirFotoMecanismo" data-toggle="modal" class="btn blue btn-sm green">
                                                <i class="fa fa-plus"></i> Agregar Foto Mecanismo
                                            </a>
                                        <?php }?>
                                    </div>
                                    <?php } ?>           
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->   
                                        <div class="form-body">
                                            <div class="mt-element-list">    
                                                <div class="mt-list-container list-news ext-2">
                                                    <ul>
                                                        <?php
                                                        if ( !empty($detalleProducto[0]['mecanismo'] ) ){?>  
                                                        <li class="mt-list-item">
                                                            <div class="list-thumb">
                                                                 <img alt="" src="<?php echo base_url()."/img.muebles/".$detalleProducto[0]['mecanismo']  ?>">
                                                            </div>
                                                            <h3 class="uppercase">
                                                                <a href="javascript:;" onClick="eliminarFotoMecanismo(<?php echo $detalleProducto[0]['id_producto'] ?>,<?php echo $detalleProducto[0]['id_producto'] ?>);" title="Eliminar Foto mecanismo" class="btn btn-icon-only red">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                                 
                                                            </h3>
                                                            <p></p>
                                                        </li>
                                                        <?php  } ?>
                                                    </ul>
                                                </div>  
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                        <div class="col-md-6" hidden>
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form bordered">
                                
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" glyphicon glyphicon-camera font-blue"></i>
                                            <span id="procesandoPetición" class="caption-subject font-blue sbold uppercase">
                                                Fotos Masaje <span id="peticion" ></span>  
                                            </span> 
                                    </div>
                                    <?php if( $productoId > 0 ){ ?>
                                    <div class="actions">
                                        <?php if ( empty($detalleProducto[0]['masaje'] ) ){?> 
                                            <a href="#subirFotoMasaje" data-toggle="modal" class="btn blue btn-sm green">
                                                <i class="fa fa-plus"></i> Agregar Foto Masaje
                                            </a>
                                        <?php } ?>  
                                    </div>
                                    <?php } ?>           
                                </div>

                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->   
                                        <div class="form-body">
                                            <div class="mt-element-list">    
                                                <div class="mt-list-container list-news ext-2">
                                                    <ul>
                                                        <?php
                                                        if ( !empty($detalleProducto[0]['masaje'] ) ){?>  
                                                        <li class="mt-list-item">
                                                            <div class="list-thumb">
                                                                 <img alt="" src="<?php echo base_url()."/img.muebles/".$detalleProducto[0]['masaje']  ?>">
                                                            </div>
                                                            <h3 class="uppercase">
                                                                <a href="javascript:;" onClick="eliminarFotoMasaje(<?php echo $detalleProducto[0]['id_producto'] ?>,<?php echo $detalleProducto[0]['id_producto'] ?>);" title="Eliminar Foto Masaje" class="btn btn-icon-only red">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                                 
                                                            </h3>
                                                            <p></p>
                                                        </li>
                                                        <?php  } ?>
                                                    </ul>
                                                </div>  
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
                                                    <div class="col-md-offset-">
                                                    <?php if ($productoId == 0) { ?>
                                                        <input type="submit" name="accion" value="Crear" class="btn btn-lg blue m-icon-big" />                                                      
                                                    <?php }else{ ?>
                                                        <input type="submit" name="accion" value="Editar" class="btn btn-lg blue m-icon-big" />
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- END VALIDATION STATES-->
                        </div> 
                        <input type="hidden" name="id_producto" value="<?php echo $productoId ?>" />
                        </form>
                        <!-- END FORM-->
                    </div>       



<div class="modal fade" id="subirFoto" tabindex="-1" role="subirFoto" aria-hidden="true">
                        <?php echo form_open_multipart('admin/subir-foto-producto');?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Subir Foto</span>
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

                                                    <div class="form-group form-md-line-input ">
                                                        <div class="md-checkbox-inline">
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" name="principal" id="checkbox1" class="md-check">
                                                                <label for="checkbox1">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> ¿Es Principal? </label>
                                                            </div>
                                                        </div>                                                        
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
                            <input type="hidden" name="id_producto" value="<?php echo $productoId ?>" />
                    </form>
</div> 
<div class="modal fade" id="addVideo" tabindex="-1" role="addVideo" aria-hidden="true">
                        <?php echo form_open_multipart('admin/add-video-producto');?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Agregar liga video</span>
                                            </div>
                                        </div>

                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->                                   
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" value="" class="form-control" name="file_name" id="fila_name"  />    
                                                        <label for="usuario">Nombre video</label>    
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" value="" class="form-control" name="ligaVideo" id="ligaVideo">
                                                        <label for="nombre">Liga Video</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>  

                                                  
                                                                                                          
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn green">Agregar</button>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>                               
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                            <input type="hidden" name="id_producto" value="<?php echo $productoId ?>" />
                    </form>
</div>
<div class="modal fade" id="subirFotoMecanismo" tabindex="-1" role="subirFotoMecanismo" aria-hidden="true">
                        <?php echo form_open_multipart('admin/subir-fotomecanismo-producto');?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Subir Foto Mecanismo</span>
                                            </div>
                                        </div>

                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->                                   
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="file" name="userfile" size="20" />
                                                        <label for="usuario">Foto Mecanismo</label>
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
                            <input type="hidden" name="id_producto" value="<?php echo $productoId ?>" />
                    </form>
</div> 
<div class="modal fade" id="subirFotoMasaje" tabindex="-1" role="subirFotoMasaje" aria-hidden="true">
                        <?php echo form_open_multipart('admin/subir-fotomasaje-producto');?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Subir Foto Masaje</span>
                                            </div>
                                        </div>

                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->                                   
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="file" name="userfile" size="20" />
                                                        <label for="usuario">Foto Masaje</label>
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
                            <input type="hidden" name="id_producto" value="<?php echo $productoId ?>" />
                    </form>
</div> 