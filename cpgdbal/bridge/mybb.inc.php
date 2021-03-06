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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/bridge/mybb.inc.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (isset($bridge_lookup)) {
    $default_bridge_data[$bridge_lookup] = array(
        'full_name' => 'MyBB 1.02',
        'short_name' => 'mybb',
        'support_url' => 'http://www.mybboard.com/',
        'full_forum_url_default' => 'http://www.yoursite.com/board',
        'full_forum_url_used' => 'mandatory,not_empty,no_trailing_slash',
        'relative_path_to_config_file_default' => '../board/inc',
        'relative_path_to_config_file_used' => 'lookfor,config.php',
        'use_post_based_groups_default' => '0',
        'use_post_based_groups_used' => 'radio,1,0',
    );
} else {

	// Switch that allows overriding the bridge manager with hard-coded values
	define('USE_BRIDGEMGR', 1);

    require_once 'bridge/udb_base.inc.php';

    class cpg_udb extends core_udb {

    	function cpg_udb()
    	{
    		global $BRIDGE;
            global $CONFIG;
            ###################       DB       #################
            $cpgdb =& cpgDB::getInstance();
            $cpgdb->connect_to_existing($CONFIG['LINK_ID']);
            ##########################################
    		
    		if (!USE_BRIDGEMGR) { // the vars that are used when bridgemgr is disabled

    			// URL of your punbb
    			$this->boardurl = 'http://localhost/mybb';

    			// local path to your punbb config file
    			require_once('../mybb/inc/config.php');
    			
    			$this->use_post_based_groups = 1;

    		} else { // the vars from the bridgemgr
    			$this->boardurl = $BRIDGE['full_forum_url'];
    			require_once($BRIDGE['relative_path_to_config_file'] . 'config.php');
    			$this->use_post_based_groups = $BRIDGE['use_post_based_groups'];
    		}
    		
    		$this->multigroups = 0;
    		$this->group_overrride = 0;
    		
    		// Database connection settings
    		$this->db = array(
    			'name' => $config['database'],
    			'host' => $config['hostname'],
    			'user' => $config['username'],
    			'password' => $config['password'],
    			'prefix' =>$config['table_prefix']
    		);
    		
    		// Board table names
    		$this->table = array(
    			'users' => 'users',
    			'groups' => 'usergroups',
    			'sessions' => 'sessions',
    		);

    		// Derived full table names
    		/* $this->usertable = '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['users'];
    		$this->groupstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['groups'];
    		$this->sessionstable =  '`' . $this->db['name'] . '`.' . $this->db['prefix'] . $this->table['sessions']; */
            ######################################              DB          ####################################
            $this->usertable = $cpgdb->getFullTableNames($this->db['name'], $this->db['prefix'], $this->table['users']);
            $this->groupstable = $cpgdb->getFullTableNames($this->db['name'], $this->db['prefix'], $this->table['groups']);
            $this->sessionstable = $cpgdb->getFullTableNames($this->db['name'], $this->db['prefix'], $this->table['sessions']);
            ######################################################################################
    		
    		// Table field names
    		$this->field = array(
    			'username' => 'username', // name of 'username' field in users table
    			'user_id' => 'uid', // name of 'id' field in users table
    			'password' => 'loginkey', // name of 'password' field in users table
    			'email' => 'email', // name of 'email' field in users table
    			'regdate' => 'regdate', // name of 'registered' field in users table
    			'location' => "''", // name of 'location' field in users table
    			'website' => 'website', // name of 'website' field in users table
    			'usertbl_group_id' => 'usergroup', // name of 'group id' field in users table
    			'grouptbl_group_id' => 'gid', // name of 'group id' field in groups table
    			'grouptbl_group_name' => 'title' // name of 'group name' field in groups table
    		);
    		
    		// Pages to redirect to
    		$this->page = array(
    			'register' => '/member.php?action=register',
    			'editusers' => '/memberlist.php',
    			'edituserprofile' => "/member.php?action=profile&uid="
    		);
    		
    		// Group ids
    		$this->admingroups = array(4);
    		$this->guestgroup = $this->use_post_based_groups ? 101 : 3;
    		
    		// Connect to db
    		$this->connect();
    	}

    	// definition of how to extract id, name, group from a session cookie
    	function session_extraction()
    	{
            ##########     DB    ###########
            $cpg_db_mybb_inc;
            ##########################
    		$superCage = Inspekt::makeSuperCage();
    		//if (!isset($_COOKIE['sid'])) return false;
    		if (!$superCage->cookie->keyExists('sid')) return false;
    	
    		//$this->sid = addslashes($_COOKIE['sid']);
    		$this->sid = $superCage->cookie->getEscaped('sid');
    		
    		if (!$this->sid) return false;
    		
    		$this->ipaddress = $this->getip();
    		
    		/* $result = cpg_db_query("SELECT u.{$this->field['user_id']}, u.{$this->field['password']} FROM {$this->sessionstable} AS s INNER JOIN {$this->usertable} AS u ON u.uid = s.uid WHERE sid='".$this->sid."' AND ip='".$this->ipaddress."'", $this->link_id);
    		
    		if (!mysql_num_rows($result)) return false;
    		
    		$row = mysql_fetch_row($result); */
            ########################################          DB         #######################################
            $this->cpgudb->query($cpg_db_mybb_inc['session_extract'], $this->field['user_id'], $this->field['password'], 
                        $this->sessionstable, $this->usertable, $this->sid, $this->ipaddress);

            $rowset = $this->cpgudb->fetchRowSet();
            if (!count($rowset)) return false;

            $row = $rowset[0];
            ########################################################################################

    		return $row; 
    	}
    	
    	// definition of how to extract an id and password hash from a cookie
    	function cookie_extraction()
    	{
    		$superCage = Inspekt::makeSuperCage();
    		//return  isset($_COOKIE['mybbuser']) ? array_map('addslashes', explode("_", $_COOKIE['mybbuser'], 2)) : false;
    		return  $superCage->cookie->keyExists('mybbuser') ? array_map('addslashes', explode("_", $superCage->cookie->getRaw('mybbuser'), 2)) : false;
    	}
    	
    	// imported function
    	function getip() {
    		global $hdr_ip;
    		/*if($_SERVER['HTTP_X_FORWARDED_FOR'])
    		{
    			if(preg_match_all("#[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}#s", $_SERVER['HTTP_X_FORWARDED_FOR'], $addresses))
    			{
    				while(list($key, $val) = each($addresses[0]))
    				{
    					if(!preg_match("#^(10|172\.16|192\.168)\.#", $val))
    					{
    						$ip = $val;
    						break;
    					}
    				}
    			}
    		}
    		if(!$ip)
    		{
    			if($_SERVER['HTTP_CLIENT_IP'])
    			{
    				$ip = $_SERVER['HTTP_CLIENT_IP'];
    			}
    			else
    			{
    				$ip = $_SERVER['REMOTE_ADDR'];
    			}
    		}*/
    		return $hdr_ip;
    	}

    	// definition of actions required to convert a password from user database form to cookie form
    	function udb_hash_db($password)
    	{
    		return $password;
    	}
    	
    	// Login
    	function login_page()
    	{
    		$this->redirect('/member.php?action=login');
    	}

    	// Logout
    	function logout_page()
    	{
    		$this->redirect('/member.php?action=logout&uid=' . USER_ID . '&sid=' . $this->sid);
    	}
    	
    	function view_users()
    	{
    		if (!$this->use_post_based_groups) $this->redirect($this->page['editusers']);
    	}
    	
    	function get_users($options = array())
        {
        }
    	
    	function view_profile($uid)
    	{
    	}
    }

    // and go !
    $cpg_udb = new cpg_udb;
}
?>