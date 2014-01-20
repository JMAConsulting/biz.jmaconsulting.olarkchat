UPDATE  civicrm_option_group cog INNER JOIN civicrm_option_value cov ON cov.option_group_id = cog.id 
SET cov.is_active = 1
WHERE  cog.name = 'activity_type' AND cov.name IN ('Chat Activity');
