INSERT INTO public.auth_item (name,"type",description,rule_name,"data",created_at,updated_at,group_code) VALUES
	 ('commonPermission',2,'Common permission',NULL,NULL,1617646448,1617646448,NULL),
	 ('/*',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/serve/*',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/serve/index',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/*',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/create',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/new',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/history',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/fresh',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/mark',3,NULL,NULL,NULL,1617646449,1617646449,NULL);
INSERT INTO public.auth_item (name,"type",description,rule_name,"data",created_at,updated_at,group_code) VALUES
	 ('/migrate/to',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/redo',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/down',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/migrate/up',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/message/*',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/message/extract',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/message/config-template',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/message/config',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/help/*',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/help/usage',3,NULL,NULL,NULL,1617646449,1617646449,NULL);
INSERT INTO public.auth_item (name,"type",description,rule_name,"data",created_at,updated_at,group_code) VALUES
	 ('/help/list-action-options',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/help/list',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/help/index',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/cache/*',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/cache/flush-schema',3,NULL,NULL,NULL,1617646449,1617646449,NULL),
	 ('/cache/flush-all',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/cache/flush',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/cache/index',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/asset/*',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/asset/template',3,NULL,NULL,NULL,1617646450,1617646450,NULL);
INSERT INTO public.auth_item (name,"type",description,rule_name,"data",created_at,updated_at,group_code) VALUES
	 ('/asset/compress',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//*',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//index',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//enhanced-gii-migration',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//enhanced-gii-crud',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//enhanced-gii-model',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//extension',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//module',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//form',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//controller',3,NULL,NULL,NULL,1617646450,1617646450,NULL);
INSERT INTO public.auth_item (name,"type",description,rule_name,"data",created_at,updated_at,group_code) VALUES
	 ('//crud',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('//model',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/fixture/*',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/fixture/unload',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/fixture/load',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/gii/*',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/gii/default/*',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/gii/default/action',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/gii/default/diff',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/gii/default/preview',3,NULL,NULL,NULL,1617646450,1617646450,NULL);
INSERT INTO public.auth_item (name,"type",description,rule_name,"data",created_at,updated_at,group_code) VALUES
	 ('/gii/default/view',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/gii/default/index',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('/user-management/*',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('Admin',1,'Admin',NULL,NULL,1617646450,1617646450,NULL),
	 ('changeOwnPassword',2,'Change own password',NULL,NULL,1617646450,1617646450,'userCommonPermissions'),
	 ('/user-management/auth/change-own-password',3,NULL,NULL,NULL,1617646450,1617646450,NULL),
	 ('student',1,'Student',NULL,NULL,1617646461,1617646461,NULL);