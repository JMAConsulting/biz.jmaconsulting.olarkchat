UPDATE  civicrm_option_group cog INNER JOIN civicrm_option_value cov ON cov.option_group_id = cog.id 
SET cov.is_active = 0
WHERE  cog.name = 'activity_type' AND cov.name IN ('Chat Activity');

UPDATE civicrm_option_value cov
INNER JOIN civicrm_option_group cog ON cog.id = cov.option_group_id
SET cov.is_active = 0
WHERE cog.name = 'olark_secret' AND cov.name  = 'Secret Code';

UPDATE civicrm_option_group
SET is_active = 0
WHERE name = 'olark_secret';
