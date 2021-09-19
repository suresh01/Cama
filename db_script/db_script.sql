DROP PROCEDURE `cama`.`proc_repo_borangc`;
DROP PROCEDURE `cama`.`proc_repo_collection_zoneandbldgcategory`;
DROP PROCEDURE `cama`.`proc_repo_export`;
DROP PROCEDURE `cama`.`proc_repo_propertstatus_race`;
DROP PROCEDURE `cama`.`proc_repo_propertstatus_zone`;
DROP PROCEDURE `cama`.`proc_repo_summary_district`;
DROP PROCEDURE `cama`.`proc_repo_summary_propstatusvscategory`;
DROP PROCEDURE `cama`.`proc_repo_summary_race`;
DROP PROCEDURE `cama`.`proc_repo_summary_racepropstatus`;
DROP PROCEDURE `cama`.`proc_repo_summary_subzone`;
DROP PROCEDURE `cama`.`proc_repo_summary_zone`;
DROP PROCEDURE `cama`.`proc_repo_summary_zonepropstatus`;
DROP PROCEDURE `cama`.`proc_repo_val_data`;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_borangc`(in p_termid int,in p_ratepayer varchar(255),in p_ratepayertype varchar(255))
BEGIN
select DATE_FORMAT((select vt_termDate from cm_appln_valterm where vt_id = p_termid), '%d/%m/%Y') vt_termDate, te_name, sum(tbbilbgn.bilbldg) bldgcount, te_id, rp_id, rp_type_id, 
sum(vt_approvednt) vt_approvednt, vt_approvedrate, sum(vt_approvedtax) vt_approvedtax
from cm_appln_valdetl
inner join (select vd_id valdetlid, (SELECT count(*) from cm_appln_bldg where ab_vd_id = vd_id) bilbldg 
from cm_appln_valdetl) tbbilbgn on valdetlid = vd_id
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_valterm on vt_id = va_vt_id
inner join cm_masterlist on vd_ma_id = ma_id
inner join cm_appln_val_tax on vt_vd_id = vd_id
inner join cm_appln_tenant on at_vd_id = vd_id
inner join cm_tenant on te_id = at_te_id
inner join cm_appln_ratepayer on arp_vd_id = vd_id
inner join cm_ratepayer on rp_id = arp_rp_id
inner join (select max(vt_termDate) termdate,  vd_ma_id, vd_accno as accountno from cm_appln_valdetl
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_valterm on vt_id = va_vt_id
where  vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = p_termid) and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = p_termid) and  vt_approvalstatus_id = '05'
and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = p_termid) and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = p_termid) and  vt_approvalstatus_id = '05')
group by vd_ma_id) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno
group by te_name, rp_applntype_id
having rp_id = p_ratepayer;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_collection_zoneandbldgcategory`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

 
 SELECT ma_subzone_id, `subzone`.`tdi_value` subzone, buildingtype.tdi_parent_name bldgcategory, count(vd_id) propcount,
sum(`vt_approvednt`) vt_approvednt, sum(`vt_approvedtax`)  vt_approvedtax FROM `cm_appln_valdetl`
inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `tbdefitems` subzone ON `cm_masterlist`.`ma_subzone_id` = `subzone`.`tdi_key` and subzone.tdi_td_name = "SUBZONE"
INNER JOIN `tbdefitems` buildingtype ON `buildingtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
 and buildingtype.tdi_td_name = "BULDINGTYPE"
 where vt_termDate <= l_termdate
group by subzone.tdi_value, buildingtype.tdi_parent_name   order by subzone.tdi_parent_name, subzone.tdi_value, buildingtype.tdi_parent_name ASC;


END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_export`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

		select ma_accno, subzone.tdi_parent_key , bldgstorey.tdi_value bldgstorey, subzone.tdi_parent_name zone, subzone.tdi_value subzone, subzone.tdi_key, vt_termDate,
		bldgstatus.tdi_value bldgstatus, bldgstatus.tdi_key, proptype.tdi_parent_name bldgcategory, proptype.tdi_value bldgtype,
		 vt_approvednt, vt_approvedrate, vt_proposednt,
		vt_proposedrate, ma_addr_ln1, ma_addr_ln2, ma_addr_ln3, ma_addr_ln4, ma_postcode, propstate.tdi_value, to_addr_ln1,to_addr_ln2,
		to_addr_ln3, to_addr_ln4, to_postcode, ownstate.tdi_value
         from cm_appln_valterm 
        inner join cm_appln_val on va_vt_id = cm_appln_valterm.vt_id
        inner join cm_appln_valdetl on vd_va_id = va_id
        inner join cm_masterlist on ma_id = vd_ma_id
		inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
        inner join cm_appln_val_tax on vt_vd_id = vd_id
        inner join cm_owner on to_ma_id = cm_masterlist.ma_id
        inner join cm_appln_lot on al_vd_id = vd_id
        left join tbdefitems  subzone
        on subzone.`tdi_key` = ma_subzone_id and  subzone.tdi_td_name = "SUBZONE"
        left join tbdefitems proptype
        on proptype.tdi_key = vd_bldgtype_id and proptype.tdi_td_name = "BULDINGTYPE"
        left join tbdefitems bldgstatus
        on bldgstatus.tdi_key = vd_ishasbuilding and bldgstatus.tdi_td_name = "ISHASBUILDING"
		left join tbdefitems bldgstorey
		on bldgstorey.tdi_key = vd_bldgstorey_id and bldgstorey.tdi_td_name = "BUILDINGSTOREY"
        left join tbdefitems propstate
        on propstate.tdi_key = ma_state_id and propstate.tdi_td_name = "STATE"
        left join tbdefitems ownstate
        on ownstate.tdi_key = TO_STATE_ID and ownstate.tdi_td_name = "STATE"
		where vt_termDate <= l_termdate;


END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_propertstatus_race`(in p_termid int)
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);


 

SET @sqlquery = CONCAT('select 
`bldg`.`tdi_value` isbldg,  race.tdi_value race, count(vd_id) propcount,
sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN cm_owner ON TO_MA_ID = temp1.MA_ID 
INNER JOIN `tbdefitems` bldg ON bldg.tdi_key = `vd_ishasbuilding` and bldg.tdi_td_name ="ISHASBUILDING" 
INNER JOIN `tbdefitems` race ON `race`.`tdi_key` = `cm_owner`.`to_race_id`  and race.tdi_td_name = "RACE"
 where vt_termDate <=   "',l_termdate,'" 
group by `bldg`.`tdi_value`, `race`.`tdi_value`  order by `bldg`.`tdi_value`  ');

PREPARE stmt FROM @sqlquery;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_propertstatus_zone`(in p_termid int, in p_propcategory int, in p_repotype varchar(10))
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

if p_repotype = 1 then
	select 
	concat(`bldg`.`tdi_value`," / " ,`buildingtype`.`tdi_parent_name`) bldgcategory, concat(zone.tdi_parent_name , " / " ,zone.tdi_value) subzone,  count(vd_id) propcount,
	sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
	FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
	on va_vt_id = vt_id 
	INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
	inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
	INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
	INNER JOIN `tbdefitems` bldg ON bldg.tdi_key = `vd_ishasbuilding` and bldg.tdi_td_name ="ISHASBUILDING" 
	INNER JOIN `tbdefitems` zone ON `zone`.`tdi_key` = ma_subzone_id  and zone.tdi_td_name = "SUBZONE"
	INNER JOIN `tbdefitems` buildingtype ON `buildingtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
	 where vt_termDate <=  l_termdate and buildingtype.tdi_parent_key = p_propcategory
	group by `zone`.`tdi_value`, `bldg`.`tdi_value`, `buildingtype`.`tdi_parent_name`  order by zone.tdi_parent_name ,`zone`.`tdi_value` ;
elseif p_repotype = 2 then
	select 
	`bldg`.`tdi_value` bldgstatus,`buildingtype`.`tdi_parent_name` bldgcategory,  count(vd_id) propcount,
	sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
	FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
	on va_vt_id = vt_id 
	INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
	inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
	INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
	INNER JOIN `tbdefitems` bldg ON bldg.tdi_key = `vd_ishasbuilding` and bldg.tdi_td_name ="ISHASBUILDING" 
	INNER JOIN `tbdefitems` buildingtype ON `buildingtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
	 where vt_termDate <=  l_termdate and buildingtype.tdi_parent_key = p_propcategory
	group by  `bldg`.`tdi_value`, `buildingtype`.`tdi_parent_name`  order by buildingtype.tdi_parent_name ;
else
	select 
	`bldg`.`tdi_value` propertystatus, concat(zone.tdi_parent_name , " / " ,zone.tdi_value) subzone,  count(vd_id) propcount,
	sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
	FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
	on va_vt_id = vt_id 
	INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
	inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
	INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
	INNER JOIN `tbdefitems` bldg ON bldg.tdi_key = `vd_ishasbuilding` and bldg.tdi_td_name ="ISHASBUILDING" 
	INNER JOIN `tbdefitems` zone ON `zone`.`tdi_key` = ma_subzone_id  and zone.tdi_td_name = "SUBZONE"
	INNER JOIN `tbdefitems` buildingtype ON `buildingtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
	 where vt_termDate <=  l_termdate and buildingtype.tdi_parent_key = p_propcategory
	group by `zone`.`tdi_value`, `bldg`.`tdi_value`  order by zone.tdi_parent_name ,`zone`.`tdi_value` ;    
    
end if;
 



END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_district`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

 
 select 
`ma_district_id` `district_id`, buildingstatus.tdi_value bldgcategory, `district`.`tdi_value` district, count(vd_id) propcount,
sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `tbdefitems` buildingstatus ON `cm_appln_valdetl`.`vd_ishasbuilding` = `buildingstatus`.`tdi_key`
 and buildingstatus.tdi_td_name = "ISHASBUILDING"
INNER JOIN `tbdefitems` district ON `cm_masterlist`.`ma_district_id` = `district`.`tdi_key` and district.tdi_td_name = 'DISTRICT'
 where vt_termDate <= l_termdate
group by ma_district_id, buildingstatus.tdi_value order by buildingstatus.tdi_value;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_propstatusvscategory`(in p_termid int, p_bldgstatus varchar(50))
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select 
`SUBZONE`.`tdi_parent_key` zoneID,
`SUBZONE`.`tdi_parent_name` zone,
`SUBZONE`.`tdi_key` subzoneID,
`SUBZONE`.`tdi_value` subzone,
`ISHASBUILDING`.`tdi_key` isbldgid,
`ISHASBUILDING`.`tdi_value` isbldg,
COUNT(IF(`BULDINGTYPE`.`tdi_parent_key` = '0', vd_accno, NULL)) AS TANAHKOSONG, 
COUNT(IF(`BULDINGTYPE`.`tdi_parent_key` = '1', vd_accno, NULL)) AS KEDIAMAN, 
COUNT(IF(`BULDINGTYPE`.`tdi_parent_key` = '2', vd_accno, NULL)) AS PERNIAGAAN, 
COUNT(IF(`BULDINGTYPE`.`tdi_parent_key` = '3', vd_accno, NULL)) AS PERINDUSTRIAN, 
COUNT(IF(`BULDINGTYPE`.`tdi_parent_key` = '4', vd_accno, NULL)) AS HARTAKHAS, 
COUNT(IF(`BULDINGTYPE`.`tdi_parent_key` = '5', vd_accno, NULL)) AS PERTIANIAN,
COUNT(vd_accno) AS TOTAL
from cm_appln_valdetl
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_valterm on vt_id = va_vt_id
inner join cm_masterlist on vd_ma_id = ma_id
inner join cm_appln_val_tax on vt_vd_id = vd_id
left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "SUBZONE") SUBZONE on SUBZONE.tdi_key = ma_subzone_id
left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "ISHASBUILDING") ISHASBUILDING on ISHASBUILDING.tdi_key = vd_ishasbuilding
left join (select tdi_key, tdi_value, tdi_parent_name, tdi_parent_key from tbdefitems where tdi_td_name = "BULDINGTYPE") BULDINGTYPE on BULDINGTYPE.tdi_key = vd_bldgtype_id
inner join (select max(vt_termDate) termdate,  vd_ma_id, vd_accno as accountno from cm_appln_valdetl
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_valterm on vt_id = va_vt_id
where  vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = p_termid) and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = p_termid)
and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = p_termid) and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = p_termid))
group by vd_ma_id) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno
GROUP BY zoneID, subzoneID, isbldgid
having  isbldgid = p_bldgstatus;

 
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_race`(in p_termid int)
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;
select 
`tbdefitems_ishasbuilding`.`tdi_value` `bldgstatus`, `tbdefitems_bldgtype`.`tdi_parent_name` bldgcategory,  sum(1) TOTAL,

COUNT(IF(`race`.`tdi_key` = '01', vd_accno, NULL)) AS MELAYU,

COUNT(IF(`race`.`tdi_key` = '02', vd_accno, NULL)) AS CINA,

COUNT(IF(`race`.`tdi_key` = '03', vd_accno, NULL)) AS INDIA,

COUNT(IF(`race`.`tdi_key` = '10', vd_accno, NULL)) AS SYAIKAT,

COUNT(IF(`race`.`tdi_key` = '99', vd_accno, NULL)) AS LAINLAIN
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN cm_owner ON TO_MA_ID = MA_ID 
INNER JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
INNER JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
INNER JOIN `tbdefitems` race ON `race`.`tdi_key` = `cm_owner`.`to_race_id`  and race.tdi_td_name = "RACE"
inner join (select max(vt_termDate) termdate,  vd_ma_id, vd_accno as accountno from cm_appln_valdetl
inner join cm_appln_val on va_id = vd_va_id
inner join cm_appln_valterm on vt_id = va_vt_id
where  vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = p_termid) and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = p_termid)
and vd_accno NOT IN (select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
inner join cm_appln_valterm on cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_termDate <=(select vt_termDate from cm_appln_valterm where vt_id = p_termid) and vt_applicationtype_id = (select vt_applicationtype_id from cm_appln_valterm where vt_id = p_termid))
group by vd_ma_id) active_term on active_term.termdate = vt_termDate and active_term.accountno = cm_appln_valdetl.vd_accno
group by `tbdefitems_ishasbuilding`.`tdi_value`, race.tdi_value;

 
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_racepropstatus`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);


SET @sql = NULL;
SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT(
      'count(case when race.tdi_value = ''',
      race.tdi_value,
      ''' then 1 end) AS ',
      replace(race.tdi_value, '-', '')
    )
  ) INTO @sql
from tbdefitems race where   race.tdi_td_name = "RACE";



SET @sqlquery = CONCAT('select 
`tbdefitems_ishasbuilding`.`tdi_value` `bldgstatus`, tbdefitems_bldgtype.tdi_parent_name bldgcategory,   ', @sql, ', sum(1) TOTAL 
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN cm_owner ON TO_MA_ID = MA_ID 
INNER JOIN `tbdefitems_ishasbuilding` ON `cm_appln_valdetl`.`vd_ishasbuilding` = `tbdefitems_ishasbuilding`.`tdi_key`
INNER JOIN `tbdefitems_bldgtype` ON `tbdefitems_bldgtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id` 
INNER JOIN `tbdefitems` race ON `race`.`tdi_key` = `cm_owner`.`to_race_id`  and race.tdi_td_name = "RACE"
where vt_termDate <= "',l_termdate ,'"
group by `tbdefitems_ishasbuilding`.`tdi_value`, tbdefitems_bldgtype.tdi_parent_name limit 10');
 PREPARE stmt FROM @sqlquery;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_subzone`(in p_termid int)
BEGIN
DECLARE l_termdate date;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;
 
 DROP table IF EXISTS mytempAA;
 
CREATE TEMPORARY TABLE mytempAA select vd_ma_id, vt_termDate from cm_appln_valterm
inner join cm_appln_val on va_vt_id = vt_id
inner join cm_appln_valdetl on vd_va_id = va_id  where vt_termDate <= l_termdate;


CREATE TEMPORARY TABLE mytempA select * from mytempAA
where vd_ma_id not in ( select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate) ;

CREATE TEMPORARY TABLE mytempBB
select vd_ma_id, count(vd_ma_id) billS from cm_appln_valterm
inner join cm_appln_val on va_vt_id = vt_id
inner join cm_appln_valdetl on vd_va_id = va_id
where vt_termDate <= l_termdate
GROUP BY vd_ma_id;

CREATE TEMPORARY TABLE mytempB
SELECT     vd_ma_id, MAX(vt_termDate) AS vt_termDate
		FROM         mytempA
		GROUP BY vd_ma_id;
        
CREATE TEMPORARY TABLE mytempC
SELECT     mytempB.vd_ma_id, mytempB.vt_termDate, mytempBB.billS
		FROM         mytempB INNER JOIN
                      mytempBB ON mytempB.vd_ma_id = mytempBB.vd_ma_id;

CREATE TEMPORARY TABLE mytempD
select vd_id, vd_ma_id, vt_termDate from cm_appln_valterm
inner join cm_appln_val on va_vt_id = vt_id
inner join cm_appln_valdetl on vd_va_id = va_id
where vt_termDate <= l_termdate;
                 
                 
CREATE TEMPORARY TABLE mytempE
SELECT     mytempD.vd_id,mytempD.vd_ma_id, mytempD.vt_termDate,  mytempC.billS 
FROM         mytempD INNER JOIN
mytempC ON mytempD.vd_ma_id = mytempC.vd_ma_id AND mytempD.vt_termDate = mytempC.vt_termDate INNER JOIN
mytempB ON mytempC.vd_ma_id = mytempB.vd_ma_id AND mytempC.vt_termDate = mytempB.vt_termDate;

select * from mytempE;

drop table mytempAA;
		drop table mytempA;
		drop table mytempBB;
		drop table mytempB;
		drop table mytempC;
		drop table mytempD;
		drop table mytempE;
		drop table mytempF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_zone`(in p_termid int, p_param text)
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);
set l_filtercon = "";
if p_param <> '' then
	set l_filtercon = concat(' and ', p_param);
end if;

 

SET @sqlquery = CONCAT(' select ma_subzone_id,
`tbdefitems_subzone`.`tdi_parent_name` `zone`, `tbdefitems_subzone`.`tdi_key` `subzone_id`, `tbdefitems_subzone`.`tdi_value` `subzone`, count(vd_id) propcount,
sum(`vt_approvednt`)vt_approvednt, sum(`vt_approvedtax`) vt_approvedtax
FROM `cm_appln_valdetl` inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
INNER JOIN `tbdefitems_subzone` ON `cm_masterlist`.`ma_subzone_id` = `tbdefitems_subzone`.`tdi_key`
 where vt_termDate <= "',l_termdate,'" ', l_filtercon ,'
group by `tbdefitems_subzone`.`tdi_value` order by `tbdefitems_subzone`.`tdi_parent_name`');

PREPARE stmt FROM @sqlquery;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_summary_zonepropstatus`(in p_termid int, p_param text)
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);

set l_filtercon = "";
if p_param <> '' then
	set l_filtercon = concat(' and ', p_param);
end if;

SET @sql = NULL;
SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT(
      'count(case when buildingtype.tdi_parent_name = ''',
      buildingtype.tdi_parent_name,
      ''' then 1 end) AS ',
      replace(buildingtype.tdi_parent_name, ' ', '')
    )
  ) INTO @sql
from tbdefitems buildingtype where buildingtype.tdi_td_name = "BULDINGTYPE";

SET @sqlquery = CONCAT('SELECT subzone.tdi_parent_name zone, subzone.tdi_key subzoneid, `subzone`.`tdi_value` suzbone, buildingstatus.tdi_value bldgcategory, ', @sql ,', sum(1) TOTAL FROM `cm_appln_valdetl`
inner join cm_appln_val on va_id = vd_va_id inner join cm_appln_valterm 
on va_vt_id = vt_id 
INNER JOIN `cm_masterlist` ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
INNER JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
inner join temp1 on temp1.ma_id = `cm_masterlist`.`ma_id`
INNER JOIN `tbdefitems` subzone ON `cm_masterlist`.`ma_subzone_id` = `subzone`.`tdi_key` and subzone.tdi_td_name = "SUBZONE"
INNER JOIN `tbdefitems` buildingstatus ON `cm_appln_valdetl`.`vd_ishasbuilding` = `buildingstatus`.`tdi_key`
 and buildingstatus.tdi_td_name = "ISHASBUILDING"
INNER JOIN `tbdefitems` buildingtype ON `buildingtype`.`tdi_key` = `cm_appln_valdetl`.`vd_bldgtype_id`
 and buildingtype.tdi_td_name = "BULDINGTYPE"
 where vt_termDate <= "',l_termdate ,'" ', l_filtercon ,' 
group by subzone.tdi_key, subzone.tdi_value, buildingstatus.tdi_value, subzone.tdi_parent_name   order by `subzone`.`tdi_key` ASC');

PREPARE stmt FROM @sqlquery;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
 
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_val_data`(p_param text)
BEGIN

	select  `cm_appln_valdetl`.`vd_accno`,  state.tdi_value state,  cm_masterlist.ma_postcode,
`cm_masterlist`.`ma_addr_ln1`,`cm_masterlist`.`ma_addr_ln2`, `cm_masterlist`.`ma_addr_ln3`,`cm_masterlist`.`ma_addr_ln4`, cm_masterlist.ma_city,
 `cm_appln_valdetl`.`vd_id`, `cm_masterlist`.`ma_id`,  
cm_appln_val_tax.`vt_approvednt`, cm_appln_val_tax.`vt_approvedtax`,  cm_appln_val_tax.vt_approvedrate, 
 cm_appln_lot.al_no,  lotcode.tdi_value lotcode,  DATE_FORMAT(cm_appln_valterm.vt_termDate, "%d/%m/%Y") as termDate,
 cm_owner.to_ownname, cm_owner.to_addr_ln1, cm_owner.to_addr_ln2, cm_owner.to_addr_ln3, cm_owner.to_addr_ln4, 
 cm_owner.to_postcode, cm_owner.to_city, ownstate.tdi_value ownstate
FROM  cm_appln_valdetl
inner join cm_appln_val on va_id = cm_appln_valdetl.vd_va_id  
inner join cm_appln_valterm  on cm_appln_valterm.vt_id = cm_appln_val.va_vt_id 
inner join v_activeterm on v_activeterm.accno=cm_appln_valdetl.vd_accno and v_activeterm.termdate = vt_termdate
inner JOIN (select cm_masterlist.* from `cm_masterlist` WHERE cm_masterlist.ma_accno NOT IN 
(select cm_appln_deactivedetl.dad_accno from cm_appln_deactivedetl inner join  cm_appln_deactive on cm_appln_deactivedetl.dad_da_id = cm_appln_deactive.da_id 
inner join cm_appln_valterm on  cm_appln_deactive.da_vt_id = cm_appln_valterm.vt_id where vt_approvalstatus_id = '05'))
cm_masterlist ON `cm_masterlist`.`ma_id` = `cm_appln_valdetl`.`vd_ma_id`
inner join cm_appln_lot on cm_appln_valdetl.vd_id = cm_appln_lot.al_vd_id
left join cm_owner on cm_owner.to_ma_id = cm_masterlist.ma_id
LEFT JOIN `cm_appln_val_tax` ON `cm_appln_val_tax`.`vt_vd_id` = `cm_appln_valdetl`.`vd_id`
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "LOTCODE") lotcode on lotcode.tdi_key = cm_appln_lot.al_lotcode_id
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") state on state.tdi_key = cm_masterlist.ma_state_id 
left join (select tdi_key, tdi_value from tbdefitems where tdi_td_name = "STATE") ownstate on ownstate.tdi_key = cm_owner.to_state_id 
where cm_appln_valterm.vt_termDate <= p_param;
END$$
DELIMITER ;
