<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/addpic.php $
  $Revision: 5126 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-17 13:10:13 +0530 (Fri, 17 Oct 2008) $
**********************************************/

/**
* Coppermine Photo Gallery addpic.php
*
* This file file gets called in the img src when you do batch add, there is nothing
* much to look here the grunt work is done by the function add_picture
*
* @copyright 2002-2006 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version $Id: addpic.php 5126 2008-10-17 07:40:13Z gaugau $
*/

/**
* @ignore
*/
define('IN_COPPERMINE', true);

define('ADDPIC_PHP', true);

require('include/init.inc.php');
require('include/picmgmt.inc.php');

/**
 * Clean up GPC and other Globals here
 */
$aid = $superCage->get->getInt('aid');

if (!GALLERY_ADMIN_MODE) die('Access denied');

/**
 * TODO: $_GET['pic_file'] cannot be cleaned sensibly with current methods available. Refactor.
 */
$matches = $superCage->get->getMatched('pic_file','/^[0-9A-Za-z=\+\/]+$/');
$pic_file = base64_decode($matches[0]);
$dir_name = dirname($pic_file) . '/';
$file_name = basename($pic_file);

# Create the holder $picture_name by translating the file name.
# Translate any forbidden character into an underscore.
$sane_name = replace_forbidden($file_name);
$source = './'.$CONFIG['fullpath'].$dir_name.$file_name;
rename($source, './' . $CONFIG['fullpath'] . $dir_name . $sane_name);
/*$sql = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE filepath='" . addslashes($dir_name) . "' AND filename='" . addslashes($file_name) . "' LIMIT 1";
$result = cpg_db_query($sql);
if (mysql_num_rows($result)) {	*/
####################          DB        ####################
$cpgdb->query($cpg_db_addpic_php['addpic_get_pid'], addslashes($dir_name), addslashes($file_name));
$rowset = $cpgdb->fetchRowSet();
if (count($rowset)) {
#################################################
	$status = 'DUPE';
} elseif (add_picture($aid, $dir_name, $sane_name)) {
	$status = 'OK';
} else {
	$status = 'PB';
}

if (ob_get_length()) {
	ob_end_clean();
}

echo $status;

?>
