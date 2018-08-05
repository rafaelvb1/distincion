--Agrega columna sku
ALTER TABLE `distapp_mobil`.`productos`
ADD COLUMN `sku` VARCHAR(45) NULL AFTER `fecha_modificacion`;