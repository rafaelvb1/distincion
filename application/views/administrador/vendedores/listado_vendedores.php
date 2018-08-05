 
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-basket font-dark"></i>
                                        <span class="caption-subject bold uppercase"> </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> Nombre </th>
                                                <th> Código </th>
                                                <th> Password </th>
                                                <th> Correo </th>
                                                <th> Celular </th>
                                                <th> Estado </th>
                                                <th> Municipio </th>
                                                <th> Sucursal </th>
                                                <th> Registrado Desde</th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($listadoVendedores)) {
                                            foreach ($listadoVendedores as $key => $valVendedor) { ?>
                                                <tr class="odd gradeX">
                                                    <td width="20%" > <?php echo $valVendedor['nombre_vendedor']." ".$valVendedor['apellido_paterno'] ?> </td>
                                                    <td> <?php echo $valVendedor['codigo'] ?> </td>
                                                    <td> <?php echo $valVendedor['password'] ?> </td>
                                                    <td> <?php echo $valVendedor['correo'] ?> </td>
                                                    <td> <?php echo $valVendedor['celular'] ?> </td>
                                                    <td> <?php echo $valVendedor['estado_nombre'] ?> </td>
                                                    <td> <?php echo $valVendedor['municipio_nombre'] ?> </td>
                                                    <td> <?php echo $valVendedor['nombre_sucursal'] ?> </td>
                                                    <td class="center"> <?php echo cFeHuman($valVendedor['fecha_codigo'],1) ?> </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs normal dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actiones
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="<?php echo base_url() ?>admin/vendedor-detalle/<?php echo $valVendedor['id_vendedor'] ?>/<?php echo $this->encrypt->encode( base_url()."admin/listado_vendedores_por_tienda/".$valVendedor['id_tienda'] ); ?>/edicion" >
                                                                        <i class="icon-docs"></i> Ver Detalle </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo base_url() ?>admin/vendedor-estadisticas/<?php echo $valVendedor['id_vendedor'] ?>" >
                                                                        <i class="icon-stats"></i> Ver Estadísticas </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>                                                
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>


                 