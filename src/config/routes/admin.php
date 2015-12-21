<?php
use Avalon\Routing\Router;

Router::get('admin', '/admin', "{$ns}\\Admin\Dashboard::index");

// Settings
Router::get('admin_settings', '/admin/settings', "{$ns}\\Admin\\Settings::index");

// Projects
Router::get('admin_projects', '/admin/projects', "{$ns}\\Admin\\Projects::index");
Router::get('admin_new_project', '/admin/projects/new', "{$ns}\\Admin\\Projects::new");
Router::post('admin_create_project', '/admin/projects/new', "{$ns}\\Admin\\Projects::create");
Router::get('admin_edit_project', '/admin/projects/{id}/edit', "{$ns}\\Admin\\Projects::edit");
Router::get('admin_delete_project', '/admin/projects/{id}/delete', "{$ns}\\Admin\\Projects::delete");

// Roles
Router::get('admin_roles', '/admin/project-roles', "{$ns}\\Admin\\ProjectRoles::index");

// Users
Router::get('admin_users', '/admin/users', "{$ns}\\Admin\\Users::index");

// Groups
Router::get('admin_groups', '/admin/groups', "{$ns}\\Admin\\Groups::index");

// Plugins
Router::get('admin_plugins', '/admin/plugins', "{$ns}\\Admin\\Plugins::index");
Router::get('admin_plugins_install', '/admin/plugins/install', "{$ns}\\Admin\\Plugins::install");
Router::get('admin_plugins_uninstall', '/admin/plugins/uninstall', "{$ns}\\Admin\\Plugins::uninstall");
Router::get('admin_plugins_enable', '/admin/plugins/enable', "{$ns}\\Admin\\Plugins::enable");
Router::get('admin_plugins_disable', '/admin/plugins/disable', "{$ns}\\Admin\\Plugins::disable");

// Types
Router::get('admin_types', '/admin/types', "{$ns}\\Admin\\Types::index");

// Statuses
Router::get('admin_statuses', '/admin/statuses', "{$ns}\\Admin\\Statuses::index");

// Priorities
Router::get('admin_priorities', '/admin/priotities', "{$ns}\\Admin\\Priorities::index");

// Severities
Router::get('admin_severities', '/admin/severities', "{$ns}\\Admin\\Severities::index");