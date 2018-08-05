 
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
                                                <th> Fecha </th>
                                                <th> Mueble </th>
                                                <th> Visitas </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($visitasVendedor)) {
                                            foreach ($visitasVendedor as $key => $valVisitas) { ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"> <?php echo cFeHuman($valVisitas['fecha_visita'],1) ?> </td>
                                                    <td> <?php echo $valVisitas['nombre'] ?> </td>
                                                    <td> <?php echo $valVisitas['cantidad'] ?> </td>
                                                </tr>                                                
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>


                 