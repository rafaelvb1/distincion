                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Vendedores por tienda departamental</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="mt-element-card mt-element-overlay">
                                        <div class="row">

                                            <?php if (!empty($listadoTiendas)) {
                                               foreach ($listadoTiendas as $key => $valTienda) { ?>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                        <div class="mt-overlay">
                                                            <h2>
                                                            <a style="text-decoration:none;" href="<?php echo base_url() ?>admin/listado-vendedores-por-tienda/<?php echo $valTienda['id'] ?>" ><?php echo $valTienda['nombre']; ?>(<?php echo $valTienda['activo']; ?>)</a>
                                                            </h2>
                                                        </div>
                                                        
                                                    </div>                                                
                                        <?php  } } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>