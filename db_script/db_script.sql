
DROP PROCEDURE `cama`.`proc_manaualvaluation_v2`;

DROP FUNCTION `cama`.`manualval_bldg`;
DROP FUNCTION `cama`.`manualval_bldg_v2`;
DROP FUNCTION `cama`.`manualval_allowance_v2`;
DROP FUNCTION `cama`.`manualval_bldgarea_v2`;
DROP FUNCTION `cama`.`manualval_lot_v2`;
DROP FUNCTION `cama`.`manualval_lotarea_v2`;
DROP FUNCTION `cama`.`manualval_tax_v2`;
DELIMITER $$
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
    DECLARE bldgid int DEFAULT 0;
	
	
   
    set @msg = manualval_lot_v2(lot_param,p_user, prop_id);
	set @msg = manualval_lotarea_v2(lotarea_param,p_user,prop_id);
    set @msg = manualval_tax_v2(tax_param,p_user, prop_id);    
    set bldgid= manualval_bldg_v2(bldg_param,p_user, prop_id);
   --  select @id;
   
    set @msg = manualval_bldgarea_v2(bldgarea_param,bldgid,p_user, prop_id);
     set @msg = manualval_allowance_v2(bldgallowance_param,bldgid,p_user, prop_id);
     set @msg = manualval_additional(additional_param,p_user, prop_id);
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
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_bldg`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE bldgid int;
	DECLARE allowancevalue varchar(30);
	DECLARE depvalue varchar(55);
	DECLARE deprate varchar(55);
	DECLARE netbldgvalue varchar(30);
	DECLARE roundbldgvalue varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO bldgid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].allowancevalue')))) INTO allowancevalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].depvalue')))) INTO depvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].netbldgvalue')))) INTO netbldgvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundbldgvalue')))) INTO roundbldgvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].deprate')))) INTO deprate;
        
		set allowancevalue = replace(allowancevalue, ',', '');
		set depvalue = replace(depvalue, ',', '');
		set netbldgvalue = replace(netbldgvalue, ',', '');
		set roundbldgvalue = replace(roundbldgvalue, ',', '');
        
        update cm_appln_val_bldg set vb_netnt = netbldgvalue, vb_roundnetnt = roundbldgvalue,
        vb_grossallowancevalue = allowancevalue , vb_depreciationvalue = depvalue, vb_depreciationrate =deprate
        where vb_id = bldgid;
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
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
	DECLARE l_count int;
	DECLARE new_bldgid int;
	DECLARE allowancevalue varchar(30);
	DECLARE depvalue varchar(55);
	DECLARE netbldgvalue varchar(30);
	DECLARE roundbldgvalue varchar(55);
	DECLARE deprate varchar(55);
	DECLARE actioncode varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO bldgid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].allowancevalue')))) INTO allowancevalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].depvalue')))) INTO depvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].netbldgvalue')))) INTO netbldgvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundbldgvalue')))) INTO roundbldgvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].deprate')))) INTO deprate;
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
			-- select count(*) into l_count from cm_appln_val_bldg where vb_vd_id = ab_vd_id and vb_bldg_no = ab_bldg_no and vb_bldgtype_id = ab_bldgtype_id and vb_bldgstorey_id = ab_bldgstorey_id
           -- and vb_bldgcondn_id = ab_bldgcondn_id;
           --  if l_count = 0 then
				insert into cm_appln_val_bldg(vb_vd_id, vb_bldg_no,vb_bldgtype_id, vb_bldgstorey_id, vb_bldgcondn_id, vb_bldgposition_id,
				vb_bldgstructure_id, vb_rooftype_id,  vb_walltype_id, vb_floortype_id, vb_cccdate, vb_occupieddate, vb_ismainbldg_id,
				vb_grossallowancevalue, vb_depreciationvalue, vb_netnt, vb_roundnetnt, vb_depreciationrate)
				select ab_vd_id, ab_bldg_no, ab_bldgtype_id, ab_bldgstorey_id,ab_bldgcondn_id, ab_bldgposition_id, ab_bldgstructure_id,
				ab_rooftype_id, ab_walltype_id,ab_floortype_id,ab_cccdate, ab_occupieddate, ab_ismainbldg_id,
				allowancevalue, depvalue, netbldgvalue, roundbldgvalue, deprate from  cm_appln_bldg 
				where ab_id = bldgid;
                
                SELECT LAST_INSERT_ID() into new_bldgid;
			-- end if;
        end if;
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN new_bldgid;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_allowance_v2`(
	`p_param` json
,
    p_bldg_id int,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
    DECLARE id INT DEFAULT 0;
	DECLARE calmethod varchar(30);
	DECLARE percentage varchar(55);
	DECLARE grossvalue varchar(30);
	DECLARE bldgallowanceid varchar(55);
	DECLARE actioncode varchar(55);
	DECLARE allwancedes varchar(255);
	DECLARE calmethodid varchar(5);
	DECLARE bldgid int(55);
	DECLARE allowancetypeid varchar(5);
    
    WHILE i < JSON_LENGTH(p_param) DO
		
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgallowanceid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].calmethod')))) INTO calmethod;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].percentage')))) INTO percentage;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossvalue')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].desc')))) INTO allwancedes;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO bldgid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].sno')))) INTO actioncode;
        select tdi_key into calmethodid from tbdefitems where tdi_td_name = 'ALLOWANCECALMETHOD' and tdi_value = calmethod;
		
        set percentage = replace(percentage, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        
		select tdi_key into allowancetypeid from tbdefitems where tdi_td_name = 'ALLOWANCETYPE' 
        and tdi_value = SPLIT_STR(allwancedes, ',', 2);
		
        if actioncode = 'New' then 
			insert into cm_appln_val_bldgallowances(vbal_vb_id,vbal_allowancetype_id, vbal_calcmethod_id, vbal_drivevalue,
            vbal_grossallowancevalue, vbal_roundgrossallowancevalue,
            vbal_createby,vbal_createdate, vbal_updateby, vbal_updatedate)
            value(p_bldg_id,allowancetypeid,calmethodid,percentage,grossvalue,grossvalue,p_user, now(),p_user, now());
        end if;
        
        if actioncode = 'update' then 
			update cm_appln_val_bldgallowances set  vbal_calcmethod_id = calmethodid, vbal_drivevalue = percentage
            , vbal_grossallowancevalue = grossvalue, vbal_roundgrossallowancevalue = grossvalue,
            vbal_updateby = p_user, vbal_updatedate = now()
            where vbal_id = id;
        end if;
        
        if actioncode = 'Deleted' then 
			delete from cm_appln_val_bldgallowances where  vbal_id = id;
        end if;
        
       
        
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_bldgarea_v2`(
	`p_param` json,
    p_bldg_id int,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE bldgid int;
	DECLARE l_count int;
	DECLARE rate  varchar(30);
	DECLARE grossvalue varchar(55);
	DECLARE actioncode varchar(55);
    
    
	DECLARE chk_bldgid int;
	DECLARE chk_aba_ref tinytext;
	DECLARE chk_aba_areatype_id varchar(45);
	DECLARE chk_aba_arealevel_id varchar(45);
	DECLARE chk_aba_areacategory_id varchar(45);
	DECLARE chk_aba_areause_id varchar(45);
	DECLARE chk_aba_size float;
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].bldgarid')))) INTO bldgid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arearate')))) INTO rate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossareavalue')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
        
		set rate = replace(rate, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        /*
        update cm_appln_val_bldgarea set vba_bldgrate = rate,
        vba_grossareavalue = grossvalue, vba_updateby = p_user, vba_updatedate = now()
        where vba_id = id;*/
        
        /*select  aba_ref, aba_areatype_id, aba_arealevel_id, aba_areacategory_id,aba_areause_id, aba_size  into chk_aba_ref, chk_aba_areatype_id, chk_aba_arealevel_id,
        chk_aba_areacategory_id, chk_aba_areause_id, chk_aba_size from  cm_appln_bldgarea 
		where aba_ab_id = id;*/
        
		 if actioncode = 'new' then
			/* select count(*) into l_count from cm_appln_val_bldgarea where vba_vb_id = p_bldg_id and vba_ref = chk_aba_ref and vba_areatype_id = chk_aba_areatype_id 
             and vba_arealevel_id = chk_aba_arealevel_id and vba_areacategory_id = chk_aba_areacategory_id and vba_areause_id = chk_aba_areause_id
             and vba_size = chk_aba_size and vba_grossareavalue = grossvalue and vba_bldgrate = rate;*/
          -- if l_count = 0 then
				insert into cm_appln_val_bldgarea(vba_vb_id, vba_ref,vba_areatype_id, vba_arealevel_id, vba_areacategory_id, vba_areause_id,
				vba_areadesc, vba_unitcount,  vba_size, vba_sizeunit_id, vba_totsize, vba_bldgrate,  vba_grossareavalue, vba_netareavalue, vba_createby, vba_createdate)
				select p_bldg_id, aba_ref, aba_areatype_id, aba_arealevel_id, aba_areacategory_id,aba_areause_id, aba_areadesc, aba_unitcount,aba_size, aba_sizeunit_id,
				aba_totsize, rate,grossvalue, grossvalue, p_user,  sysdate()  from  cm_appln_bldgarea 
				where aba_id = bldgid;
           -- end if;
        
        end if;
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_lot_v2`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE lotid int;
	DECLARE l_count int;
	DECLARE netvalue varchar(30);
	DECLARE roundvalue varchar(55);
	DECLARE actioncode varchar(55);
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotid')))) INTO lotid;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].netvalue')))) INTO netvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].roundvalue')))) INTO roundvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
        
		set netvalue = replace(netvalue, ',', '');
		set roundvalue = replace(roundvalue, ',', '');
        if actioncode = 'new' then
			-- select count(*) into l_count from cm_appln_val_lot where vl_vd_id = al_vd_id and vl_lotcode_id = al_lotcode_id and vl_no = al_no and vl_size = vl_size
             -- and vl_sizeunit_id = vl_sizeunit_id;
          --  if l_count = 0 then
				insert into cm_appln_val_lot(vl_vd_id, vl_lotcode_id,vl_no, vl_altno, vl_titletype_id, vl_titleno, vl_alttitleno,
				vl_size,vl_sizeunit_id,vl_landcondition_id,vl_grosslandvalue, vl_roundnetlandvalue)
				select al_vd_id, al_lotcode_id, al_no, al_altno,al_titletype_id, al_titleno, al_alttitleno, al_size, al_sizeunit_id,
				al_landcondition_id,netvalue,roundvalue from  cm_appln_lot 
				where al_id = lotid;
           -- end if;
        
        end if;
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_lotarea_v2`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE rate varchar(30);
	DECLARE calculatedrate varchar(55);
	DECLARE grossvalue varchar(30);
	DECLARE actioncode varchar(30);
	DECLARE arname varchar(200);
	DECLARE area int;
	DECLARE lot_id int;
    
    WHILE i < JSON_LENGTH(p_param) DO
	
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].lotareaid')))) INTO id;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].rate')))) INTO rate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].calculatedrate')))) INTO calculatedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].grossvalue')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].actioncode')))) INTO actioncode;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].arname')))) INTO arname;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$[',i,'].area')))) INTO area;
        
        
		set rate = replace(rate, ',', '');
		set calculatedrate = replace(calculatedrate, ',', '');
		set grossvalue = replace(grossvalue, ',', '');
        select vl_id into lot_id from cm_appln_val_lot where vl_vd_id = prop_id;
        if   actioncode = 'new' then
			
			insert into cm_appln_val_lotarea(vla_vt_id,vla_desc,vla_area, vla_landrate, vla_discountrate, vla_grossareavalue,
            vla_roundnetareavalue)
            values(lot_id,arname,area,rate,calculatedrate,grossvalue,grossvalue);
        end if;
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `manualval_tax_v2`(
	`p_param` json
,
	`p_user` VARCHAR(50),
    prop_id int) RETURNS int(11)
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE id int;
	DECLARE l_count int;
	DECLARE grossvalue varchar(20);
	DECLARE valuedescretion varchar(20);
	DECLARE proposednt varchar(20);
	DECLARE proposedrate varchar(20);
	DECLARE calculatedrate varchar(20);
	DECLARE proposedtax varchar(20);
	DECLARE approvednt varchar(20);
	DECLARE approvedrate varchar(20);
	DECLARE adjustment varchar(20);
	DECLARE approvedtax varchar(20);
	DECLARE taxdriverate varchar(20);
	DECLARE taxdrivevalue varchar(20);
	DECLARE notes text;
    
    WHILE i < JSON_LENGTH(p_param) DO
		
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxvaluerdiscretion')))) INTO valuedescretion;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxgrossnt')))) INTO grossvalue;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxproposednt')))) INTO proposednt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxproposedrate')))) INTO proposedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxcalculaterate')))) INTO calculatedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxproposedtax')))) INTO proposedtax;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxapprovednt')))) INTO approvednt;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxapprovedrate')))) INTO approvedrate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxadjustment')))) INTO adjustment;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxapprovedtax')))) INTO approvedtax;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxnotes')))) INTO notes;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxdriverate')))) INTO taxdriverate;
		SELECT TRIM(BOTH '"' FROM (JSON_EXTRACT(p_param,concat('$.taxdrivevalue')))) INTO taxdrivevalue;
        
        set grossvalue = replace(grossvalue, ',', '');
        set valuedescretion = replace(valuedescretion, ',', '');
        set proposedrate = replace(proposedrate, ',', '');
        set calculatedrate = replace(calculatedrate, ',', '');
        set proposedtax = replace(proposedtax, ',', '');
        set approvednt = replace(approvednt, ',', '');
        set approvedrate = replace(approvedrate, ',', '');
        set adjustment = replace(adjustment, ',', '');
        set approvedtax = replace(approvedtax, ',', '');
        set proposednt = replace(proposednt, ',', '');
        set taxdrivevalue = replace(taxdrivevalue, ',', '');
        set taxdriverate = replace(taxdriverate, ',', '');
        
        if taxdrivevalue = '' then
			set taxdrivevalue = 0;
        end if;
        if taxdriverate = '' then
			set taxdriverate = 0;
        end if;
        if valuedescretion = '' then
			set valuedescretion = 0;
        end if;
        
         if calculatedrate = '' then
			set calculatedrate = 0;
        end if;
         if grossvalue = '' then
			set grossvalue = 0;
        end if;
         if proposedtax = '' then
			set proposedtax = 0;
        end if;
         if proposedrate = '' then
			set proposedrate = 0;
        end if;
        
         if adjustment = '' then
			set adjustment = 0;
        end if;
        
         if approvednt = '' then
			set approvednt = 0;
        end if;
        
         if approvedrate = '' then
			set approvedrate = 0;
        end if;
        
         if proposednt = '' then
			set proposednt = 0;
        end if;
        
        select count(*) into l_count from cm_appln_val_tax where vt_vd_id =prop_id;
        
        if l_count = 0 then
			insert into cm_appln_val_tax(vt_vd_id,vt_grossvalue,vt_proposednt, vt_proposedrate, vt_calculatedrate,
            vt_proposedtax, vt_approvednt, vt_approvedrate, vt_adjustment, vt_approvedtax, vt_note,
            vt_derivedrate,vt_derivedvalue, 
            vt_createby, vt_createdate, vt_valuedescretion)
            values(prop_id,grossvalue,proposednt,proposedrate, calculatedrate, proposedtax, approvednt,approvedrate,
            adjustment, approvedtax,notes,  ifnull(taxdriverate,0), ifnull(taxdrivevalue,0), p_user, now(), valuedescretion);
        else        
			 update cm_appln_val_tax set vt_grossvalue = grossvalue, 
				vt_proposednt = proposednt, 
				vt_proposedrate = proposedrate, 
				vt_calculatedrate = calculatedrate, 
				vt_proposedtax = proposedtax, 
				vt_approvednt = approvednt, 
				vt_approvedrate = approvedrate, 
				vt_adjustment = adjustment, 
				vt_approvedtax = approvedtax, 
				vt_note = notes, vt_updateby = p_user, vt_updatedate = now(),
				vt_derivedrate = ifnull(taxdriverate,0), vt_derivedvalue = ifnull(taxdrivevalue,0),
                vt_valuedescretion = valuedescretion
				where vt_vd_id = prop_id;
				
        end if;
        
       
		SELECT i + 1 INTO i;
        
	END WHILE;
RETURN 1;
END$$
DELIMITER ;
