﻿<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  Hacked by Tarique Sani <tarique@sanisoft.com> and Girsh Nair             //
//  <girish@sanisoft.com> see http://www.sanisoft.com/cpg/README.txt for     //
//  details                                                                  //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

// info about translators and translated language
$lang_translation_info = array(
'lang_name_english' => 'Arabic',  //the name of your language in English, e.g. 'Greek' or 'Spanish'
'lang_name_native' => 'ÚÑÈí', //the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
'lang_country_code' => 'ar', //the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
'trans_name'=> 'Waheed Alsayer', //the name of the translator - can be a nickname
'trans_email' => 'waheed@shamayel.com', //translator's email address (optional)
'trans_website' => 'http://www.shamayel.com/', //translator's website (optional)
'trans_date' => '2003-10-02', //the date the translation was created / last modified
);

$lang_charset = 'windows-1256';
$lang_text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('ÈÇíÊ', 'ß.È', 'ã.È');

// Day of weeks and months
$lang_day_of_week = array('ÇÍÏ', 'ÇËäíä', 'ËáÇËÇÁ', 'ÇÑÈÚÇÁ', 'ÎãíÓ', 'ÌãÚÉ', 'ÓÈÊ');
$lang_month = array('íäÇíÑ', 'ÝÈÑÇíÑ', 'ãÇÑÓ', 'ÇÈÑíá', 'ãÇíæ', 'íæäíæ', 'íæáíæ', 'ÇÛÓØÓ', 'ÓÈÊãÈÑ', 'ÇßÊæÈÑ', 'äæÝãÈÑ', 'ÏíÓãÈÑ');

// Some common strings
$lang_yes = 'äÚã';
$lang_no  = 'áÇ';
$lang_back = 'ÑÌæÚ';
$lang_continue = 'ÇÓÊãÑ';
$lang_info = 'ãÚáæãÇÊ';
$lang_error = 'ÎØÃ';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%B %d, %Y';
$lastcom_date_fmt =  '%d/%m/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt =  '%B %d, %Y at %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'ÕæÑ ÚÔæÇÆíÜÜÜÉ',
	'lastup' => 'ÂÎÜÜÑ ÇÖÇÝÜÜÇÊ',
        'lastalb'=> 'ÂÎÑ ÃáÈæãÇÊ Êã ÊÍÏíËåÇ',
	'lastcom' => 'ÂÎÑ ãáÇÍÙÜÜÇÊ',
	'topn' => 'ÇßËÑåÇ ãÔÇåÏÉ',
	'toprated' => 'ÇÚáÇåÇ ÊÞííãÇ',
	'lasthits' => 'ÂÎÑ ãÇ ÔæåÏ',
	'search' => 'äÊÇÆÌ ÇáÈÍÜË'
);

$lang_errors = array(
	'access_denied' => 'áíÜÓ áÏíß ÇáÕáÇÍíÉ áÏÎæá åÐå ÇáÕÝÍÉ.',
	'perm_denied' => 'áíÓ áÏíß ÇáÕáÇÍíÉ ááÞíÇã ÈÊáß ÇáÕáÇÍíÉ.',
	'param_missing' => 'áÞÏ äæÏí ÇáÈÑäÇãÌ ÈÏæä ãÊÛíÑÇÊ.',
	'non_exist_ap' => 'ÇáÃáÈæã Ãæ ÇáÕæÑÉ ÇáãÎÊÇÑÉ ÛíÑ ãæÌæÏÉ!',
	'quota_exceeded' => 'ÊÎØíÊ ÍÏæÏ ÇáÊÎÒíä<br /><br />ÇáãÓÇÍÉ ÇáãÓãæÍÉ áß [quota]K, ÕæÑß ÊÍÊá ãÓÇÍÉ [space]K, æÈÅÖÇÝÉ åÐå ÇáÕæÑÉ ÓæÝ ÊÊÎØì ÍÏæÏ ÇáÊÎÒíä ÇáãÓãæÍÉ áß.',
	'gd_file_type_err' => 'ÚäÏ ÇÓÊÚãÇá ãßÊÈÉ GD ááÈÑÇãÌ áÇ íÓãÍ ÅáÇ ÈÜãáÝÇÊ  JPEG æ PNG.',
	'invalid_image' => 'ÇáÕæÑÉ ÇáãÍãáÉ ÛíÑ ÕÇáÍÉ Çæ áã ÊÚÇáÌ ÈãßÊÈÉ GD',
	'resize_failed' => 'áã ÇÓÊØÚ Êßæíä ÇÎÊÕÇÑ ÇáÕæÑÉ Çæ ÊÕÛíÑåÇ.',
	'no_img_to_display' => 'áÇ ÊæÌÏ ÕæÑÉ ááÚÑÖ',
	'non_exist_cat' => 'ÇáÊÕäíÝ ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ',
	'orphan_cat' => 'ÊÕäíÝ áíÓ áå ÊÕäíÝ ÑÆíÓí, ÔÛá ãÏíÑ ÇáÊÕäíÝÇÊ áÚáÇÌ ÇáãÔßáÉ.',
	'directory_ro' => 'ÇáÏáíá \'%s\' ÛíÑ ÞÇÈá ááßÊÇÈÉ, áÇ ÇÓÊØíÚ ÇáÛÇÁ ÇáÕæÑÉ',
	'non_exist_comment' => 'ÇáÊÚáíÞ ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ.',
	'pic_in_invalid_album' => 'ÇáÕæÑÉ ÛíÑ ãæÌæÏÉ Ýí ÇáÇáÈæã (%s)!?',
        'banned' => 'You are currently banned from using this site.',
        'not_with_udb' => 'åÐå ÇáãíÒÉ ãÚØáÉ Ýí Coppermine áÃäåÇ ãÏãæÌÉ ãÚ ÇáãäÊÏì. ÇãÇ ãÇ ÊæÏ ÇáÞíÇã Èå ÛíÑ ãÏÚæã, Ãæ Çä ÈÑäÇãÌ ÇáãäÊÏì íÞæã ÈäÝÓ ÇáãåãÉ.',
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'ÇäÊÞá Çáì ÞÇÆãÉ ÇáÇáÈæãÇÊ',
	'alb_list_lnk' => 'ÞÇÆãÉ ÇáÇáÈæãÇÊ',
	'my_gal_title' => 'ÇäÊÞá Çáì ÇáÈæãí ÇáÎÇÕ',
	'my_gal_lnk' => 'ÇáÈæãí ÇáÎÇÕ',
	'my_prof_lnk' => 'ÊÚÑíÝí',
	'adm_mode_title' => 'ÊÍæíá Çáì æÇÌåÉ ÇáÇÏÇÑÉ',
	'adm_mode_lnk' => 'ÍÇáÉ ÇáÇÏÇÑÉ',
	'usr_mode_title' => 'ÊÍæíá Çáì æÇÌåÉ ÇáÇÓÊÚãÇá',
	'usr_mode_lnk' => 'ÍÇáÉ ÇáãÓÊÎÏã',
	'upload_pic_title' => 'ÊÍãíá ÇáÕæÑÉ Ýí ÇáÇáÈæã',
	'upload_pic_lnk' => 'ÊÍãíá ÇáÕæÑÉ',
	'register_title' => 'Êßæíä ÍÓÇÈ',
	'register_lnk' => 'ÊÓÌíá',
	'login_lnk' => 'ÏÎæá',
	'logout_lnk' => 'ÎÑæÌ',
	'lastup_lnk' => 'ÂÎÑ ÊÍãíá',
	'lastcom_lnk' => 'ÂÎÑ ÊÚáíÞÇÊ',
	'topn_lnk' => 'ÇßËÑ ÇáÕæÑ ãØÇáÚÉ',
	'toprated_lnk' => 'ÇÚáì ÇáÕæÑ ÊÞííãÇ',
	'search_lnk' => 'ÇÈÍË',
                'fav_lnk' => 'ÇáãÝÖáÉ',

);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'ÇáãæÇÝÞÉ Úáì ÇáÊÍãíá',
	'config_lnk' => 'ÊÚííÑ',
	'albums_lnk' => 'ÇáÇáÈæãÇÊ',
	'categories_lnk' => 'ÇáÊÕäíÝÇÊ',
	'users_lnk' => 'ÇáãÓÊÎÏãíä',
	'groups_lnk' => 'ãÌãæÚÇÊ',
	'comments_lnk' => 'ÊÚáíÞÇÊ',
	'searchnew_lnk' => 'ÇÖÝ ãÌãæÚÉ ãä ÇáÕæÑ',
        'util_lnk' => 'ÊÛííÑ ÞíÇÓÇÊ ÇáÕæÑ',
        'ban_lnk' => 'ãäÚ ÇáãÓÊÎÏãíä',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'ÇÎáÞ / ÇÝÑÒ ÇáÈæãÇÊí',
	'modifyalb_lnk' => 'ÊÚÏíá ÇáÈæãÇÊí',
	'my_prof_lnk' => 'ÇáãáÝ ÇáÔÎÕí',
);

$lang_cat_list = array(
	'category' => 'ÇáÊÕäíÝ',
	'albums' => 'ÇáÇáÈæãÇÊ',
	'pictures' => 'ÇáÕæÑ',
);

$lang_album_list = array(
	'album_on_page' => '%d ÇáÈæã Ýí %d ÕÝÍÉ'
);

$lang_thumb_view = array(
	'date' => 'ÇáÊÇÑíÎ',
        //Sort by filename and title
	'name' => 'ÇÓã ÇáãáÝ',
        'title' => 'ÇáÚäæÇä',
	'sort_da' => 'ÊÑÊíÈ ÊÕÇÚÏí ÍÓÈ ÇáÊÇÑíÎ',
	'sort_dd' => 'ÊÑÊíÈ ÊäÇÒáí ááÊÇÑíÎ',
	'sort_na' => 'ÊÑÊíÈ ÊÕÇÚÏí ááÇÓã',
	'sort_nd' => 'ÊÑÊíÈ ÊäÇÒáí ááÇÓã',
        'sort_ta' => 'ÊÑÊíÈ ÇáÚäæÇä ÊÕÇÚÏí',
        'sort_td' => 'ÊÑÊíÈ ÇáÚäæÇä ÊäÇÒáí',
	'pic_on_page' => '%d ÕæÑÉ Ýí %d ÕÝÍÉ/ÕÝÍÇÊ',
	'user_on_page' => '%d ãÓÊÎÏã Ýí %d ÕÝÍÉ'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'ÇáÑÌæÚ Çáì ÇáãÎÊÕÑÇÊ',
	'pic_info_title' => 'ÇÙåÑ/ÇÎÝí ãÚáæãÇÊ ÇáÕæÑ',
	'slideshow_title' => 'ÚÑÖ Âáí',
	'ecard_title' => 'ÇÑÓá ÇáÕæÑÉ ßÈÑíÏ',
	'ecard_disabled' => 'ÇáÕæÑ ÇáÈÑíÏÉ ãÚØáÉ',
	'ecard_disabled_msg' => 'áíÓ áÏíß ÇáÕáÇÍíÉ áÇÑÓÇá ÕæÑ ÈÑíÏíÉ',
	'prev_title' => 'ÇáÕæÑÉ ÇáÓÇÈÞÉ',
	'next_title' => 'ÇáÕæÑÉ ÇáÊí ÊáíåÜÇ',
	'pic_pos' => 'ÕÜæÑå %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'ÞíÜã åÐå ÇáÕæÑÉ',
	'no_votes' => '(áÇ íæÌÏ ÊÕæíÊ)',
	'rating' => '(ÇáÊÕæíÊ ÇáÍÇáí: %s / 5 ãä %s ÊÕæíÊ)',
	'rubbish' => 'ÓíÜÆÉ',
	'poor' => 'ÛíÑ ãÞÈæáÉ',
	'fair' => 'ãÞÈæáÉ',
	'good' => 'ÌíÜÏÉ',
	'excellent' => 'ããÊÜÇÒÉ',
	'great' => 'ãÐåáÜÉ',
);

// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
	INFORMATION => $lang_info,
	ERROR => $lang_error,
	CRITICAL_ERROR => 'ÎØÃ ÎØíÑ',
	'file' => 'ãáÝ: ',
	'line' => 'ÇáÓØÑ: ',
);

$lang_display_thumbnails = array(
	'filename' => 'ÇÓã ÇáãáÝ : ',
	'filesize' => 'ÇáÍÌã : ',
	'dimensions' => 'ÇáÇÈÚÇÏ : ',
	'date_added' => 'ÇÖíÝ Ýí : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s ÊÚáíÞ',
	'n_views' => '%s ãÔÇåÏÉ',
	'n_votes' => '(%s ÊÕæíÊ)'
);

// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
	'Exclamation' => 'ÊÚÌÈ',
	'Question' => 'ÇÓÊÝåÇã',
	'Very Happy' => 'ÓÚíÏ ÌÏÇ',
	'Smile' => 'ÇÈÊÓÇãÉ',
	'Sad' => 'ÍÒíä',
	'Surprised' => 'ÊÚÌÈ',
	'Shocked' => 'ãÏåæÔ',
	'Confused' => 'ãÑÊÈß',
	'Cool' => 'ÚÌíÈ',
	'Laughing' => 'íÖÍß',
	'Mad' => 'ÛÇÖÈ',
	'Razz' => 'Razz',
	'Embarassed' => 'ãÍÑÌ',
	'Crying or Very sad' => 'íÈßí Ãæ ÍÒíä ÌÏÇ',
	'Evil or Very Mad' => 'ÔíØÇäí Ãæ ÛÇÖÈ ÌÏÇ',
	'Twisted Evil' => 'Twisted Evil',
	'Rolling Eyes' => 'Úíæä ÍÇÆÑÉ',
	'Wink' => 'íÛãÒ',
	'Idea' => 'ÝßÑÉ',
	'Arrow' => 'Óåã',
	'Neutral' => 'ÚÇÏí',
	'Mr. Green' => 'Mr. Green',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'ÇäÊ ÇáÂä ÊÊÑß ÍÇáÉ ÇáÇÏÇÑÉ...',
	1 => 'ÇäÊ ÇáÂä ÊÏÎá ÍÇáÉ ÇáÇÏÇÑÉ...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'ÇáÃáÈæã ÈÍÇÌÉ Çáì ÅÓÜã !',
	'confirm_modifs' => 'åá ÃäÊ ãÊÃßøÏ Ãäøß ÊÑíÏ Úãá åÐå ÇáÊøÚÏíáÇÊ  ?',
	'no_change' => 'áã ÊÞã ÈÃí ÊÛííÑ !',
	'new_album' => 'ÇáÈÜæã ÌÏíÏ',
	'confirm_delete1' => 'åá ÃäÊ ãÊÃßÏ ááÃÛÇÁ åÐÇ ÇáÃáÈæã ?',
	'confirm_delete2' => '\nÓæÝ íÊã ÍÐÝ ÇáÕæÑ æ ÇáãáÇÍÙÇÊ !',
	'select_first' => 'ÇÏÎá ÇÓã ÇáÃáÈæã ÃæáÇð',
	'alb_mrg' => 'ÇáÊÍßã ÈÇáÃáÈæã',
	'my_gallery' => '* ãÚÑÖÜí *',
	'no_category' => '* ÇáãÚÑÖ ÛíÑ ãæÌæÏ *',
	'delete' => 'ÇáÛÜÇÁ',
	'new' => 'ÌÏíÏ',
	'apply_modifs' => 'ÇÓÊÚãá ÇáÊøÚÏíáÇÊ ',
	'select_category' => 'ÇáÕøäÝ ÇáãÎÊÇÑ ',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'ÇáãÚáæãÇÊ ÇáãØáæÈÉ ááÚãáíÉ \'%s\'áã ÊÚØì !',
	'unknown_cat' => 'ÇáÊÕäíÝ ÇáãÎÊÇÑ ÛíÑ ãÚÑæÝ',
	'usergal_cat_ro' => 'áÇíÓãÍ ÈÇáÛÇÁ ÊÕäíÝ ÇáãÓÊÎÏãíä !',
	'manage_cat' => 'ÇÏÇÑÉ ÇáÊÕäíÝÇÊ',
	'confirm_delete' => 'åá ÇäÊ ãÊÃßÏ ãä ÇáÛÇÁ åÐÇ ÇáÊÕäíÝ',
	'category' => 'ÇáÊÕäíÝ',
	'operations' => 'ÇáÚãáíÇÊ',
	'move_into' => 'ÇäÞá Çáì',
	'update_create' => 'ÊÍÏíË Ãæ Êßæíä ÊÕäíÝ',
	'parent_cat' => 'ÇáÊÕäíÝ ÇáÃÈ',
	'cat_title' => 'ÚäæÇä ÇáÊÕäíÝ',
	'cat_desc' => 'ÔÑÍ ÇáÊÕäíÝ'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'ÇáÅÚÜÜÜÏÇÏÊ',
	'restore_cfg' => 'ÊÌÇåÜá ÇáÊÛííÑÇÊ',
	'save_cfg' => 'áÍÝÜÙ ÇáÅÚÏÇÏÇÊ',
	'notes' => 'ãáÇÍÙÜÜÇÊ',
	'info' => 'ÇáãÚÜáæãÜÇÊ',
	'upd_success' => 'áÞÏ Êã ÊÍÏíË ÇáÅÚÜÏÇÏÊ',
	'restore_success' => 'Êã ÇÑÌÇÚ ÇáÇÚÏÇÏÇÊ ÇáÇÕáíÉ',
	'name_a' => 'ÊÕÇÚÏí Úáì ÇáÇÓã',
	'name_d' => 'ÊäÇÒáí Úáì ÇáÇÓã',
	'title_a' => 'ÊÕÇÚÏí Úáì ÇáÚäæÇä',
	'title_d' => 'ÊäÇÒáí Úáì ÇáÚäæÇä',
        'date_a' => 'ÊÇÑíÎ ÊÕÇÚÏí',
        'date_d' => 'ÊÇÑíÎ ÊäÇÒáí',
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'ÇÚÏÇÏÇÊ ÚÇãÉ',
	array('ÇÓã ÇáãÚÑÖ', 'gallery_name', 0),
	array('ÔÑÍ ÇáãÚÑÖ', 'gallery_description', 0),
	array('ÇáÈÑíÏ ÇáÇáßÊÑæäí áãÏíÑ ÇáãÚÑÖ', 'gallery_admin_email', 0),
	array('ÇáÚäæÇä ÇáåÏÝ áæÕáÉ \'ÑÄíÉ ÇáãÒíÏ ãä ÇáÕæÑ\' Ýí ÇáßÑæÊ', 'ecards_more_pic_target', 0),
	array('ÇááÛÉ', 'lang', 5),
	array('ÇáÓãÉ', 'theme', 6),

	'ÑÄíÉ ÇáÇáÈæã ßÞÇÆãÉ',
	array('ÚÑÖ ÇáÌÏæá ÇáÑÆíÓí áÚÑÖ ÇáÕæÑ (ÈÇáäÞÇØ Ãæ ÈÇáäÓÈÉ)', 'main_table_width', 0),
	array('ÚÏÏ ãÓÊæíÇÊ ÇáÊÕäíÝ ÇáÊí ÊÚÑÖ', 'subcat_level', 0),
	array('ÚÏÏ ÇáÇáÈæãÇÊ ÇáÊí ÊÚÑÖ', 'albums_per_page', 0),
	array('ÚÏÏ ÇáÇÚãÏÉ áÚÑÖ ÇáÇáÈæã', 'album_list_cols', 0),
	array('ÞíÇÓ ÇáÇÎÊÕÇÑ ÈÇáäÞÇØ', 'alb_list_thumb_size', 0),
	array('ãÍÊæíÇÊ ÇáÕÝÍÉ ÇáÑÆíÓíÉ', 'main_page_layout', 0),
            array('ÇÚÑÖ ãÎÊÕÑÇÊ ÇáÈæã ÇáãÓÊæì ÇáÇæá Ýí ÇáÊÕäíÝÇÊ ','first_level',1),

	'ÚÑÖ ÇáãÎÊÕÑÇÊ',
	array('ÚÏÏ ÇáÇÚãÏÉ Ýí ÕÝÍÉ ãÎÊÕÑÇÊ ÇáÕæÑ', 'thumbcols', 0),
	array('ÚÏÏ ÇáÇÓØÑ Ýí ÕÝÍÉ ãÎÊÕÑÇÊ ÇáÕæÑ', 'thumbrows', 0),
	array('ÇßÈÑ ÚÏÏ ááÕÝÍÇÊ ÇáÊí ÓÊÚÑÖ', 'max_tabs', 0),
	array('ÚÑÖ ÚäæÇä ÇáÕæÑ ÇÓÝá ÇáÕæÑÉ', 'caption_in_thumbview', 1),
	array('ÇÙåÑ ÚÏÏ ÇáÊÚáíÞÇÊ ÇÓÝá ÇáÕæÑÉ', 'display_comment_count', 1),
	array('ÇáÊÑÊíÈ ÇáÊÞáíÏí ááÕæÑ', 'default_sort_order', 3),
	array('ÇÞá ÚÏÏ ãä ÇáÊÕæíÊÇÊ áÙåæÑ ÇáÕæÑÉ Ýí ÞÇÆãÉ  \'ÇÚáì ÊÞííã\'', 'min_votes_for_rating', 0),

	'ÇÚÏÇÏÇÊ ãäÙÑ ÇáÕæÑ æÇáÊÚáíÞÇÊ',
	array('ÚÑÖ ÇáÌÏæá áÚÑÖ ÇáÕæÑ (ÈÇáäÞÇØ Ãæ ÈÇáäÓÈÉ)', 'picture_table_width', 0),
	array('ãÚáæãÇÊ ÇáÕæÑ ÊÑì ÊáÞÇÆíÇ', 'display_pic_info', 1),
	array('ÊÕÝíÉ ÇáßáãÇÊ ÇáÓíÆÉ Ýí ÇáÊÚáíÞÇÊ (Úáíß ÊÎÒíä Êáß ÇáßáãÇÊ Ýí ÇáÈÑäÇãÌ ÇæáÇ)', 'filter_bad_words', 1),
	array('ÇáÓãÇÍ ÈÇáæÌæå ÇáÖÇÍßÉ Ýí ÇáÊÚáíÞÇÊ', 'enable_smilies', 1),
	array('ÇßÈÑ Øæá áæÕÝ ÇáÕæÑÉ', 'max_img_desc_length', 0),
	array('ÇßÈÑ ÚÏÏ ãä ÇáÍÑæÝ Ýí ÇáßáãÉ', 'max_com_wlength', 0),
	array('ÇßÈÑ ÚÏÏ ãä ÇáÇÓØÑ Ýí ÇáÊÚáíÞ', 'max_com_lines', 0),
	array('ÇßÈÑ Øæá ááÊÚáíÞ', 'max_com_size', 0),
        array('ÇÙåÑ ÔÑíØ ÇáÝáã', 'display_film_strip', 1),
        array('ÚÏÏ ÇáÕæÑ Ýí ÔÑíØ ÇáÝáã', 'max_film_strip_items', 0),

	'ÇÚÏÇÏÇÊ ÇáÕæÑ æãÎÊÕÑÇÊ',
	array('æÖæÍ ÕæÑÉ Ìí ÈíÌ', 'jpeg_qual', 0),
        array('ÇßÈÑ ÞíÇÓ áãÎÊÕÑ ÇáÕæÑÉ <b>*</b>', 'thumb_width', 0),
        array('ÇÓÊÚãá ÇáÞíÇÓÇÊ (ÚÑÖ Çæ ÇÑÊÝÇÚ Ãæ ÇßÈÑ ÊÈÇÚÏ áãÎÊÕÑ ÇáÕæÑ )<b>*</b>', 'thumb_use', 7),
	array('ßæä ÕæÑ æÓíØÉ','make_intermediate',1),
	array('ÇßÈÑ ÚÑÖ Çæ ÇÑÊÝÇÚ áÕæÑÉ æÓØíÉ <b>*</b>', 'picture_width', 0),
	array('ÇßÈÑ ÍÌã áÕæÑÉ ãÍãáÉ (ÈÇáßíáæ ÈÇíÊ)', 'max_upl_size', 0),
	array('ÇßÈÑ ÚÑÖ Çæ ÇÑÊÝÇÚ áÕæÑÉ ãÍãáÉ ÈÇáäÞÇØ', 'max_upl_width_height', 0),

	'ÇÚÏÇÏÇÊ ÇáãÓÊÎÏã',
	array('ÇáÓãÇÍ áãÓÊÎÏã ÌÏíÏ ÈÇáÊÓÌíá', 'allow_user_registration', 1),
	array('ÊÓÌíá ÇáãÓÊÎÏã íÍÊÇÌ ÇáÊÃßíÏ ÈÇáÈÑíÏ ÇáÇáßÊÑæäí', 'reg_requires_valid_email', 1),
	array('ÇáÓãÇÍ áãÓÊÎÏãíä ÇËäíä Çä íßæä áåã äÝÓ ÇáÈÑíÏ ÇáÇáßÊÑæäí', 'allow_duplicate_emails_addr', 1),
	array('íãßä ááãÓÊÎÏãíä Çä íßæä áåã ÇáÈæã ÎÇÕ', 'allow_private_albums', 1),

	'ÈíÇäÇÊ ÇÖÇÝíÉ áÔÑÍ ÇáÕæÑ (ÇÊÑßå ÝÇÑÛÇ Çä ßäÊ áÇ ÊÑíÏ ÇÓÊÚãÇáå)',
	array('ÇÓã ÇáÍÞá ÇáÇæá', 'user_field1_name', 0),
	array('ÇÓã ÇáÍÞá ÇáËÇäí', 'user_field2_name', 0),
	array('ÇÓã ÇáÍÞá ÇáËÇáË', 'user_field3_name', 0),
	array('ÇÓã ÇáÍÞá ÇáÑÇÈÚ', 'user_field4_name', 0),

	'ÇÚÏÇÏÇÊ ÇáÕæÑ æãÎÊÕÑÇÊ ÇáÕæÑ ÇáãÊÞÏãÉ',
        array('ÇÙåÑ ÑãÒ ÇáÈæã ÎÇÕ ááãÓÊÎÏã ÇáãÌåæá','show_private',1),
	array('ÇáÍÑæÝ ÇáããäæÚÉ Ýí ÇÓãÇÁ ÇáãáÝÇÊ', 'forbiden_fname_char',0),
	array('ÇáÇãÊÏÇÏÇÊ ÇáãÓãæÍ ÈåÇ Ýí ÇáãáÝÇÊ ÇáãÑÓáÉ', 'allowed_file_extensions',0),
	array('ØÑíÞÉ ÇÚÇÏÉ ÞíÇÕ ÇáÕæÑÉ','thumb_method',2),
	array('ÇáÏáíá Çáì ÇÏÇÉ ImageMagick \'ááÊÍæíá\'  (ãËÇá /usr/bin/X11/)', 'impath', 0),
	array('ÇäæÇÚ ÇáÕæÑ ÇáãÓãæÍ ÈåÇ (íÓÊÚãá ÝÞØ áÜ ImageMagick)', 'allowed_img_types',0),
	array('ÇæÇãÑ ÇáÈÑäÇãÌ ImageMagick', 'im_options', 0),
	array('ÇÞÑÁ ÈíÇäÇÊ EXIF Ýí ãáÝÇÊ JPEG', 'read_exif_data', 1),
	array('Ïáíá ÇáÇáÈæã <b>*</b>', 'fullpath', 0),
	array('Ïáíá ÕæÑ ÇáãÓÊÎÏãíä <b>*</b>', 'userpics', 0),
	array('ÇáÍÑæÝ ÇáÇæáì ááÕæÑ ÇáæÓíØÉ(íÌÈ Çä Êßæä ÇäÌáíÒíÉ <b>*</b>', 'normal_pfx', 0),
	array('ÇáÍÑæÝ ÇáÇæáì áãÎÊÕÑÇÊ ÇáÕæÑ <b>*</b>', 'thumb_pfx', 0),
	array('ÇáæÖÚ ÇáÇÚÊíÇÏí ááãÌáÏÇÊ', 'default_dir_mode', 0),
	array('ÇáæÖÚ ÇáÇÚÊíÇÏí ááÕæÑ', 'default_file_mode', 0),
        array('ãä ÇáÖÛØ Úáì ÒÑ ÇáÝÃÑÉ Çáíãíä ááÕæÑ ÐÇÊ ÇáÍÌã ÇáØÈíÚí (JavaScript - ØÑíÞÉ ÌÇÝÇ ÓßÑíÈ ÇáãÊíäÉ)', 'disable_popup_rightclick', 1),
        array('ÊÚØíá ÇáÖÛØ Úáì ÒÑ ÇáÝÃÑÉ Çáíãíä Úáì ßá ÇáÕÝÍÇÊ &quot;ÇáÚÇÏíÉ&quot; (JavaScript - ØÑíÞÉ ÌÇÝÇ ÓßÑíÈÊ)', 'disable_gallery_rightclick', 1),

	'ÇÚÏÇÏÇÊ ÇáßæßíÒ æäæÚ ÇáÍÑæÝ',
	array('ÇÓã Çáßæßí ÇáãÓÊÚãá Ýí ÇáÈÑäÇãÌ', 'cookie_name', 0),
	array('Ïáíá ÇáßæßíÒ ÇáãÓÊÚãá Ýí ÇáÈÑäÇãÌ', 'cookie_path', 0),
	array('äæÚ ÇáÍÑæÝ ÇáãÓÊÚãáÉ', 'charset', 4),

	'ÇÚÏÇÏÇÊ ÇÎÑì',
	array('Êãßíä æÖÚ ÇáÊÊÈÚ', 'debug_mode', 1),

	'<br /><div align="center">(*) ÇáÈíÇäÇÊ ÇáãÄÔÑÉ ÈÇáÚáÇãÉ * íÌÈ ÚÏã ÊÛííÑåÇ Çä ßÇäÊ áÏíß ÕæÑ Ýí ÇáãÚÑÖ</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'íÌÈ Çä ÊßÊÈ ÇÓãß æÊÚáíÞß',
	'com_added' => 'Êã ÇÖÇÝÉ ÇáÊÚáíÞ',
	'alb_need_title' => 'íÌÈ Çä ÊÍÏÏ ÚäæÇä ááÇáÈæã !',
	'no_udp_needed' => 'áÇ ÍÇÌÉ ááÊÍÏíË.',
	'alb_updated' => 'Êã ÊÍÏíË ÇáÇáÈæã',
	'unknown_album' => 'ÇáÇáÈæã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ Çæ áíÓ áß ÇáÕáÇÍíÉ ááÊÍãíá Ýí åÐÇ ÇáÇáÈæã',
	'no_pic_uploaded' => 'áÇ ÊæÌÏ ÕæÑ ãÍãáÉ !<br /><br />ÇÐÇ ßäÊ ÝÚáÇ ÇÎÊÑÊ ÕæÑ ááÊÍãíá, ÊÃßÏ ãä Çä ÎÇÏã ÇáÕÝÍÇÊ íÓãÍ ÈÇáÊÍãíá...',
	'err_mkdir' => 'áã ÇÓÊØÚ Êßæíä ÇáãÌáÏ %s !',
	'dest_dir_ro' => 'æÌåÉ ÇáãáÝ %s ÛíÑ ÞÇÈá ááßÊÇÈÉ !',
	'err_move' => 'ãä ÇáãÓÊÍíá äÞá %s Çáì %s !',
	'err_fsize_too_large' => 'ÇáÕæÑ ÇáÊí ÊÑíÏ ÊÍãíáåÇ ßÈíÑÉ ÌÏÇ (ÇßÈÑ ÍÌã ááÕæÑÉ åæ %s x %s) !',
	'err_imgsize_too_large' => 'ÇáÕæÑ ÇáÊí ÊÑíÏ ÊÍãíáåÇ ßÈíÑÉ ÌÏÇ (ÇßÈÑ ÍÌã ááÕæÑÉ åæ %s KB) !',
	'err_invalid_img' => 'ÇáÕæÑÉ ÇáÊí Êã ÊÍãíáåÇ ÛíÑ ÕÇáÍÉ !',
	'allowed_img_types' => 'ÊÓÊØíÚ ÊÍãíá %s ÕæÑÉ.',
	'err_insert_pic' => 'ÇáÕæÑÉ \'%s\' áÇ íãßä ÊÎÒíåÇ Ýí ÇáÇáÈæã ',
	'upload_success' => 'Êãã ÊÍãíá ÇáÕæÑÉ ÈäÌÇÍ<br /><br />ÓæÝ ÊÑÇåÇ ÈÚÏ ãæÇÝÞÉ ÇáãÏíÑ.',
	'info' => 'ãÚáæãÇÊ',
	'com_added' => 'Êã ÇÖÇÝÉ ÇáÊÚáíÞ',
	'alb_updated' => 'Êã ÊÍÏíË ÇáÇáÈæã',
	'err_comment_empty' => 'áã ÊßÊÈ ÇáÊÚáíÞ !',
	'err_invalid_fext' => 'ÓæÝ íÓãÍ ÈÇáãáÝÇÊ ÇáÊí ÊäÊåí ÈÜ : <br /><br />%s.',
	'no_flood' => 'äÃÓÝ áßäß ÇäÊ ßäÊ ÂÎÑ ãÚáÞ Úáì åÐå ÇáÕæÑÉ<br /><br />ÊÓÊØíÚ ÊÛííÑ ÊÚáíÞß Úáì ÇáÕæÑÉ',
	'redirect_msg' => 'ÓíÊã ÊÍæáíß Çáì ÕÝÍÉ ÇÎÑì.<br /><br /><br />ÇÖÛØ Úáì  \'ÇÓÊãÜÜÑ\' Çä áã íÊã ÇÚÇÏÉ ÊäÔíØ ÇáÕÝÍÉ ÊáÞÇÆíÇ',
	'upl_success' => 'Êã ÊÍãíá ÇáÕæÑÉ ÈäÌÇÍ',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'ÇáÚäæÇä',
	'fs_pic' => 'ÕæÑÉ ÈÇáÍÌã ÇáØÈíÚí',
	'del_success' => 'Êã ÇáÛÇÁåÇ ÈäÌÇÍ',
	'ns_pic' => 'ÕæÑÉ ÈÇáÍÌã ÇáØÈíÚí',
	'err_del' => 'áÇ íãßä ÇáÛÇÁå',
	'thumb_pic' => 'ãÎÊÕÑ',
	'comment' => 'ÊÚáíÞ',
	'im_in_alb' => 'ÕæÑÉ Ýí ÇáÇáÈæã',
	'alb_del_success' => 'ÇáÇáÈæã \'%s\' Êã ÇáÛÇÁå',
	'alb_mgr' => 'ãÏíÑ ÇáÇáÈæã',
	'err_invalid_data' => 'ÈíÇäÇÊ ÛíÑ ÕÇáÍÉ Êã ÇÓÊÞÈÇáåÇ Ýí \'%s\'',
	'create_alb' => 'ÌÇÑí Êßæíä ÇáÇáÈæã \'%s\'',
	'update_alb' => 'ÌÇÑí ÊÍÏíË ÇáÇáÈæã \'%s\' ÈÇáÚäæÇä \'%s\' æÇáÝåÑÓ \'%s\'',
	'del_pic' => 'ÇáÛÇÁ ÇáÕæÑÉ',
	'del_alb' => 'ÇáÛí ÇáÇáÈæã',
	'del_user' => 'ÇáÛí ÇáãÓÊÎÏã',
	'err_unknown_user' => 'ÇáãÓÊÎÏã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ !',
	'comment_deleted' => 'Êã ÇáÛÇÁ ÇáÊÚáíÞ ÈäÌÇÍ',
);

// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
	'confirm_del' => 'åá ÃäÊ ãÊÃßÏ áÅáÛÇÁ ÇáÕæÑÉ ? \\nÓíÊã ÇáÛÇÁ ÇáÊÚáíÞÇÊ ÇíÖÇ.',
	'del_pic' => 'ÃÖÛØ áãÓÜÍ åÐå ÇáÕæÑÉ',
	'size' => '%s Ýí %s äÞØÉ',
	'views' => '%s ãÜÑÇÊ',
	'slideshow' => 'ÚÑÖ ÇáÔÑÇÆÍ',
	'stop_slideshow' => 'áÊæÞíÝ ÚÑÖ ÇáÔÑÇÆÍ',
	'view_fs' => 'ÇÖÛØ áÊßÈíÜÑ ÇáÕæÑÉ',
);

$lang_picinfo = array(
	'title' =>'ãÚáæãÇÊ Úä ÇáÕæÑÉ',
	'Filename' => 'ÇÓã ÇáãáÝ',
	'Album name' => 'ÇÓã ÇáÃáÈæã',
	'Rating' => 'ÊÞííã (%s ÊÕæíÊ)',
	'Keywords' => 'ÇáßáãÇÊ ÇáÑøÆíÓíøÉ ',
	'File Size' => 'ÍÌã ÇáãáÝ',
	'Dimensions' => 'ÇáÃÈÚÇÏ ',
	'Displayed' => 'ÚÏÏ ãÑÇÊ ÇáÅÖåÇÑ',
	'Camera' => 'ÂáÉ ÇáÊÕæíÑ',
	'Date taken' => 'ÊÇÑíÎ ÇáÊÞÇØ ÇáÕæÑÉ',
	'Aperture' => 'ÇáÚÏÓÉ ',
	'Exposure time' => 'æÞÊ ÇáÊøÚÑøÖ ',
	'Focal length' => 'ÇáÈÚÏ ÇáÈÄÑíø ',
	'Comment' => 'ãáÇÍÙÇÊ',
        'addFav'=>'ÇÖÝ Çáì ÇáãÝÖáÉ',
        'addFavPhrase'=>'ÇáãÝÖáÉ',
        'remFav'=>'ÇáÛ ãä ÇáãÝÖáÉ',
);

$lang_display_comments = array(
	'OK' => 'ÍÓäÜÇ',
	'edit_title' => 'áÊÍÜÑíÑ ÇáãáÇÍÙÇÊ',
	'confirm_delete' => 'åá ÃäÊ ãÊÃßÜÏ áÍÜÐÝ åÐå ÇáãáÇÍÙÇÊ ?',
	'add_your_comment' => 'ÃÏÎÜá ãáÇÍÙÇÊß',
        'name'=>'ÇáÇÓã',
        'comment'=>'ÊÚáíÞ',
        'your_name' => 'ãÌåæá',
);

$lang_fullsize_popup = array(
        'click_to_close' => 'ÇÖÛØ Úáì ÇáÕæÑÉ áÇÛáÇÞ ÇáäÇÝÐÉ',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'ÇÑÓÇá ßÑÊ ãÚÇíÏÉ',
	'invalid_email' => '<b>ÊäÈÜíå</b> : ÇáÈÑíÏ ÇáÇáßÊÑæäí ÎØÃ !',
	'ecard_title' => 'ßÑÊ ãä  %s áß',
	'view_ecard' => 'Çä áã íÙåÑ ÇáßÑÊ ÈÇáÕæÑÉ ÇáÕÍíÍÉ, ÇÖÛØ åäÇ',
	'view_more_pics' => 'ÇÖÛØ åäÇ áÑÄíÉ ÇáãÒíÏ ãä ÇáÕæÑ !',
	'send_success' => 'Êã ÇÑÓÇá ßÑÊß',
	'send_failed' => 'äÃÓÝ áßä ÇáÎÇÏã áÇ íÓÊØíÚ ÇÑÓÇá ÇáßÑÊ...',
	'from' => 'ãä',
	'your_name' => 'ÇÓãß',
	'your_email' => 'ÇáÈÑíÏ ÇáÃáßÊÑæäí',
	'to' => 'Çáì',
	'rcpt_name' => 'ÇÓã ÇáãÑÓá Çáíå',
	'rcpt_email' => 'ÈÑíÏ ÇáãÑÓá Çáíå ÇáÇáßÊÑæäí',
	'greetings' => 'ÇáÊÍíÉ',
	'message' => 'ÇáÑÓÇáÉ',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'ãÚáæãÇÊ ÇáÕæÑÉ',
	'album' => 'ÇáÈæã',
	'title' => 'ÚäæÇä ÇáÕæÑÉ',
	'desc' => 'ÈíÇä Úä ÇáÕæÑÉ',
	'keywords' => 'ÇáßáãÇÊ ÇáÑøÆíÓíøÉ ',
	'pic_info_str' => '%sx%s - %sßíáæÈÇíÊ - %s ãÔÇåÏÉ - %s ÊÕæíÊÇÊ',
	'approve' => 'ÇÚÊãÏ ÇáÕæÑÉ',
	'postpone_app' => 'ÊÃÌíá ÇáãæÇÝÞÉ',
	'del_pic' => 'ÇáÛÇÁ ÇáÕæÑÉ',
	'reset_view_count' => 'ãÓÍ ÇáÚÏÇÏ',
	'reset_votes' => 'ÇáÛÇÁ ÇáÊÕæíÊ',
	'del_comm' => 'ãÓÍ ÇáãáÇÍÙÇÊ',
	'upl_approval' => 'ãæÇÝÞÉ ÇáÊÍãíá',
	'edit_pics' => 'ÊÍÜÑíÑ ÇáÕæÑ',
	'see_next' => 'ÇáÕæÑ ÇáÊÇáíÜÉ',
	'see_prev' => 'ÇáÕæÑ ÇáÓÇÈÞÉ',
	'n_pic' => '%s ÇáÕÜæÑ',
	'n_of_pic_to_disp' => 'ÚÏÏ ÇáÕæÑ ÇáãÚÑæÖÉ',
	'apply' => 'ÊØÈíÞ ÇáÊÚÏíá'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'ÇÓã ÇáãÌãæÚÉ',
	'disk_quota' => 'ãÓÇÍÉ ÇáÊÎÒíä ÇáãÓãæÍÉ',
	'can_rate' => 'áÇ ÇÓÊØíÚ ÊÞííã ÇáÕæÑ',
	'can_send_ecards' => 'íÓÊØíÚ ÇÑÓÇá ÇáÕæÑÉ ßÈÑíÏ',
	'can_post_com' => 'íÓÊØíÚ ÇÖÇÝÉ ÊÚáíÞÇÊ',
	'can_upload' => 'íÓÊØíÚ ÊÍãíá ÇáÕæÑ',
	'can_have_gallery' => 'íÓÊØíÚ ÇáÍÕæá Úáì ãÚÑÖ ÔÎÕí',
	'apply' => 'ÊÎÒíä ÇáÊÚÏíáÇÊ',
	'create_new_group' => 'Êßæíä ãÌãæÚÉ ãÓÊÎÏãíä ÌÏíÏÉ',
	'del_groups' => 'ÇáÛÇÁ ÇáãÌãæÚÇÊ ÇáãÎÊÇÑÉ',
	'confirm_del' => 'ÊÍÐíÑ, ÚäÏãÇ ÊãÓÍ ãÌãæÚÉ, ÓíÊã äÞá ÇáãÓÊÎÏãíä Ýí åÐå ÇáãÌãæÚÉ Çáì ÞÇÆãÉ \'ÇáãÓÌáíä\' !\n\nåá ÊæÏ ÇÓÊßãÇá ÇáÚãáíÉ  ?',
	'title' => 'ÇÏÇÑÉ ãÌãæÚÇÊ ÇáãÓÊÎÏãíä',
	'approval_1' => 'ãæÇÝÞÉ ÊÍãíá ÚÇãÉ (1)',
	'approval_2' => 'ãæÇÝÞÉ ÊÍãíá ÚÇãÉ (2)',
	'note1' => '<b>(1)</b> ÇáÊÍãíá Ýí ÇáÇáÈæã ÇáÚÇã íÍÊÇÌ ãæÇÝÞÉ ÇáãÏíÑ',
	'note2' => '<b>(2)</b> ÇáÊÍãíáÇÊ ÇáÊí íãßáåÇ ÇáãÓÊÎÏã ÊÍÊÇÌ ãæÇÝÞÉ ÇáãÏíÑ',
	'notes' => 'ãáÇÍÙÇÊ'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'ÃåÜáÇð æÓÜåáÇð Èß íÜÇ',
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'åá ÃäÊ ãÊÃßÏ áÃáÛÇÁ åÐå ÇáÕæÑÉ ? \\nAll pictures and comments will also be deleted.',
	'delete' => 'ÇáÛÇÁ ÇáÕæÑÉ',
	'modify' => 'ÊÍÏíË ÇáÃáÈæã',
	'edit_pics' => 'ÊÍÑíÑ ÇáÕæÑÉ',
);

$lang_list_categories = array(
	'home' => 'Home',
	'stat1' => '<b>[pictures]</b> ÕæÑÉ Ýí <b>[albums]</b> ÇáÈæã æ <b>[cat]</b> ÊÕäíÝÇÊ ãÚ <b>[comments]</b> ÊÚáíÞÇÊ ÔæåÏÊ <b>[views]</b> ãÑÉ',
	'stat2' => '<b>[pictures]</b> ÕæÑÉ Ýí <b>[albums]</b> ÇáÈæã æÔæåÏÊ <b>[views]</b> ãÑÉ',
	'xx_s_gallery' => 'ãÚÑÖ %s',
	'stat3' => '<b>[pictures]</b> ÕæÑÉ Ýí <b>[albums]</b> ÇáÈæã ãÚ <b>[comments]</b> ÊÚáíÞÇÊ ÔæåÏÊ <b>[views]</b> ãÑÉ'
);

$lang_list_users = array(
	'user_list' => 'ÞÇÆãÉ ÇáãÓÊÎÏãíä',
	'no_user_gal' => 'áÇ íæÌÏ ãÓÊÎÏãíä íãßä Çä íßæä áåã ÇáÈæãÇÊ',
	'n_albums' => '%s ÇáÈæã',
	'n_pics' => '%s ÕæÑÉ/ÕæÑ'
);

$lang_list_albums = array(
	'n_pictures' => '%s ÕæÑÉ',
	'last_added' => ', ÂÎÑ ÕæÑÉ ÇÖíÝÊ Ýí %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'ÇáÏÎæá',
	'enter_login_pswd' => 'ÇÏÎá ÇáßäíÉ æßáãÉ ÇáÓÑ ááÏÎæá',
	'username' => 'ÇÓã ÇáãÊÓÎÏã',
	'password' => 'ßáãÉ ÇáÓÑ',
	'remember_me' => 'ÊÐßÑäí',
	'welcome' => 'ÇåáÇ  %s ...',
	'err_login' => '*** áã ÇÓÊØÚ ÇáÏÎæá ÍÇæá ãÑÉ ÇÎÑì ***',
	'err_already_logged_in' => 'áÞÏ Êã ÊÓÌíá ÏÎæáß ãÓÈÞÇ !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'ÎÑæÌ',
	'bye' => 'ãÚ ÇáÓáÇãÉ %s ...',
	'err_not_loged_in' => 'áã ÊÓÌá ÇáÏÎæá !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'ÊÍÏíË ÇáÇáÈæã %s',
	'general_settings' => 'ÇÚÏÇÏÇÊ ÚÇãÉ',
	'alb_title' => 'ÚäæÇä ÇáÇáÈæã',
	'alb_cat' => 'ÊÕäíÝ ÇáÇáÈæã',
	'alb_desc' => 'ÔÑÍ ÇáÇáÈæã',
	'alb_thumb' => 'äÈÐÉ ÇáÇáÈæã',
	'alb_perm' => 'ÕáÇÍíÇÊ ÇáÇáÈæã',
	'can_view' => 'ãÔÇåÏíä ÇáÇáÈæã åã',
	'can_upload' => 'ÇáÒæÇÑ íÓÊØíÚæä ÊÍãíá ÕæÑ',
	'can_post_comments' => 'ÇáÒæÇÑ íÓÊØíÚæä ÊÓÌíá ÊÚáíÞÇÊ',
	'can_rate' => 'ÇáÒæÇÑ íÓÊØíÚæä ÇáÊÞííã',
	'user_gal' => 'ÇáÈæã ÇáãÓÊÎÏãíä',
	'no_cat' => '* ÛíÑ ãÕäÝ *',
	'alb_empty' => 'ÇáÇáÈæã ÝÇÑÛ',
	'last_uploaded' => 'ÂÎÑ ÊÍãíá',
	'public_alb' => 'ááÌãíÚ (ÇáÈæã ÚÇã)',
	'me_only' => 'áí ÝÞØ',
	'owner_only' => 'ãÇáß ÇáÇáÈæã (%s) ÝÞØ',
	'groupp_only' => 'ÇÚÖÇÁ ÇáãÌãæÚÉ \'%s\'',
	'err_no_alb_to_modify' => 'áÇ íæÌÏ ÇáÈæã ÊÓÊØíÚ ÊÚÏíáå Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ.',
	'update' => 'ÊÍÏíË ÇáÇáÈæã'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'äÃÓÝ áßä ßäÊ ÞÏ ÞíãÊ åÐå ÇáÕæÑÉ ãÓÈÞÇ',
	'rate_ok' => 'Êã ÞÈæá ÊÞííãß',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
ÍíË Çä ãÏÑÇÁ ÇáãæÞÚ {SITE_NAME} ÓíÞæãæä ÈÊÚÏíá Çæ ÇáÛÇÁ ÇáÕæÑ ÇáÛíÑ ãÑÛæÈ ÝíåÇ, Ýãä ÇáÕÚÈ ãÑÇÌÚÉ ÌãíÚ ÇáÕæÑ. áÐÇ íÌÈ Úáíß ÇáÚáã Çä ÇáÕæÑ ÊãËá ÇÕÍÇÈåÇ ÝÞØ æáíÓ áåÇ ÚáÇÞÉ ÈÇáãÏÑÇÁ Ãæ ãÓÄæáíä ÇáÕÝÍÉ (Çáì ÇÐÇ ÞÇãæ åã ÈÐáß) æÈÇáÊÇáí áä íÊÍãáæ ãÓÄæáíÉ Êáß ÇáÕæÑ.<br />
<br />
ÇäÊ ÊæÇÝÞ Çäß áä ÊÞæã ÈÊÍãíá Çí ÕæÑ ãÑÝæÖÉ, æÞÍÉ, ÎÇÑÌÉ Úä ÇááíÇÞÉ ÇáÚÇãÉ, ÊÞÐÝ ÇáÛíÑ, ßÑÇåíÉ, ÊåÏÏ ÇáÛíÑ, ÌäÓíÉ Ãæ Çí ÕæÑ ÎÇÑÌÉ Úä äØÇÞ ÇáÞÇäæä. ÇäÊ ÊæÇÝÞ Çä ãÓÄæá ÇáÕÝÍÉ, ÇáãÏíÑ æÇáãÔÑÝíä Ýí ÇáãæÞÚ {SITE_NAME} áåã ÇáÍÞ Ýí ÊÚÏíá æÇÒÇáÉ Çí ãÍÊæì Ýí Çí æÞÊ íÑæäå ãäÇÓÈÇ. æßãÇ ÊæÇÝÞ Çä Êßæä ÇáÈíÇäÇÊ ÇáÊí ÊÏÎáåÇ ÓæÝ ÊÎÒä Ýí ÞÇÚÏÉ ÈíÇäÇÊ. æÍíË Çä åÐå ÇáãÚáæãÇÊ áä ÊÚáä áÔÎÕ ËÇáË Ïæä ãæÇÞÞÊß áä íÊÍãá ÇáãÓÄæá Çæ ãÏíÑ ÇáãæÞÚ Çí ÏÎæá ÊÎÑíÈí Úáì ÇáãæÞÚ íÊã Èå ãÚÑÝÉ åÐå ÇáãÚáæãÇÊ.<br />
<br />
åÐÇ ÇáãæÞÚ íÓÊÚãá ÇáßæßíÒ áÊÎÒíä ÇáãÚáæãÇÊ Úáì ÌåÇÒß. åÐå ÇáßæßíÒ ÊÍÓä ãä ÇØáÇÚß Úáì ÇáÕæÑ ÝÞØ. æíÓÊÚãá ÇáÈÑíÏ ÇáÇáßÊÑæäí áÊÃßíÏ ÚãáíÉ ÊÓÌíáß æßáãÉ ÇáÓÑ.<br />
<br />
ÈÇáÖÛØ Úáì ÒÑ 'ÇæÇÝÞ' Çä ÊæÇÝÞ æÊáÒã ÈåÐå ÇáÔÑæØ.
EOT;

$lang_register_php = array(
	'page_title' => 'ÊÓÌíá ÇáãÓÊÎÏã',
	'term_cond' => 'ÇáÔÑæØ æÇáÞæÇÚÏ',
	'i_agree' => 'ÇæÇÝÞ',
	'submit' => 'ÊÓÌíá ÇáØáÈ',
	'err_user_exists' => 'ÇáÇÓã ÇáÐí ÇÏÎáÊå ãæÌæÏ ãÓÈÞÇ, ÇáÑÌÇÁ ÇÓÊÎÏÇã ÇÓã ÂÎÑ',
	'err_password_mismatch' => 'ßáãÊí ÇáÓÑ áÇ íäØÈÞÇä¡ Úáíß ÇÏÎÇáåãÇ ãÑÉ ÇÎÑì',
	'err_uname_short' => 'íÌÈ Çä Êßæä ÇáßäíÉ Úáì ÇáÇÞá ÍÑÝíä',
	'err_password_short' => 'íÌÈ Çä Êßæä ßáãÉ ÇáÓÑ Úáì ÇáÇÞá ÍÑÝíä',
	'err_uname_pass_diff' => 'íÌÈ Çä Êßæä ÇáßäíÉ ãÎÊáÝÉ Úä ßáãÉ ÇáÓÑ',
	'err_invalid_email' => 'ÇáÈÑíÏ ÇáÇáßÊÑæäí ÇáÐí ßÊÈÊå áÇ íÚãá',
	'err_duplicate_email' => 'ãÓÊÎÏã ÂÎÑ ãÓÌá áå äÝÕ ÇáÈÑíÏ ÇáÇáßÊÑæäí',
	'enter_info' => 'ÇÏÎá ÈíÇäÇÊ ÇáÊÓÌíá',
	'required_info' => 'ãÚáæãÇÊ ãØáæÈÉ',
	'optional_info' => 'ãÚáæãÇÊ ÇÖÇÝíÉ',
	'username' => 'ÇáßäíÉ',
	'password' => 'ßáãÉ ÇáÓÑ',
	'password_again' => 'ÇÚÏ ÇÏÎÇá ßáãÉ ÇáÓÑ',
	'email' => 'ÇáÈÑíÏ ÇáÇáßÊÑæäí',
	'location' => 'ÇáãßÇä',
	'interests' => 'ÇáÇåÊãÇãÇÊ',
	'website' => 'ÕÝÍÊß',
	'occupation' => 'ÇáæÙíÝÉ',
	'error' => 'ÎØÃ',
	'confirm_email_subject' => '%s - ÊÃßíÏ ÇáÊÓÌíá',
	'information' => 'ÈíÇäÇÊ',
	'failed_sending_email' => 'áã ÇÓÊØíÚ ÇÑÓÇá ÑÓÇáÉ ÊÃßíÏ ÇáÊÓÌíá !',
	'thank_you' => 'ÔßÑÇ Úáì ÇáÊÓÌíá.<br /><br />Êã ÇÑÓÇá ÈÑíÏ íæÖÍ ßíÝíÉ ÊÝÚíá ÇáÇÔÊÑÇß.',
	'acct_created' => 'Êã Êßæíä ÇÔÊÑÇßß æÊÓÊØíÚ ÇáÏÎæá ÈßäíÊß æßáãÉ ÇáÓÑ',
	'acct_active' => 'ÇÔÊÑÇßß ÝÚÇá ÇáÂä æÊÓÊØíÚ ÇáÏÎæá ÈßäíÊß æßáãÉ ÇáÓÑ',
	'acct_already_act' => 'ÇÔÊÑÇßß ÝÚÇá ãÓÈÞÇ !',
	'acct_act_failed' => 'áÇ íãßä ÊÝÚíá åÐÇ ÇáÍÓÇÈ !',
	'err_unk_user' => 'ÇáãÓÊÎÏã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ !',
	'x_s_profile' => 'ÈíÇäÇÊ %s',
	'group' => 'ÇáãÌãæÚÉ',
	'reg_date' => 'ãÔÇÑß',
	'disk_usage' => 'ÇÓÊåáÇß ÇáÊÎÒíä',
	'change_pass' => 'ÊÛííÑ ßáãÉ ÇáÓÑ',
	'current_pass' => 'ßáãÉ ÇáÓÑ ÇáÍÇáíÉ',
	'new_pass' => 'ßáãÉ ÓÑ ÌÏíÏÉ',
	'new_pass_again' => 'ßáãÉ ÇáÓÑ ÇáÌÏíÏÉ ãÑÉ ÇÎÑì',
	'err_curr_pass' => 'ßáãÉ ÇáÓÑ ÇáÍÇáíÉ ÛíÑ ÕÍíÍÉ',
	'apply_modif' => 'ÊØÈíÞ ÇáÊÛííÑÇÊ',
	'change_pass' => 'ÛíÑ ßáãÉ ÇáÓÑ',
	'update_success' => 'Êã ÊÍÏíË ÈíÇäÇÊß',
	'pass_chg_success' => 'Êã ÊÛííÑ ßáãÉ ÇáÓÑ',
	'pass_chg_error' => 'áã ÊÊÛíÑ ßáãÉ ÇáÓÑ',
);

$lang_register_confirm_email = <<<EOT
Thank you for registering at {SITE_NAME}

Your username is : "{USER_NAME}"
Your password is : "{PASSWORD}"

áÊÝÚíá ÇáÍÓÇÈ Úáíß ÇáÖÛØ Úáì ÇáæÕáÉ ÈÇáÇÓÝá
Çæ ÇäÓÎ æÇáÕÞ ÇáæÕáÉ Ýí ãÊÕÝÍ ÇáÇäÊÑäÊ áÏíß.

{ACT_LINK}

Regards,

The management of {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'ãÑÇÌÚÉ ÇáÊÚáíÞÇÊ',
	'no_comment' => 'áÇ ÊÚáíÞÇÊ ááãÑÇÌÚÉ',
	'n_comm_del' => '%s ÊÚáíÞ ÇáÛí',
	'n_comm_disp' => 'ÚÏÏ ÇáÊÚáíÞÇÊ ÇáãÚÑæÖÉ',
	'see_prev' => 'ÇáÓÇÈÞ',
	'see_next' => 'ÇáÊÇáí',
	'del_comm' => 'ÇáÛÇÁ ÇáÊÚáíÞÇÊ ÇáãÎÊÇÑÉ',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'ÇÈÍË ãÌãæÚÉ ÇáÕæÑ',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'ÇÈÍË ÇáÕæÑ ÇáÌÏíÏÉ',
	'select_dir' => 'ÇÎÊÑ ãÌáÏ',
	'select_dir_msg' => 'åÐå ÇáÚãáíÉ Êãßäß ãä ÇÖÇÝÉ ßãíÉ ãä ÇáÕæÑ Êã ÊÍãíáåÇ ÈæÇÓØÉ FTP Çáì ÎÇÏã ÇáÕÝÍÇÊ áÏíß.<br /><br />ÇÎÊÑ ÇáÏáíá ÍíË ÞãÊ ÈÚãáíÉ ÇáÊÍãíá ãÓÈÞÇ',
	'no_pic_to_add' => 'áÇ ÊæÌÏ ÕæÑÉ ÇÖíÝåÇ',
	'need_one_album' => 'ÊÍÊÇÌ Úáì ÇáÇÞá ÇáÈæãÇ æÇÍÏÇ áåÐå ÇáÚãáíÉ',
	'warning' => 'ÊÍÐíÑ',
	'change_perm' => 'áÇ íÓÊØíÚ ÇáÈÑäÇãÌ ÇáÊÎÒíä Ýí åÐÇ ÇáÏáíá, ÊÍÊÇÌ ÊÛííÑ ÕáÇÍíÇÊ ÇáÏáíá Çáì 755 Çæ 777 ÞÈá ÇÖÇÝÉ ÇáÕæÑ !',
	'target_album' => '<b>ÖÚ ÕæÑ &quot;</b>%s<b>&quot; Ýí </b>%s',
	'folder' => 'ãÌáÏ',
	'image' => 'ÕæÑÉ',
	'album' => 'ÇáÈæã',
	'result' => 'äÊíÌÉ',
	'dir_ro' => 'ÛíÑ ÞÇÈá ááÊÎÒíä. ',
	'dir_cant_read' => 'ÛíÑ ÞÇÈá ááÞÑÇÁÉ. ',
	'insert' => 'ÇÖÇÝÉ ÕæÑ ÌÏíÏÉ ááãÚÑÖ',
	'list_new_pic' => 'ÞÇÆãÉ ÇáÕæÑ ÇáÌÏíÏÉ',
	'insert_selected' => 'ÊÎÒíä ÇáÕæÑ ÇáãÎÊÇÑÉ',
	'no_pic_found' => 'áÇ ÊæÌÏ ÕæÑ ÌÏíÏÉ',
	'be_patient' => 'ÇáÑÌÇÁ ÇáÕÈÑ¡ ÍíË íÍÊÇÌ ÇáÈÑäÇãÌ áÈÚÖ ãä ÇáæÞÊ áÇÖÇÝÉ ÇáÕæÑ',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : íÚäí Çäå Êã ÇÖÇÝÉ ÇáÕæÑ ÈäÌÇÍ'.
				'<li><b>DP</b> : íÚäí Çä ÇáÕæÑÉ ãßÑÑÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ æåí ãæÌæÏÉ ÝÚáÇ'.
				'<li><b>PB</b> : ÊÚäí Çääí áã ÇÊãßä ãä ÇÖÇÝÉ ÇáÕæÑÉ, ÊÃßÏ ãä ÇáÇÚÏÇÏÇÊ æãä ÕáÇÍíÇÊß Ýí ÊÎÒíä ÇáÕæÑÉ Ýí åÐÇ ÇáãÌáÏ'.
				'<li>ÇÐÇ ßÇä ÇáÑãÒ OK, DP, PB áÇ íÙåÑ ÇÖÛØ Úáì ÇáæÕáÉ ÇáãßÓæÑÉ áãÚÑÝÉ ÓÈÈ ÚÏã ÙåæÑåÇ PHP'.
				'<li>Çä áã íÑÏ Úáì ÇáãÊÕÝÍ ÈÚÏ æÞÊ ßÇÝ, ÇÖÛØ Úáì ÒÑ ÇÚÇÏÉ ÊÍãíá ÇáÕÝÍÉ'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) $lang_banning_php = array(
                'title' => 'ãäÚ ÇáãÓÊÎÏãíä',
                'user_name' => 'ÇÓã ÇáãÓÊÎÏã',
                'ip_address' => 'ÑÞã ÇáÇäÊÑäÊ',
                'expiry' => 'íäÊåí Ýí (ÝÇÑÛ íÚäí áÇ íäÊåí)',
                'edit_ban' => 'ÍÝÙ ÇáÊÛííÑÇÊ',
                'delete_ban' => 'ÇáÛÇÁ',
                'add_new' => 'ÇÖÇÝÉ ãäÚ ÌÏíÏ',
                'add_ban' => 'ÇÖÇÝÉ',
);

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'ÊÍãíá ÕæÑÉ',
	'max_fsize' => 'ÇßÈÑ ÍÌã áãáÝ ÇáÕæÑÉ åæ %s ßíáæ ÈÇíÊ',
	'album' => 'ÇáÈæã',
	'picture' => 'ÕæÑÉ',
	'pic_title' => 'ÚäæÇä ÕæÑÉ',
	'description' => 'ÔÑÍ ÇáÕæÑÉ',
	'keywords' => 'ßáãÇÊ ÈÍË (ÇÝÕá ÈíäåãÇ ÈãÓÇÝÉ)',
	'err_no_alb_uploadables' => 'äÃÓÝ áßä áÇ íæÌÏ ÇáÈæã ÊÓÊØíÚ ÊÍãíá ÇáÕæÑ Çáíå',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'ÇÏÇÑÉ ÇáãÓÊÎÏãíä',
	'name_a' => 'ÊÕÇÚÏí ÍÓÈ ÇáÇÓã',
	'name_d' => 'ÊäÇÒáí ÍÓÈ ÇáÇÓã',
	'group_a' => 'ÊÕÇÚÏí ÍÓÈ ÇáãÌãæÚÉ',
	'group_d' => 'ÊäÇÒáí ÍÓÈ ÇáãÌãæÚÉ',
	'reg_a' => 'ÊÕÇÚÏí ÍÓÈ ÊÇÑíÎ ÇáÊÓÌíá',
	'reg_d' => 'ÊäÇÒáí ÍÓÈ ÊÇÑíÎ ÇáÊÓÌíá',
	'pic_a' => 'ÊÕÇÚÏí ÍÓÈ ÚÏ ÇáÕæÑ',
	'pic_d' => 'ÊäÇÒáí ÍÓÈ ÚÏ ÇáÕæÑ',
	'disku_a' => 'ÊÕÇÚÏí ÍÓÈ ãÓÇÍÉ ÇáÊÎÒíä',
	'disku_d' => 'ÊäÇÒáí ÍÓÈ ãÓÇÍÉ ÇáÊÎÒíä',
	'sort_by' => 'ÑÊÈ ÇáãÓÊÎÏãíä ÍÓÈ',
	'err_no_users' => 'ÌÏæá ÇáãÓÊÎÏã ÝÇÑÛ !',
	'err_edit_self' => 'áÇ ÊÓÊØíÚ ÊÚÏíá ÈíÇäÇÊß ÇáÎÇÕÉ, ÇÓÊÚãá ÒÑ \'ÈíÇäÇÊí\' áÐáß',
	'edit' => 'ÊÚÏíá',
	'delete' => 'ÇáÛÇÁ',
	'name' => 'ÇÓã ÇáãÓÊÎÏã',
	'group' => 'ÇáãÌãæÚÉ',
	'inactive' => 'ãÚØá',
	'operations' => 'ÇáÚãáíÇÊ',
	'pictures' => 'ÇáÕæÑ',
	'disk_space' => 'ãÓÇÍÉ ÇáÊÎÒíä ÇáãÓãæÍÉ / ßæÊÇ',
	'registered_on' => 'Êã ÊÓÌíáå Ýí',
	'u_user_on_p_pages' => '%d ãÓÊÎÏã Ýí %d ÕÝÍÉ/ÕÝÍÇÊ',
	'confirm_del' => 'åá ÇäÊ ãÊÃßÏ ãä ÇáÛÇÁ åÐÇ ÇáãÓÊÎÏã ? \\nßá ÕæÑå æÇáÈæãÇÊå ÓæÝ ÊáÛì.',
	'mail' => 'ÈÑíÏ',
	'err_unknown_user' => 'ÇáãÓÊÎÏã ÇáãÎÊÇÑ ÛíÑ ãæÌæÏ !',
	'modify_user' => 'ÊÛííÑ ÇáãÓÊÎÏã',
	'notes' => 'ãáÇÍÙÇÊ',
	'note_list' => '<li>Çä áã ÊÑíÏ ÊÛííÑ ßáãÉ ÇáÓÑ, ÇÊÑß ãÑÈÚ ßáãÉ ÇáÓÑ ÝÇÑÛÇ',
	'password' => 'ßáãÉ ÇáÓÑ',
	'user_active' => 'ÇáãÓÊÎÏã ãÚØá',
	'user_group' => 'ãÌãæÚÉ ÇáãÓÊÎÏãíä',
	'user_email' => 'ÈÑíÏ ÇáãÓÊÎÏã',
	'user_web_site' => 'ÕÝÍÉ ÇáãÓÊÎÏã',
	'create_new_user' => 'Êßæíä ãÓÊÎÏã ÌÏíÏ',
	'user_location' => 'ãæÞÚ ÇáãÓÊÎÏã',
	'user_interests' => 'ÇåÊãÇãÇÊ ÇáãÊÓÎÏã',
	'user_occ' => 'æÙíÝÉ ÇáãÓÊÎÏã',
);

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //

if (defined('UTIL_PHP')) $lang_util_php = array(
        'title' => 'ÊÛííÑ ÞíÇÕ ÇáÕæÑÉ',
        'what_it_does' => 'ãÇÐÇ ÊÚãá',
        'what_update_titles' => 'ÊÍÏíË ÇáÚäÇæíä ãä ÇÓãÇÁ ÇáãáÝÇÊ',
        'what_delete_title' => 'ÇáÛÇÁ ÇáÚäÇæíä',
        'what_rebuild' => 'íÚÈÏ ÈäÇÁ ãÎÊÕÑÇÊ ÇáÕæÑ æíÚíÏ ÞíÇÓ ÇáÕæÑ',
        'what_delete_originals' => 'íáÛí ÇáÕæÑ ÇáãÚÇÏ ÞíÇÓåÇ ÇáÇÕáíÉ æ íÓÊÈÏáåã ÈÕæÑ ãÚÇÏ ÞíÇÓåÇ',
        'file' => 'ãáÝ',
        'title_set_to' => 'ÇáÚäæÇä ãÍÏÏ Çáì',
        'submit_form' => 'ÓÌá',
        'updated_succesfully' => 'Êã ÊÍÏíËå ÈäÌÇÍ',
        'error_create' => 'ÎØÃ Ýí Êßæíä',
        'continue' => 'ãÚÇáÌÉ ÇáãÒíÏ ãä ÇáÕæÑ',
        'main_success' => 'ÇáãáÝ %s Êã ÇÓÊÚãÇáå ßÇáÕæÑÉ ÇáÑÆíÓíÉ',
        'error_rename' => 'ÎØÃ Ýí ÊÛííÑ ÇáÇÓã %s Çáì %s',
        'error_not_found' => 'ÇáãáÝ %s ÛíÑ ãæÌæÏ',
        'back' => 'ÇáÑÌæÚ Çáì ÇáÑÆíÓíÉ',
        'thumbs_wait' => 'ÊÍÏíË ãÎÊÕÑÇÊ ÇáÕæÑ æ/Çæ ÇáÕæÑ ÇáãÚÇÏ ÞíÇÓåÇ, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ...',
        'thumbs_continue_wait' => 'ãÓÊãÑ Ýí ÊÍÏíË ãÎÊÕÑÇÊ ÇáÕæÑ Çæ/æ ÇáÕæÑ ÇáãÚÇÏ ÞíÇÓåÇ...',
        'titles_wait' => 'ÊÍÏíË ÇáÚäÇæíä, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ...',
        'delete_wait' => 'ÇáÛÇÁ ÇáÚäÇæíä, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ...',
        'replace_wait' => 'íÊã ÇáÛÇÁ ÇáÕæÑ ÇáÇÕáíÉ æíÊã ÇÓÊÈÏÇáå ÈÇÎÑì ãÚÇÏ ÞíÇÓåÇ, ÇáÑÌÇÁ ÇáÇäÊÙÇÑ..',
        'instruction' => 'ÊÚáíãÇÊ ÓÑíÚÉ',
        'instruction_action' => 'ÇÎÊÇÑ ÚãáíÉ',
        'instruction_parameter' => 'ÊÍÏíÏ ÇáãÊÛíÑÇÊ',
        'instruction_album' => 'ÇÎÊÑ ÇáÇáÈæã',
        'instruction_press' => 'ÇÖÛØ Úáì %s',
        'update' => 'ÊÍÏíË ÇáãÎÊÕÑÇÊ æ/Ãæ ÇÚÇÏÉ ÊÞííÓ ÇáÕæÑ',
        'update_what' => 'ãÇÐÇ íÌÈ ÊÍÏíËå',
        'update_thumb' => 'ãÎÊÕÑÇÊ ÇáÕæÑ ÝÞØ',
        'update_pic' => 'ÇáÕæÑ ÇáãÚÇÏ ÞíÇÓåÇ ÝÞØ',
        'update_both' => 'ÇáÕæÑ ÇáãÎÊÕÑÉ æÇáãÚÇÏ ÞíÇÓåÇ ãÚÇ',
        'update_number' => 'ÚÏÏ ÇáÕæÑ ÇáãÚÇáÌÉ ÈÇáÖÛØÉ',
        'update_option' => '(ÍÇá ÇáÊÞáíá ãä åÐÇ ÇáÇÚÏÇÏ Çä æÇÌåÊ ãÔÇßá ÇäÊåÇÁ ÇáæÞÊ)',
        'filename_title' => 'ÇÓã ÇáãáÝ &rArr; ÚäæÇä ÇáÕæÑÉ',
        'filename_how' => 'ßíÝíÉ ÊÛííÑ ÇÓã ÇáãáÝ',
        'filename_remove' => 'ÇÒÇáÉ äåÇíÉ .jpg æ ÇÓÊÈÏÇá _ (ÔÑØÉ ÓÝáíÉ) ÈÇáãÓÇÝÇÊ',
        'filename_euro' => 'ÛíÑ 2003_11_23_13_20_20.jpg Çáì 23/11/2003 13:20',
        'filename_us' => 'íÛíÑ  2003_11_23_13_20_20.jpg Çáì  11/23/2003 13:20',
        'filename_time' => 'íÛíÑ  2003_11_23_13_20_20.jpg Çáì 13:20',
        'delete' => 'íáÛí ÚäÇæíä ÇáÕæÑ Çæ ÕæÑ ÇáÞíÇÓ ÇáÇÕáíÉ',
        'delete_title' => 'ÇáÛí ÚäÇæíä ÇáÕæÑ',
        'delete_original' => 'ÇáÛí ÕæÑ ÇáÞíÇÓ ÇáÇÕáíÉ',
        'delete_replace' => 'íáÛí ÇáÕæÑ ÇáÇÕáíÉ æíÓÊÈÏáåã ÈÇÎÑì ÈÞíÇÓ ãÎÊáÝ',
        'select_album' => 'ÇÎÊÇÑ ÇáÇáÈæã',
);

?>