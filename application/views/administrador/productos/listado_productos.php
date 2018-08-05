<?php isadministrador(); ?>

<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title blue">
                                    <div class="caption font-dark">
                                        <i class="fa fa-deviantart font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Muebles</span>
                                    </div>
                                    <div class="actions">
                                        <a  href="<?php echo base_url() ?>admin/detalle-producto/0" class="btn btn-default btn-sm">
                                            <i class="fa icon-basket"></i> Crear Producto </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <?php if (!empty($listadoProductos)) { ?>
                                     <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> Nombre </th>
                                                <th> Estatus </th>
                                                <th> Categoria </th>
                                                <th> Creada Por </th>
                                                <th> Fecha Creación </th>
                                                <th> Opciones </th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                <?php  foreach ($listadoProductos as $key => $valProductos) { ?>
                                       
                                            <tr class="odd gradeX">
                                                <td width="15%" > <?php echo $valProductos['nombre'] ?> </td>
                                                <td> <?php echo ($valProductos['estatus'] == 1 ? "Activo":"Desactivo" )?> </td>
                                                <td> <?php echo $valProductos['nombre_cat'] ?> </td>
                                                <td> <?php echo $valProductos['creado_por'] ?> </td>
                                                <td> <?php echo $valProductos['fecha_creacion'] ?> </td>
                                                <td> 
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs normal dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actiones
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="<?php echo base_url() ?>admin/detalle-producto/<?php echo $valProductos['id_producto'] ?>" >
                                                                    <i class="icon-docs"></i>Editar</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                   
                                                </td>
                                            </tr>
                                        
                            <?php } echo "</tbody></table>"; } ?>                                        
                        <!-- END EXAMPLE TABLE PORTLET-->

</div>




