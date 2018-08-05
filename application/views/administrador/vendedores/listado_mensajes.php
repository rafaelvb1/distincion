 
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
                                                <th> Mensaje </th>
                                                <th> Tipo </th>
                                                <th> Texto </th>
                                                <th> Fecha Creación </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($mensajes)) {
                                            foreach ($mensajes as $key => $valMensajes) { ?>
                                                <tr class="odd gradeX">
                                                    <td width="20%" > <?php echo $valVendedor['mensahe']</td>
                                                    <td> <?php echo $valVendedor['codigo'] ?> </td>
                                                    <td class="center"> <?php echo cFeHuman($valVendedor['fecha_codigo'],1) ?> </td>
                                                    <td> <?php echo $valVendedor['correo'] ?> </td>
                                                </tr>                                                
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>


                 