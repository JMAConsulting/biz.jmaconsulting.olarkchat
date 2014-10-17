UPDATE  civicrm_option_group cog INNER JOIN civicrm_option_value cov ON cov.option_group_id = cog.id 
SET cov.is_active = 0
WHERE  cog.name = 'activity_type' AND cov.name = 'Chat Activity';

UPDATE civicrm_option_value cov
INNER JOIN civicrm_option_group cog ON cog.id = cov.option_group_id
SET cov.is_active = 0,
cog.is_active = 0
WHERE cog.name = 'olark_secret' AND cov.name = 'Secret Code';