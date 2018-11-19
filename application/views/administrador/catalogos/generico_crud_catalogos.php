                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="actions">
                                        <a href="#crearRegistro" tittle="Nuevo" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Agregar</a>
                                    </div>
                                </div>                               
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th> # </th>
                                                    <th> Nombre </th>
                                                    <th> Estatus </th>
                                                    <th> Fecha Creación </th>
                                                    <th> Fecha Modificación </th>
                                                    <th> Creado Por </th>
                                                    <th> Modificado Por </th>
                                                    <th> &nbsp; </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            if( !empty($ctgDatos)){ 
                                                foreach ($ctgDatos as $key => $valCtg) {
                                            ?>
                                                <tr>
                                                    <td> <?php echo $valCtg['id'] ?> </td>
                                                    <td> <?php echo $valCtg['nombre'] ?> </td>
                                                    <td> <?php echo ( $valCtg['estatus'] == 1 ? 'Activo':'Desactivo' ) ?> </td>
                                                    <td> <?php echo cFeHuman($valCtg['fecha_creacion'],3); ?> </td>
                                                    <td> <?php echo cFeHuman($valCtg['fecha_modificacion'],3); ?> </td>
                                                    <td> <?php echo $valCtg['usuario_creacion'] ?> </td>
                                                    <td> <?php echo $valCtg['usuario_modificacion'] ?> </td>
                                                    <td>
                                                        <a href="#modificarRegistro" onClick="actualizaCatalogo('<?php echo $valCtg['nombre'] ?>','<?php echo $valCtg['id'] ?>')" title="Actualizar" data-toggle="modal" class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>
                                                        <?php if ( $valCtg['estatus'] == 1 ){ ?>
                                                            <a href="<?php echo base_url(); ?>admin/catalogos-desactivar/<?php echo $tipoCatalogoBd ?>/<?php echo $valCtg['id'] ?>/0/<?php echo $this->encrypt->encode($urlRedireccion) ?>" title="Desactivar" class="btn btn-icon-only red"><i class="fa fa-times"></i></a>
                                                        <?php }else{ ?>
                                                            <a href="<?php echo base_url(); ?>admin/catalogos-desactivar/<?php echo $tipoCatalogoBd ?>/<?php echo $valCtg['id'] ?>/1/<?php echo $this->encrypt->encode($urlRedireccion) ?>" title="Activar" class="btn btn-icon-only green"><i class="fa fa-plus"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL CREAR REGISTRO -->
                        <div class="modal fade" id="crearRegistro" tabindex="-1" role="crearRegistro" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Nuevo</h4>
                                    </div>
                                    <?php echo form_open('admin/catalogos-crear/'.$tipoCatalogoBd.'/0/'.$this->encrypt->encode($urlRedireccion),'id=login-form') ?>
                                        <div class="modal-body">                                         
                                           <p>Nombre: <input type="text" name="nombre" size="30"> </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn green">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>   

                        <!-- MODAL ACTUALIZAR REGISTRO -->
                        <div class="modal fade" id="modificarRegistro" tabindex="-1" role="modificarRegistro" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Modificar: <b><span id="nombreAnterior"></span></b> </h4>
                                    </div>
                                    <?php echo form_open('admin/catalogos-crear/'.$tipoCatalogoBd.'/1/'.$this->encrypt->encode($urlRedireccion),'id=login-form') ?>
                                        <div class="modal-body">                                         
                                           <p>Nombre nuevo: <input type="text" name="nombre" size="30"> </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn green">Actualizar</button>
                                        </div>
                                        <input type="hidden" id="idCatalogo" name="id" />
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>                                              