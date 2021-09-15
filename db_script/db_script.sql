DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_repo_propertstatus_zone`(in p_termid int)
BEGIN
DECLARE l_termdate date;
DECLARE l_filtercon text;

select vt_termDate into l_termdate from cm_appln_valterm where vt_id = p_termid;

drop table if exists temp1;
CREATE TEMPORARY TABLE temp1 select ma_id from cm_masterlist where ma_id not in (select vd_ma_id from cm_appln_deactive
inner join cm_appln_valterm on da_vt_id = vt_id
inner join cm_appln_deactivedetl on dad_da_id = da_id
inner join cm_appln_valdetl on vd_ma_id = dad_ma_id where vt_termDate <= l_termdate);


 
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
 where vt_termDate <=  l_termdate
group by `zone`.`tdi_value`, `bldg`.`tdi_value`, `buildingtype`.`tdi_parent_name`  order by zone.tdi_parent_name ,`zone`.`tdi_value` ;


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
