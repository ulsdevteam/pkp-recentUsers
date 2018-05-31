<?php

/**
 * @defgroup plugins_generic_recentUsers
 */
 
/**
 * @file plugins/generic/recentUsers/index.php
 *
 * Copyright (c) 2018 University of Pittsburgh
 * Distributed under the GNU GPL v2 or later. For full terms see the LICENSE file.
 *
 * @ingroup plugins_generic_recentUsers
 * @brief Wrapper for RecentUsers plugin.
 *
 */

require_once('RecentUsersPlugin.inc.php');

return new RecentUsersPlugin();

?>
