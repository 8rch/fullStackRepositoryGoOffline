INSERT INTO public.migration ("version",apply_time) VALUES
	 ('m000000_000000_base',1617646445),
	 ('m140608_173539_create_user_table',1617646447),
	 ('m140611_133903_init_rbac',1617646447),
	 ('m140808_073114_create_auth_item_group_table',1617646447),
	 ('m140809_072112_insert_superadmin_to_user',1617646448),
	 ('m140809_073114_insert_common_permisison_to_auth_item',1617646448),
	 ('m141023_141535_create_user_visit_log',1617646449),
	 ('m141116_115804_add_bind_to_ip_and_registration_ip_to_user',1617646449),
	 ('m141121_194858_split_browser_and_os_column',1617646449),
	 ('m141201_220516_add_email_and_email_confirmed_to_user',1617646449);
INSERT INTO public.migration ("version",apply_time) VALUES
	 ('m141207_001649_create_basic_user_permissions',1617646450),
	 ('m141207_001650_create_basic_user_permissions_2',1617646450),
	 ('m141207_001651_create_basic_user_permissions_3',1617646450),
	 ('m210121_021148_create_period_table',1617646457),
	 ('m210121_021149_create_user_period_table',1617646457),
	 ('m210121_022631_create_pensum_table',1617646457),
	 ('m210121_022909_create_career_subject_table',1617646457),
	 ('m210121_023108_create_pensum_career_subject_table',1617646457),
	 ('m210121_023923_create_school_year_table',1617646457),
	 ('m210121_024203_add_school_year_column_to_pensum_career_subject_table',1617646458);
INSERT INTO public.migration ("version",apply_time) VALUES
	 ('m210121_024854_create_module_table',1617646458),
	 ('m210121_134358_create_topic_table',1617646458),
	 ('m210121_134742_create_content_topic_table',1617646458),
	 ('m210121_135946_add_module_column_to_pensum_career_subject',1617646458),
	 ('m210122_163049_add_period_column_to_user_period_table',1617646458),
	 ('m210124_154725_add_module_column_to_topic_table',1617646458),
	 ('m210124_161325_create_questionnaire_table',1617646458),
	 ('m210124_162838_create_answer_questionnaire_table',1617646459),
	 ('m210124_162839_insert_mock_data_qa_1',1617646459),
	 ('m210125_130101_create_geo_user_data_table',1617646459);
INSERT INTO public.migration ("version",apply_time) VALUES
	 ('m210227_030955_alter_pensum_career_subject_table',1617646460),
	 ('m210227_032220_alter_topic_table',1617646460),
	 ('m210227_033334_create_academic_planning_table',1617646460),
	 ('m210227_164252_alter_academic_planning_table',1617646461),
	 ('m210302_013658_insert_mock_data_2',1617646461),
	 ('m210321_135810_alter_answer_questionnaire_table',1617646461),
	 ('m210321_143656_alter_answer_questionnaire_table',1617646461),
	 ('m210321_214927_alter_answer_questionnaire_table',1617646461),
	 ('m210325_131439_create_params_table',1617646461),
	 ('m210325_131600_insert_params_data',1617646461);
INSERT INTO public.migration ("version",apply_time) VALUES
	 ('m210325_131841_alter_answer_questionnaire_table',1617646461),
	 ('m210328_190941_create_pensum_function',1617647044),
	 ('m210331_014956_alter_questionnaire_table',1617647044),
	 ('m210402_142953_create_get_questionnaire_function',1617647044),
	 ('m210402_173536_create_filtered_pensum_function',1617647044),
	 ('m210403_002116_create_filtered_questionnaire_function',1617647044),
	 ('m210403_004021_create_get_topic_function',1617647044),
	 ('m210403_004316_create_get_topic_filtered_function',1617647095);