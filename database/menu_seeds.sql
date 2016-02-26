INSERT INTO `menus` VALUES (1, 0, 'Dashboard', 'dashboard', 'fa fa-dashboard', 'Backend\\DashboardController', 0, NULL, NULL);
INSERT INTO `menus` VALUES (2, 0, 'User', '#', 'fa fa-user', '#', 1, NULL, NULL);
INSERT INTO `menus` VALUES (3, 0, 'Sandbox', '#', 'fa fa-caret-square-o-right', '#', 99, NULL, NULL);
INSERT INTO `menus` VALUES (4, 3, 'Crud Example', 'crud-example', '', 'Backend\\CrudController', 1, NULL, NULL);
INSERT INTO `menus` VALUES (5, 2, 'Role ', 'role', '', 'Backend\\RoleController', 1, NULL, NULL);
INSERT INTO `menus` VALUES (6, 2, 'User', 'user', '', 'Backend\\UserController', 1, NULL, NULL);
INSERT INTO `menus` VALUES (7, 3, 'Action Management', 'action-management', '', 'Backend\\ActionController', 2, NULL, NULL);