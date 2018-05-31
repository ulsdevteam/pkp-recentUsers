<?php

/**
 * @file plugins/generic/recentUsers/RecentUsersPlugin.inc.php
 *
 * Copyright (c) 2018 University of Pittsburgh
 * Distributed under the GNU GPL v2 or later. For full terms see the LICENSE file.
 *
 * @class RecentUsersPlugin
 * @ingroup plugins_generic_recentUsers
 *
 * @brief RecentUsers plugin class
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class RecentUsersPlugin extends GenericPlugin {
	
	/**
	 * @var dataUserSetting string Name of User Setting to store RecentUsers data
	 */
	var $recentUserOptions = array(
		'registered' => 'plugins.generic.recentUsers.registered',
		'login' => 'plugins.generic.recentUsers.login',
		'emailed' => 'plugins.generic.recentUsers.emailed',
		'validated' => 'plugins.generic.recentUsers.validated',
	);

	/**
	 * Called as a plugin is registered to the registry
	 * @param $category String Name of category plugin was registered to
	 * @return boolean True iff plugin initialized successfully; if false,
	 * 	the plugin will not be registered.
	 */
	function register($category, $path) {
		$success = parent::register($category, $path);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
		if ($success && $this->getEnabled()) {
			// Add links for recent users
			HookRegistry::register('Templates::Manager::Index::Users', array($this, 'displayManagerLink'));
		}
		return $success;
	}
	
	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.generic.recentUsers.displayName');
	}

	/**
	 * Get a description of the plugin.
	 * @return String
	 */
	function getDescription() {
		return __('plugins.generic.recentUsers.description');
	}

	/**
	 * Set the page's breadcrumbs, given the plugin's tree of items
	 * to append.
	 * @param $isSubclass boolean
	 */
	function setBreadcrumbs($isSubclass = false) {
		$templateMgr =& TemplateManager::getManager();
		$pageCrumbs = array(
			array(
				Request::url(null, 'user'),
				'navigation.user'
			),
			array(
				Request::url(null, 'manager'),
				'user.role.manager'
			)
		);
		if ($isSubclass) {
			$pageCrumbs[] = array(
				Request::url(null, 'manager', 'plugins'),
				'manager.plugins'
			);
			$pageCrumbs[] = array(
				Request::url(null, 'manager', 'plugins', 'generic'),
				'plugins.categories.generic'
			);
		}

		$templateMgr->assign('pageHierarchy', $pageCrumbs);
	}


	/**
	 * Display verbs for the management interface.
	 * @return array of verb => description pairs
	 */
	function getManagementVerbs() {
		$verbs = array();
		return parent::getManagementVerbs($verbs);
	}
	
	/**
	 * Display management links
	 * @param $hookName string
	 * @param $params array
	 */
	function displayManagerLink($hookName, $params) {
		if ($this->getEnabled()) {
			$smarty =& $params[1];
			$output =& $params[2];
			foreach ($this->recentUserOptions as $k => $v) {
				$url = array(
					'page' => 'manager',
					'op' => 'people',
					'path' => 'all',
					'params' => array(
						'sort' => $k,
						'sortDirection' => SORT_DIRECTION_DESC
					),
				);
				$output .= '<li><a href="'.$smarty->smartyUrl($url, $smarty).'">'.__($v).'</a></li>'."\n";
			}
		}
		return false;
	}

}
?>
