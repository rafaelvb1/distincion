ALTER TABLE `distapp_mobil`.`productos`
ADD COLUMN `mecanismo` VARCHAR(120) NULL AFTER `fecha_modificacion`;

ALTER TABLE `distapp_mobil`.`productos`
ADD COLUMN `masaje` VARCHAR(120) NULL AFTER `fecha_modificacion`;
