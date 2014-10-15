DELETE cov FROM civicrm_option_group cog INNER JOIN civicrm_option_value cov ON cov.option_group_id = cog.id WHERE  cog.name = 'activity_type' AND cov.name = 'Chat Activity';

DELETE cv, cg FROM civicrm_option_group cg INNER JOIN civicrm_option_value cv ON cg.id = cv.option_group_id WHERE cg.name = 'olark_secret';
