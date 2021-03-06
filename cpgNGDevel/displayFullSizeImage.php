<?php
/**
 * $Id$
 */
define('IN_COPPERMINE', true);
define('DISPLAYIMAGE_PHP', true);
define('INDEX_PHP', true);
//define('SMILIES_PHP', true);

require('include/init.inc.php');
require_once('classes/cpgAlbumData.class.php');
require_once('classes/cpgTemplate.class.php');

$t = cpgTemplate::getInstance();
$picData = new cpgAlbumData;

if (isset($_GET['picfile'])) {
  if (!GALLERY_ADMIN_MODE) cpgUtils::cpgDie(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

  $picfile = $_GET['picfile'];
  $picname = $config->conf['fullpath'] . $picfile;
  $imagesize = @getimagesize($picname);
  $t->assign('picUrl', cpgUtils::path2url($picname));
  $t->assign('imagesize', $imagesize[3]);
  $t->assign('picTitle', $picfile."\n".$lang_fullsize_popup['click_to_close']);
} elseif (isset($_GET['pid'])) {
  $pid = (int)$_GET['pid'];
  $sql = "SELECT * " . "FROM {$config->conf['TABLE_PICTURES']} " . "WHERE pid='$pid' $ALBUM_SET";

  $db->query($sql);
  if (!$db->nf()) {
    cpgUtils::cpgDie(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
  }

  $row = $db->fetchRow();
  $picUrl = $picData->__getPicUrl($row, 'fullsize');
  $geom = 'width="' . $row['pwidth'] . '" height="' . $row['pheight'] . '"';
  $t->assign('picUrl', $picUrl);
  $t->assign('imagesize', $geom);
  $t->assign('picTitle', htmlspecialchars($row['filename'])."\n".$lang_fullsize_popup['click_to_close']);
} else {
  cpgUtils::cpgDie(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
}
$t->assign('CONTENT', $t->fetchHTML('common/displayFullSizeImage.html'));
$t->assign('theme', $config->conf['theme']);

/**
 * Cleanup connections, freeze objects in session, set user cookie.
 */
include ('include/cleanUp.inc.php');

/**
 * Using print $t->fetchHTML() instead of $t->display() so that fallback for popup.html can be implemented.
 */
print $t->fetchHTML('common/popup.html');
?>