DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_curr_fontcolor';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_curr_fontcolor', '#bababa', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_hover_fontcolor';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_hover_fontcolor', '#166cb7', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_font_size';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_font_size', '12px', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_border_color';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_border_color', '#d0d0d0', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_border_show';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_border_show', '1', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_current';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_current', 'true', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_posttitle_maxlen';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_posttitle_maxlen', '0', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_home_display';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_home_display', 'true', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_singleblogpost_category_display';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_singleblogpost_category_display', 'true', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_homeicon';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_homeicon', '{install_uri}/1309445569_home.png', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_link_current_item';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_link_current_item', 'false', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_style';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_style', 'style/model-1/preview.png', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_fontfamily';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_fontfamily', 'arial', 'yes');

DELETE FROM `{db_prefix}options` WHERE option_name='smartBreadcrumbs_config_link_fontcolor';
INSERT INTO `{db_prefix}options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (NULL, 'smartBreadcrumbs_config_link_fontcolor', '#777777', 'yes');