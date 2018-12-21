<?php isadministrador(); ?>

<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title blue">
                                    <div class="caption font-dark">
                                        <i class="icon-user font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Usuarios</span>
                                    </div>
                                    <div class="actions">
                                        <a href="#crearUsuario" onClick="generaPassword();" data-toggle="modal" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Agregar Usuario </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <?php if (!empty($listadoUsuarios)) { ?>
                                     <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> Usuario </th>
                                                <th> Nombre </th>
                                                <th> Tipo </th>
                                                <th> Correo </th>
                                                <th> Estatus </th>
                                                <th> Creada Por </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                <?php  foreach ($listadoUsuarios as $key => $valListadoUsuarios) { ?>
                                       
                                            <tr class="odd gradeX">
                                                <td width="10%"> <?php echo $valListadoUsuarios['usuario'] ?> </td>
                                                <td> <?php echo $valListadoUsuarios['nombre']." ".$valListadoUsuarios['apellido_paterno'] ?> </td>
                                                <td> <?php echo $valListadoUsuarios['tipo'] ?> </td>
                                                <td> <?php echo $valListadoUsuarios['email'] ?> </td>
                                                <td> <?php echo ($valListadoUsuarios['estatus'] == 1 ? "Activo":"Desactivo" )?> </td>
                                                <td> <?php echo $valListadoUsuarios['usuario_creacion'] ?> </td>
                                                <td> 
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs normal dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actiones
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="#editarUsuario" onClick="editarUsuario('<?php echo  $valListadoUsuarios['id_usuario'] ?>','modificar');" data-toggle="modal">
                                                                    <i class="icon-docs"></i>Editar</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;">
                                                                    <i class="icon-tag"></i>Reenviar Password </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                   
                                                </td>
                                            </tr>
                                        
                            <?php } echo "</tbody></table>"; } ?>                                        
                        <!-- END EXAMPLE TABLE PORTLET-->

</div>



<div class="modal fade" id="editarUsuario" tabindex="-1" role="editarUsuario" aria-hidden="true">
                        <?php echo form_open('admin/usuarios-crear/modificar','id=usuario-actualizar-form') ?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Actualizar Datos de Usuario</span>
                                            </div>
                                        </div>

                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->                                   
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" disabled="disabled" name="usuario" id="usuario" />
                                                        <label for="usuario">Usuario</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>

                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" name="password" id="password" />
                                                        <label for="password">Contraseña</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div> 

                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" name="nombre" id="nombre" />
                                                        <label for="nombre">Nombre</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div> 

                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" />
                                                        <label for="apellido_paterno">Apellido Paterno</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div> 

                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" name="email" id="email" />
                                                        <label for="email">Correo</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>

                                                    <div class="form-group form-md-line-input ">
                                                        <select class="form-control" name="tipo" id="tipo">
                                                            <option  value="admin">Administrador</option>
                                                            <option  value="agente">Agente</option>
                                                            <option  value="vendedor">Vendedor</option>
                                                        </select>
                                                        <label for="tippo">Tipo</label>
                                                    </div>   

                                                    <div class="form-group form-md-line-input ">
                                                        <select class="form-control" name="estatus" id="estatus">
                                                            <option value="1">Activo</option>
                                                            <option value="0">Desactivo</option>
                                                        </select>
                                                        <label for="estatus">Estatus</label>
                                                    </div>                                                                                                          
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn green">Actualizar</button>
                                                    </div>
                                                    <input type="hidden" id="idUsuario" name="id_usuario" />
                                                </div>
                                        </div>

                                    </div>                               
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                    </form>
</div>



<div class="modal fade" id="crearUsuario" tabindex="-1" role="crearUsuario" aria-hidden="true">
                        <?php echo form_open('admin/usuarios-crear/crear','id=usuario-crear-form') ?>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class=" icon-layers font-blue"></i>
                                                    <span class="caption-subject font-blue sbold uppercase">Crear Usuario</span>
                                            </div>
                                        </div>

                                        <div class="portlet-body">
                                            <!-- BEGIN FORM-->                                   
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" name="usuario" id="usuario_crear" />
                                                        <label for="usuario">Usuario</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>

                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" readOnly="true" name="password" id="password_crear" />
                                                        <label for="password">Contraseña</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div> 

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" name="nombre" id="nombre_crear" />
                                                        <label for="nombre">Nombre</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div> 

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno_crear" />
                                                        <label for="apellido_paterno">Apellido Paterno</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div> 

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input type="text" class="form-control" name="email" id="email_crear" />
                                                        <label for="email">Correo</label>
                                                        <div class="form-control-focus"> </div>
                                                    </div>

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="tipo" id="tipo_crear">
                                                            <option  value="admin">Administrador</option>
                                                            <option  value="agente">Agente</option>
                                                            <option  value="vendedor">Vendedor</option>
                                                        </select>
                                                        <label for="tippo">Tipo</label>
                                                    </div>   

                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <select class="form-control" name="estatus" id="estatus_crear">
                                                            <option value="1">Activo</option>
                                                            <option value="0">Desactivo</option>
                                                        </select>
                                                        <label for="estatus">Estatus</label>
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
                            <input type="hidden" id="idUsuario" name="id_usuario" />
                    </form>
</div>  