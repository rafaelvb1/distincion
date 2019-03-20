
<div class="row">
<?php echo form_open('admin/enviar-push','id=enviar-push') ?>
<div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> <?php echo MSN_ERROR ?> </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> <?php echo MSN_EXITO ?> </div>
    <div class="col-md-12">
        <div class="portlet-body">
            <div class="form-body">
                <div class= "col-md-6">
                    <div class="portlet light portlet-fit portlet-form bordered ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-basket font-blue"></i>
                                    <span class="caption-subject font-blue sbold uppercase">Tienda</span> 
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control" name="tiendanot" id="tiendanot">
                                        <option value="-1">Selecciona una tienda</option>
                                        <?php foreach ($listadoTiendas  as $key => $valTienda) { ?>
                                        <option  value="<?php echo $valTienda['id'] ?>"><?php echo $valTienda['nombre'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="tiendanot">Tienda</label>
                                </div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" value="<?php echo isset($mensaje)? $mensaje : '' ?>" class="form-control" name="mensaje" id="mensaje">
                                    <label for="mensaje">Mensaje</label>
                                </div>                                
                                <div class="form-body">
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-">
                                                <input type="submit" name="accion" value="Enviar" class="btn btn-lg blue m-icon-big" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>    
                    </div> 
                </div>   
                <div class= "col-md-6">                    
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" glyphicon glyphicon-ok font-blue"></i>
                                    <span class="caption-subject font-blue sbold uppercase">Sucursales</span> 
                            </div>
                        </div>
                        <div class="portlet-body" >                               
                            <div class="form-body">
                                    <div id='cblist' class= "scrollspy-example">
                                    </div>  
                            </div>
                        </div>     
                    </div>  
                </div>    
            </div>
        </div>
    </div>
</form>
</div>


