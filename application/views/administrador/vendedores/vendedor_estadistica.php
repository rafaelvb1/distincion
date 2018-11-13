 
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
                            <div class="portlet box blue  bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-user-follow font-dark"></i>
                                        <span class="caption-subject bold uppercase"> </span>
                                    </div>
                                </div>     
                                <div class="portlet-body">    
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th> Fecha </th>
                                                <th> Masaje </th>
                                                <th> Visitas </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($visitasVendedorMasaje)) {
                                            foreach ($visitasVendedorMasaje as $key => $valVisitasMasaje) { ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"> <?php echo cFeHuman($valVisitasMasaje['fecha_visita'],1) ?> </td>
                                                    <td> <?php echo $valVisitasMasaje['nombre'] ?> </td>
                                                    <td> <?php echo $valVisitasMasaje['cantidad'] ?> </td>
                                                </tr>                                                
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>   
                            </div>    
                            <div class="portlet box blue  bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-user-follow font-dark"></i>
                                        <span class="caption-subject bold uppercase"> </span>
                                    </div>
                                </div>     
                                <div class="portlet-body">    
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                <th> Fecha </th>
                                                <th> Mecanismo </th>
                                                <th> Visitas </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($visitasVendedorMecanismo)) {
                                            foreach ($visitasVendedorMecanismo as $key => $valVisitasMecanismo) { ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"> <?php echo cFeHuman($valVisitasMecanismo['fecha_visita'],1) ?> </td>
                                                    <td> <?php echo $valVisitasMecanismo['nombre'] ?> </td>
                                                    <td> <?php echo $valVisitasMecanismo['cantidad'] ?> </td>
                                                </tr>                                                
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                            <div class="portlet box blue  bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-user-follow font-dark"></i>
                                        <span class="caption-subject bold uppercase"> </span>
                                    </div>
                                </div>     
                                <div class="portlet-body">    
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                                        <thead>
                                            <tr>
                                                <th> Fecha </th>
                                                <th> Usuario </th>
                                                <th> Visitas </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($visitasVendedorLogin)) {
                                            foreach ($visitasVendedorLogin as $key => $valVisitasLogin) { ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"> <?php echo cFeHuman($valVisitasLogin['fecha_visita'],1) ?> </td>
                                                    <td> <?php echo $valVisitasLogin['nombre'] ?> </td>
                                                    <td> <?php echo $valVisitasLogin['cantidad'] ?> </td>
                                                </tr>                                                
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>


                 