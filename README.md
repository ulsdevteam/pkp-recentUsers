# RecentUsers plugin for OJS

This plugin provides options for Journal Managers to browse users by recent activity: registration date, last login, last emailed, last validated.

## Requirements

* OJS 2.4.9 or later 2.x release (or, OJS 2.4.8 + [ojs#1994](https://github.com/pkp/ojs/pull/1994))
* PHP 5.3 or later

## Installation

Install this as a "generic" plugin in OJS.  To install manually via the filesystem, extract the contents of this archive to a "recentUsers" directory under "plugins/generic" in your OJS root.  To install via Git submodule, target that same directory path: `git submodule add https://github.com/ulsdevteam/pkp-recentUsers plugins/generic/recentUsers` and `git submodule update --init --recursive plugins/generic/recentUsers`.  Run the upgrade script to register this plugin, e.g.: `php tools/upgrade.php upgrade`

## Configuration

No configuration is necessary after enabling this module.

## Usage

Once enabled, the journal manager can navivate to the Users section of the Journal Management page, and there will be new options to browse users in order by date.

## Author / License

Written by Clinton Graham for the [University of Pittsburgh](http://www.pitt.edu).  Copyright (c) University of Pittsburgh.

Released under a license of GPL v2 or later.
