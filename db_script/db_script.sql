
DROP Function `cama`.`manualval_bldgarea`;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_bldgarea`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE rate  varchar(30);
	DECLARE grossvalue varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arearate')))) INTO rate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossareavalue')))) INTO grossvalue;
        
		set rate = replace(rate, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        
        update cm_appln_val_bldgarea set vba_bldgrate = rate,
        vba_grossareavalue = grossvalue, vba_netareavalue=grossvalue, vba_updateby = p_user, vba_updatedate = now()
        where vba_id = id;
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END$$
DELIMITER ;
