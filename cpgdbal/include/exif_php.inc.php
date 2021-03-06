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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/include/exif_php.inc.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/



if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

define("EXIF_CACHE_FILE","exif.dat");
require("include/exif.php");

function exif_parse_file($filename)
{
        global $CONFIG, $lang_picinfo;
		#################        DB        ##################
		global $cpg_db_exif_php_inc;
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
		############################################

        //String containing all the available exif tags.
        $exif_info = "AFFocusPosition|Adapter|ColorMode|ColorSpace|ComponentsConfiguration|CompressedBitsPerPixel|Contrast|CustomerRender|DateTimeOriginal|DateTimedigitized|DigitalZoom|DigitalZoomRatio|ExifImageHeight|ExifImageWidth|ExifInteroperabilityOffset|ExifOffset|ExifVersion|ExposureBiasValue|ExposureMode|ExposureProgram|ExposureTime|FNumber|FileSource|Flash|FlashPixVersion|FlashSetting|FocalLength|FocusMode|GainControl|IFD1Offset|ISOSelection|ISOSetting|ISOSpeedRatings|ImageAdjustment|ImageDescription|ImageSharpening|LightSource|Make|ManualFocusDistance|MaxApertureValue|MeteringMode|Model|NoiseReduction|Orientation|Quality|ResolutionUnit|Saturation|SceneCaptureMode|SceneType|Sharpness|Software|WhiteBalance|YCbCrPositioning|xResolution|yResolution";

        if (!is_readable($filename)) return false;

        $size = cpg_getimagesize($filename);
        if ($size[2] != 2) return false; // Not a JPEG file

        $exifRawData = explode ("|",$exif_info);
        $exifCurrentData = explode("|",$CONFIG['show_which_exif']);

        //Let's build the string of current exif values to be shown
        $showExifStr = "";
        foreach ($exifRawData as $key => $val) {
          if ($exifCurrentData[$key] == 1) {
            $showExifStr .= "|".$val;
          }
        }

        //Check if we have the data of the said file in the table
        /*$sql = "SELECT * FROM {$CONFIG['TABLE_EXIF']} ".
                  "WHERE filename = '".addslashes($filename)."'";

        $result = cpg_db_query($sql);

        if (mysql_num_rows($result) > 0){
                $row = mysql_fetch_array($result);
                mysql_free_result($result);
                $exifRawData = unserialize($row["exifData"]);
	}	*/
		########################		DB		########################
		$cpgdb->query($cpg_db_exif_php_inc['check_exif_data'], addslashes($filename));
		$rowset = $cpgdb->fetchRowSet();
		if (count($rowset) > 0) {
			$row = $rowset[0];
			$cpgdb->free();
			$exifRawData = unserialize($row["exifData"]);
		}	
		############################################################
		else 
		{ // No data in the table - read it from the image file
          // Get the file name
          $file = basename($filename);
          // Get the path
          $path = dirname($filename);
          // Path to original file (without watermark)
          $orig_file = $path.'/'.$CONFIG['orig_pfx'].$file;

          // Check whether original file exists
          if (file_exists($orig_file)) {
            // If original file is there then read exif data from it.
            $exifRawData = read_exif_data_raw($orig_file,0);
          } else {
            $exifRawData = read_exif_data_raw($filename,0);
          }

          // Insert it into table for future reference
          /*$sql = "INSERT INTO {$CONFIG['TABLE_EXIF']} ".
                    "VALUES ('".addslashes($filename)."', '".addslashes(serialize($exifRawData))."')";

          $result = cpg_db_query($sql);	*/
		  ##################################################################
		  $cpgdb->query($cpg_db_exif_php_inc['add_exif_data'], addslashes($filename), addslashes(serialize($exifRawData)));
		  ##################################################################################
        }

        $exif = array();

        if (is_array($exifRawData['IFD0'])) {
          $exif = array_merge ($exif,$exifRawData['IFD0']);
        }
        if (is_array($exifRawData['SubIFD'])) {
          $exif = array_merge ($exif,$exifRawData['SubIFD']);
        }
        if (is_array($exifRawData['SubIFD']['MakerNote'])) {
          $exif = array_merge ($exif,$exifRawData['SubIFD']['MakerNote']);
        }

        $exif['IFD1OffSet'] = $exifRawData['IFD1OffSet'];

        $exifParsed = array();

        foreach ($exif as $key => $val) {
          if (strpos($showExifStr,"|".$key) && isset($val)){
                $exifParsed[$lang_picinfo[$key]] = $val;
                //$exifParsed[$key] = $val;
          }
        }

        ksort($exifParsed);

        return $exifParsed;
}
?>
