
<div class="row">
    <div class="col-md-12">
        <div class="portlet-body">
            <div class="form-body">
                <div class="portlet light portlet-fit portlet-form bordered col-md-6">
                    <div class="form-group form-md-line-input form-md-floating-label">
                        <select class="form-control" name="tiendanot" id="tiendanot">
                            <option value="-1">--</option>
                            <?php foreach ($listadoTiendas  as $key => $valTienda) { ?>
                            <option  value="<?php echo $valTienda['id'] ?>"><?php echo $valTienda['nombre'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="tiendanot">Tienda</label>
                    </div>
                    <div class="form-group form-md-line-input form-md-floating-label">
                        <input type="text" value="" class="form-control" name="mensaje" id="mensaje">
                        <label for="mensaje">Mensaje</label>
                    </div>
                </div>   
                <div class="portlet light portlet-fit portlet-form bordered col-md-6">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" glyphicon glyphicon-ok font-blue"></i>
                                <span class="caption-subject font-blue sbold uppercase">Sucursales</span> 
                        </div>
                    </div>
                    <div class="portlet-body">                               
                        <div class="form-body">
                                <div id='cblist'>
                                </div>  
                        </div>
                    </div>     
                </div>  
            </div>
        </div>
    </div>
</div>


