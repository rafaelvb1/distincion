 
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box blue  bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-user-follow font-dark"></i>
                                        <span class="caption-subject bold uppercase"> </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> Nombre </th>
                                                <th> Código </th>
                                                <th> Fecha Solicitud </th>
                                                <th> Correo </th>
                                                <th> Celular </th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($vendedorPorAprobar)) {
                                            foreach ($vendedorPorAprobar as $key => $valVendedor) { ?>
                                                <tr class="odd gradeX">
                                                    <td width="20%" > <?php echo $valVendedor['nombre_vendedor']." ".$valVendedor['apellido_paterno'] ?> </td>
                                                    <td> <?php echo $valVendedor['codigo'] ?> </td>
                                                    <td class="center"> <?php echo cFeHuman($valVendedor['fecha_codigo'],1) ?> </td>
                                                    <td> <?php echo $valVendedor['correo'] ?> </td>
                                                    <td> <?php echo $valVendedor['celular'] ?> </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs normal dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="<?php echo base_url() ?>admin/vendedor-detalle/<?php echo $valVendedor['id_vendedor'] ?>/<?php echo $this->encrypt->encode( base_url()."admin/listado_vendedores_por_aprobar" ); ?>/aprobacion" >
                                                                        <i class="icon-docs"></i> Ver Detalle </a>
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


                 