SELECT @activityType := cog.id, @value := max(cast(value as unsigned)) + 1 FROM civicrm_option_group cog INNER JOIN civicrm_option_value cov ON cov.option_group_id = cog.id WHERE  cog.name = 'activity_type';

INSERT INTO civicrm_option_value(option_group_id, label, value, name, grouping, filter, is_default, weight, description, is_optgroup, is_reserved, is_active, component_id, visibility_id) 
VALUES (@activityType, 'Chat Activity', @value, 'Chat Activity', NULL, 0, 0, @value, 'Chat Activity', 0, 1, 1, NULL, NULL);

INSERT INTO `civicrm_option_group` (name, title, description, is_reserved, is_active)
VALUES ('olark_secret', 'Olark Secret', 'Olark Secret', '1', 1);
SET @optionGroupId := LAST_INSERT_ID();

INSERT INTO `civicrm_option_value` (`option_group_id`, `label`, `value`, `name`, `weight`, `description`) 
VALUES (@optionGroupId, 'Secret Code', SUBSTRING(MD5(RAND()) FROM 1 FOR 16), 'Secret Code', 1, 'Olark Secret Code');
       
