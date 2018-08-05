<?php isadministrador(); ?>
                     
                        <div class="portlet-body">
                            <div class="tiles">
                        <?php if ( !empty( $listadoTiendas) ) { 
                                $style = "bg-red-sunglo";
                                foreach ($listadoTiendas as $key => $valTienda) { ?>
                                
                                    <div class="tile <?php echo $style ?>  ">
                                        <a href="<?php echo base_url() ?>admin/tienda-detalle/<?php echo $this->encrypt->encode( $valTienda['id'] ); ?>" style="text-decoration:none;">
                                            <div class="tile-body">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                            <div class="tile-object">
                                                <div class="name"> <?php echo $valTienda['nombre'] ?> </div>
                                            </div>
                                        </a>
                                    </div>

                        <?php  
                             $style = ( $style == "bg-red-sunglo" ? "bg-blue-steel":"bg-red-sunglo" );
                            } 
                        } ?>
                            </div>
                        </div>
                    