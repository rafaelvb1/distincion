<?php echo validation_errors(); ?>                        
                        <div class="row">
                            <div class="col-md-12 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-red-sunglo">
                                            <i class="icon-settings font-red-sunglo"></i>
                                            <span class="caption-subject bold uppercase"> Mis datos</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form role="form" action="<? echo BASE_URL(); ?>admin/actualiza-datos-personales" method="POST">
                                            <div class="form-body">
                                                
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <div class="input-icon input-icon-lg">
                                                        <input type="text" name="nombre" class="form-control input-lg" value="<?php echo $datos['nombre'] ?>" > </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Apellido</label>
                                                    <div class="input-icon input-icon-lg">
                                                        <input type="text" name="apellido_paterno" class="form-control input-lg" value="<?php echo $datos['apellido_paterno'] ?>"> </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Correo</label>
                                                    <div class="input-icon input-icon-lg">
                                                        <input type="email" name="email" class="form-control input-lg" value="<?php echo $datos['email'] ?>" > </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Usuario</label>
                                                    <div class="input-icon input-icon-lg">
                                                        <input type="text" name="usuario" class="form-control input-lg" value="<?php echo $datos['usuario'] ?>" disabled > </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Nuevo Password</label>
                                                    <div class="input-icon input-icon-lg">
                                                        <input type="password" name="password" class="form-control input-lg" value="<?php echo $datos['password'] ?>" > </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Estatus</label>
                                                    <select name="estatus" class="form-control input-icon-lg">
                                                        <option value="0">Desactivo</option>
                                                        <option <?php if( $datos['estatus'] ){ echo "selected "; } ?> value="1">Activo</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>¿Es administrador? </label>
                                                    <select name="administrador" class="form-control input-icon-lg">
                                                        <option <?php if( $datos['isAdmin'] == true ){ echo "selected "; } ?> value="admin">Si</option>
                                                        <option <?php if( $datos['isAdmin'] == false ){ echo "selected "; } ?>value="0">No</option>
                                                    </select>
                                                </div>                                                
                                               
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn blue">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>