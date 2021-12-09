drop procedure proc_manaualvaluation_v2;DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_manaualvaluation_v2`(IN `lot_param` json,
	IN `bldg_param` json,
	IN `lotarea_param` json,
	IN `additional_param` json,
	IN `bldgarea_param` json,
	IN `bldgallowance_param` json,
	IN `tax_param` json,
	IN `p_user` VARCHAR(50),
	IN `prop_id` INT)
BEGIN
    DECLARE msg varchar(4000) DEFAULT 0;
    DECLARE id int DEFAULT 0;
	
   
    set @msg = manualval_lot_v2(lot_param,p_user, prop_id);
	set @msg = manualval_lotarea_v2(lotarea_param,p_user,prop_id);
    set @msg = manualval_bldg_v2(bldg_param,p_user, prop_id);    
    set @msg = manualval_tax_v2(tax_param,p_user, prop_id);
    set @msg = manualval_additional(additional_param,p_user, prop_id);
   -- set @msg = manualval_bldgarea_v2(bldgarea_param,p_user, prop_id);
    update cm_appln_valdetl set vd_approvalstatus_id = '09' where vd_id = prop_id;
    
   /* set @msg = manualval_lotarea(lotarea_param,p_user, prop_id);
    
	set @msg = manualval_bldg(bldg_param,p_user, prop_id);
    
    set @msg = manualval_bldgarea(bldgarea_param,p_user, prop_id);
 
	set @msg = manualval_additional(additional_param,p_user, prop_id);
    
    set @msg = manualval_allowance(bldgallowance_param,p_user, prop_id);
    
    */

   
END$$
DELIMITER ;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_bldg_v2`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE bldgid int;
	DECLARE allowancevalue varchar(30);
	DECLARE depvalue varchar(55);
	DECLARE netbldgvalue varchar(30);
	DECLARE roundbldgvalue varchar(55);
	DECLARE actioncode varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO bldgid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].allowancevalue')))) INTO allowancevalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].depvalue')))) INTO depvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].netbldgvalue')))) INTO netbldgvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundbldgvalue')))) INTO roundbldgvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
        
		set allowancevalue = replace(allowancevalue, ',', '');
		set depvalue = replace(depvalue, ',', '');
		set netbldgvalue = replace(netbldgvalue, ',', '');
		set roundbldgvalue = replace(roundbldgvalue, ',', '');
        
        /*
        update cm_appln_val_bldg set vb_netnt = netbldgvalue, vb_roundnetnt = roundbldgvalue,
        vb_grossallowancevalue = allowancevalue , vb_depreciationvalue = depvalue
        where vb_id = bldgid;*/
       
        if actioncode = 'new' then
			insert into cm_appln_val_bldg(vb_vd_id, vb_bldg_no,vb_bldgtype_id, vb_bldgstorey_id, vb_bldgcondn_id, vb_bldgposition_id,
            vb_bldgstructure_id, vb_rooftype_id,  vb_walltype_id, vb_floortype_id, vb_cccdate, vb_occupieddate, vb_ismainbldg_id,
			vb_grossallowancevalue, vb_depreciationvalue, vb_netnt, vb_roundnetnt)
			select ab_vd_id, ab_bldg_no, ab_bldgtype_id, ab_bldgstorey_id,ab_bldgcondn_id, ab_bldgposition_id, ab_bldgstructure_id,
            ab_rooftype_id, ab_walltype_id,ab_floortype_id,ab_cccdate, ab_occupieddate, ab_ismainbldg_id,
			allowancevalue, depvalue, netbldgvalue, roundbldgvalue from  cm_appln_bldg 
			where ab_id = bldgid;
        
        end if;
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_bldgarea_v2`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE rate  varchar(30);
	DECLARE grossvalue varchar(55);
	DECLARE actioncode varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arearate')))) INTO rate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossareavalue')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
        
		set rate = replace(rate, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        /*
        update cm_appln_val_bldgarea set vba_bldgrate = rate,
        vba_grossareavalue = grossvalue, vba_updateby = p_user, vba_updatedate = now()
        where vba_id = id;*/
        
		 if actioncode = 'new' then
			insert into cm_appln_val_bldgarea(vb_vd_id, vb_bldg_no,vb_bldgtype_id, vb_bldgstorey_id, vb_bldgcondn_id, vb_bldgposition_id,
            vb_bldgstructure_id, vb_rooftype_id,  vb_walltype_id, vb_floortype_id, vb_cccdate, vb_occupieddate, vb_ismainbldg_id,
			vb_grossallowancevalue, vb_depreciationvalue, vb_netnt, vb_roundnetnt)
			select aba_areatype_id, ab_bldg_no, ab_bldgtype_id, ab_bldgstorey_id,ab_bldgcondn_id, ab_bldgposition_id, ab_bldgstructure_id,
            ab_rooftype_id, ab_walltype_id,ab_floortype_id,ab_cccdate, ab_occupieddate, ab_ismainbldg_id,
			allowancevalue, depvalue, netbldgvalue, roundbldgvalue from  cm_appln_bldgarea 
			where vba_vb_id = id;
        
        end if;
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END$$
DELIMITER ;

