<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.4.25
  $HeadURL$
  $Revision$
  $Author$
  $Date$
**********************************************/
/*
	MBFS - MultiByte Functions Simulator
	Functions that simulate the mb_*() extension functionality
	NOTE: only Unicode possible with these

	@author DJ Maze
	@copyright 2005 http://moocms.com
*/

global $mb_uppercase, $mb_lowercase;

# PHP 4 >= 4.0.6, PHP 5
if (!function_exists('mb_strlen')) {

	function mb_strlen($str) {
		global $mb_utf8_regex;
		return preg_match_all("#$mb_utf8_regex".'|[\x00-\x7F]#', $str, $dummy);
	}

	function mb_substr($str, $start, $end=null) {
		global $mb_utf8_regex;
		preg_match_all("#$mb_utf8_regex".'|[\x00-\x7F]#', $str, $str);
		$str = empty($end) ? array_slice($str[0], $start) : array_slice($str[0], $start, $end);
		return implode('', $str);
	}

}

# PHP 4 >= 4.3.0, PHP 5
function mb_strtolower($str) {
	global $mb_uppercase, $mb_lowercase;
	return str_replace($mb_uppercase, $mb_lowercase, $str);
}

function mb_strtoupper($str) {
	global $mb_uppercase, $mb_lowercase;
	return str_replace($mb_lowercase, $mb_uppercase, $str);
}

$mb_uppercase = array(
	'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
	'Μ',
	'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','Þ','Ÿ','Ā','Ă','Ą','Ć','Ĉ','Ċ','Č','Ď','Đ','Ē','Ĕ','Ė','Ę','Ě','Ĝ','Ğ','Ġ','Ģ','Ĥ','Ħ','Ĩ','Ī','Ĭ','Į','I','Ĳ','Ĵ','Ķ',
	'Ĺ','Ļ','Ľ','Ŀ','Ł','Ń','Ņ','Ň',
	'Ŋ','Ō','Ŏ','Ő','Œ','Ŕ','Ŗ','Ř','Ś','Ŝ','Ş','Š','Ţ','Ť','Ŧ','Ũ','Ū','Ŭ','Ů','Ű','Ų','Ŵ','Ŷ','Ź','Ż','Ž','S',
	'Ƃ','Ƅ','Ƈ','Ƌ',
	'Ƒ','Ƕ','Ƙ','Ƚ',
	'Ƞ','Ơ','Ƣ','Ƥ','Ƨ',
	'Ƭ','Ư','Ƴ','Ƶ','Ƹ',
	'Ƽ',
	'Ƿ','ǅ','ǈ','ǋ','Ǎ','Ǐ','Ǒ','Ǔ','Ǖ','Ǘ','Ǚ','Ǜ','Ǝ','Ǟ','Ǡ','Ǣ','Ǥ','Ǧ','Ǩ','Ǫ','Ǭ','Ǯ',
	'ǲ','Ǵ','Ǹ','Ǻ','Ǽ','Ǿ','Ȁ','Ȃ','Ȅ','Ȇ','Ȉ','Ȋ','Ȍ','Ȏ','Ȑ','Ȓ','Ȕ','Ȗ','Ș','Ț','Ȝ','Ȟ',
	'Ȣ','Ȥ','Ȧ','Ȩ','Ȫ','Ȭ','Ȯ','Ȱ','Ȳ',
	'Ȼ',
	'Ɓ','Ɔ',
	'Ɖ','Ɗ',
	'Ə',
	'Ɛ',
	'Ɠ',
	'Ɣ',
	'Ɨ','Ɩ',
	'Ɯ',
	'Ɲ',
	'Ɵ',
	'Ʀ',
	'Ʃ',
	'Ʈ',
	'Ʊ','Ʋ',
	'Ʒ',
	'Ɂ',
	'Ά','Έ','Ή','Ί',
	'Α','Β','Γ','Δ','Ε','Ζ','Η','Θ','Ι','Κ','Λ','Μ','Ν','Ξ','Ο','Π','Ρ','Σ','Σ','Τ','Υ','Φ','Χ','Ψ','Ω','Ϊ','Ϋ','Ό','Ύ','Ώ','Β','Θ','Φ','Π',
	'Ϙ','Ϛ','Ϝ','Ϟ','Ϡ','Ϣ','Ϥ','Ϧ','Ϩ','Ϫ','Ϭ','Ϯ','Κ','Ρ','Ϲ',
	'Ε','Ϸ','Ϻ',
	'А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','Ѐ','Ё','Ђ','Ѓ','Є','Ѕ','І','Ї','Ј','Љ','Њ','Ћ','Ќ','Ѝ','Ў','Џ','Ѡ','Ѣ','Ѥ','Ѧ','Ѩ','Ѫ','Ѭ','Ѯ','Ѱ','Ѳ','Ѵ','Ѷ','Ѹ','Ѻ','Ѽ','Ѿ','Ҁ','Ҋ','Ҍ','Ҏ','Ґ','Ғ','Ҕ','Җ','Ҙ','Қ','Ҝ','Ҟ','Ҡ','Ң','Ҥ','Ҧ','Ҩ','Ҫ','Ҭ','Ү','Ұ','Ҳ','Ҵ','Ҷ','Ҹ','Һ','Ҽ','Ҿ','Ӂ','Ӄ','Ӆ','Ӈ','Ӊ','Ӌ','Ӎ','Ӑ','Ӓ','Ӕ','Ӗ','Ә','Ӛ','Ӝ','Ӟ','Ӡ','Ӣ','Ӥ','Ӧ','Ө','Ӫ','Ӭ','Ӯ','Ӱ','Ӳ','Ӵ','Ӷ','Ӹ','Ԁ','Ԃ','Ԅ','Ԇ','Ԉ','Ԋ','Ԍ','Ԏ','Ա','Բ','Գ','Դ','Ե','Զ','Է','Ը','Թ','Ժ','Ի','Լ','Խ','Ծ','Կ','Հ','Ձ','Ղ','Ճ','Մ','Յ','Ն','Շ','Ո','Չ','Պ','Ջ','Ռ','Ս','Վ','Տ','Ր','Ց','Ւ','Փ','Ք','Օ','Ֆ',
	'Ḁ','Ḃ','Ḅ','Ḇ','Ḉ','Ḋ','Ḍ','Ḏ','Ḑ','Ḓ','Ḕ','Ḗ','Ḙ','Ḛ','Ḝ','Ḟ','Ḡ','Ḣ','Ḥ','Ḧ','Ḩ','Ḫ','Ḭ','Ḯ','Ḱ','Ḳ','Ḵ','Ḷ','Ḹ','Ḻ','Ḽ','Ḿ','Ṁ','Ṃ','Ṅ','Ṇ','Ṉ','Ṋ','Ṍ','Ṏ','Ṑ','Ṓ','Ṕ','Ṗ','Ṙ','Ṛ','Ṝ','Ṟ','Ṡ','Ṣ','Ṥ','Ṧ','Ṩ','Ṫ','Ṭ','Ṯ','Ṱ','Ṳ','Ṵ','Ṷ','Ṹ','Ṻ','Ṽ','Ṿ','Ẁ','Ẃ','Ẅ','Ẇ','Ẉ','Ẋ','Ẍ','Ẏ','Ẑ','Ẓ','Ẕ',
	'Ṡ','Ạ','Ả','Ấ','Ầ','Ẩ','Ẫ','Ậ','Ắ','Ằ','Ẳ','Ẵ','Ặ','Ẹ','Ẻ','Ẽ','Ế','Ề','Ể','Ễ','Ệ','Ỉ','Ị','Ọ','Ỏ','Ố','Ồ','Ổ','Ỗ','Ộ','Ớ','Ờ','Ở','Ỡ','Ợ','Ụ','Ủ','Ứ','Ừ','Ử','Ữ','Ự','Ỳ','Ỵ','Ỷ','Ỹ','Ἀ','Ἁ','Ἂ','Ἃ','Ἄ','Ἅ','Ἆ','Ἇ','Ἐ','Ἑ','Ἒ','Ἓ','Ἔ','Ἕ','Ἠ','Ἡ','Ἢ','Ἣ','Ἤ','Ἥ','Ἦ','Ἧ','Ἰ','Ἱ','Ἲ','Ἳ','Ἴ','Ἵ','Ἶ','Ἷ','Ὀ','Ὁ','Ὂ','Ὃ','Ὄ','Ὅ',
	'Ὑ',
	'Ὓ',
	'Ὕ',
	'Ὗ','Ὠ','Ὡ','Ὢ','Ὣ','Ὤ','Ὥ','Ὦ','Ὧ','Ὰ','Ά','Ὲ','Έ','Ὴ','Ή','Ὶ','Ί','Ὸ','Ό','Ὺ','Ύ','Ὼ','Ώ','ᾈ','ᾉ','ᾊ','ᾋ','ᾌ','ᾍ','ᾎ','ᾏ','ᾘ','ᾙ','ᾚ','ᾛ','ᾜ','ᾝ','ᾞ','ᾟ','ᾨ','ᾩ','ᾪ','ᾫ','ᾬ','ᾭ','ᾮ','ᾯ','Ᾰ','Ᾱ',
	'ᾼ',
	'Ι',
	'ῌ',
	'Ῐ','Ῑ',
	'Ῠ','Ῡ',
	'Ῥ',
	'ῼ',
	'Ⰰ','Ⰱ','Ⰲ','Ⰳ','Ⰴ','Ⰵ','Ⰶ','Ⰷ','Ⰸ','Ⰹ','Ⰺ','Ⰻ','Ⰼ','Ⰽ','Ⰾ','Ⰿ','Ⱀ','Ⱁ','Ⱂ','Ⱃ','Ⱄ','Ⱅ','Ⱆ','Ⱇ','Ⱈ','Ⱉ','Ⱊ','Ⱋ','Ⱌ','Ⱍ','Ⱎ','Ⱏ','Ⱐ','Ⱑ','Ⱒ','Ⱓ','Ⱔ','Ⱕ','Ⱖ','Ⱗ','Ⱘ','Ⱙ','Ⱚ','Ⱛ','Ⱜ','Ⱝ','Ⱞ','Ⲁ','Ⲃ','Ⲅ','Ⲇ','Ⲉ','Ⲋ','Ⲍ','Ⲏ','Ⲑ','Ⲓ','Ⲕ','Ⲗ','Ⲙ','Ⲛ','Ⲝ','Ⲟ','Ⲡ','Ⲣ','Ⲥ','Ⲧ','Ⲩ','Ⲫ','Ⲭ','Ⲯ','Ⲱ','Ⲳ','Ⲵ','Ⲷ','Ⲹ','Ⲻ','Ⲽ','Ⲿ','Ⳁ','Ⳃ','Ⳅ','Ⳇ','Ⳉ','Ⳋ','Ⳍ','Ⳏ','Ⳑ','Ⳓ','Ⳕ','Ⳗ','Ⳙ','Ⳛ','Ⳝ','Ⳟ','Ⳡ','Ⳣ',
	'Ⴀ','Ⴁ','Ⴂ','Ⴃ','Ⴄ','Ⴅ','Ⴆ','Ⴇ','Ⴈ','Ⴉ','Ⴊ','Ⴋ','Ⴌ','Ⴍ','Ⴎ','Ⴏ','Ⴐ','Ⴑ','Ⴒ','Ⴓ','Ⴔ','Ⴕ','Ⴖ','Ⴗ','Ⴘ','Ⴙ','Ⴚ','Ⴛ','Ⴜ','Ⴝ','Ⴞ','Ⴟ','Ⴠ','Ⴡ','Ⴢ','Ⴣ','Ⴤ','Ⴥ',
	'Ａ','Ｂ','Ｃ','Ｄ','Ｅ','Ｆ','Ｇ','Ｈ','Ｉ','Ｊ','Ｋ','Ｌ','Ｍ','Ｎ','Ｏ','Ｐ','Ｑ','Ｒ','Ｓ','Ｔ','Ｕ','Ｖ','Ｗ','Ｘ','Ｙ','Ｚ',
);
$mb_lowercase = array(
	'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
	'µ',
	'à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','þ','ÿ','ā','ă','ą','ć','ĉ','ċ','č','ď','đ','ē','ĕ','ė','ę','ě','ĝ','ğ','ġ','ģ','ĥ','ħ','ĩ','ī','ĭ','į','ı','ĳ','ĵ','ķ',
	'ĺ','ļ','ľ','ŀ','ł','ń','ņ','ň',
	'ŋ','ō','ŏ','ő','œ','ŕ','ŗ','ř','ś','ŝ','ş','š','ţ','ť','ŧ','ũ','ū','ŭ','ů','ű','ų','ŵ','ŷ','ź','ż','ž','ſ',
	'ƃ','ƅ','ƈ','ƌ',
	'ƒ','ƕ','ƙ','ƚ',
	'ƞ','ơ','ƣ','ƥ','ƨ',
	'ƭ','ư','ƴ','ƶ','ƹ',
	'ƽ',
	'ƿ','ǆ','ǉ','ǌ','ǎ','ǐ','ǒ','ǔ','ǖ','ǘ','ǚ','ǜ','ǝ','ǟ','ǡ','ǣ','ǥ','ǧ','ǩ','ǫ','ǭ','ǯ',
	'ǳ','ǵ','ǹ','ǻ','ǽ','ǿ','ȁ','ȃ','ȅ','ȇ','ȉ','ȋ','ȍ','ȏ','ȑ','ȓ','ȕ','ȗ','ș','ț','ȝ','ȟ',
	'ȣ','ȥ','ȧ','ȩ','ȫ','ȭ','ȯ','ȱ','ȳ',
	'ȼ',
	'ɓ','ɔ',
	'ɖ','ɗ',
	'ə',
	'ɛ',
	'ɠ',
	'ɣ',
	'ɨ','ɩ',
	'ɯ',
	'ɲ',
	'ɵ',
	'ʀ',
	'ʃ',
	'ʈ',
	'ʊ','ʋ',
	'ʒ',
	'ʔ',
	'ά','έ','ή','ί',
	'α','β','γ','δ','ε','ζ','η','θ','ι','κ','λ','μ','ν','ξ','ο','π','ρ','ς','σ','τ','υ','φ','χ','ψ','ω','ϊ','ϋ','ό','ύ','ώ','ϐ','ϑ','ϕ','ϖ',
	'ϙ','ϛ','ϝ','ϟ','ϡ','ϣ','ϥ','ϧ','ϩ','ϫ','ϭ','ϯ','ϰ','ϱ','ϲ',
	'ϵ','ϸ','ϻ',
	'а','б','в','г','д','е','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я','ѐ','ё','ђ','ѓ','є','ѕ','і','ї','ј','љ','њ','ћ','ќ','ѝ','ў','џ','ѡ','ѣ','ѥ','ѧ','ѩ','ѫ','ѭ','ѯ','ѱ','ѳ','ѵ','ѷ','ѹ','ѻ','ѽ','ѿ','ҁ','ҋ','ҍ','ҏ','ґ','ғ','ҕ','җ','ҙ','қ','ҝ','ҟ','ҡ','ң','ҥ','ҧ','ҩ','ҫ','ҭ','ү','ұ','ҳ','ҵ','ҷ','ҹ','һ','ҽ','ҿ','ӂ','ӄ','ӆ','ӈ','ӊ','ӌ','ӎ','ӑ','ӓ','ӕ','ӗ','ә','ӛ','ӝ','ӟ','ӡ','ӣ','ӥ','ӧ','ө','ӫ','ӭ','ӯ','ӱ','ӳ','ӵ','ӷ','ӹ','ԁ','ԃ','ԅ','ԇ','ԉ','ԋ','ԍ','ԏ','ա','բ','գ','դ','ե','զ','է','ը','թ','ժ','ի','լ','խ','ծ','կ','հ','ձ','ղ','ճ','մ','յ','ն','շ','ո','չ','պ','ջ','ռ','ս','վ','տ','ր','ց','ւ','փ','ք','օ','ֆ',
	'ḁ','ḃ','ḅ','ḇ','ḉ','ḋ','ḍ','ḏ','ḑ','ḓ','ḕ','ḗ','ḙ','ḛ','ḝ','ḟ','ḡ','ḣ','ḥ','ḧ','ḩ','ḫ','ḭ','ḯ','ḱ','ḳ','ḵ','ḷ','ḹ','ḻ','ḽ','ḿ','ṁ','ṃ','ṅ','ṇ','ṉ','ṋ','ṍ','ṏ','ṑ','ṓ','ṕ','ṗ','ṙ','ṛ','ṝ','ṟ','ṡ','ṣ','ṥ','ṧ','ṩ','ṫ','ṭ','ṯ','ṱ','ṳ','ṵ','ṷ','ṹ','ṻ','ṽ','ṿ','ẁ','ẃ','ẅ','ẇ','ẉ','ẋ','ẍ','ẏ','ẑ','ẓ','ẕ',
	'ẛ','ạ','ả','ấ','ầ','ẩ','ẫ','ậ','ắ','ằ','ẳ','ẵ','ặ','ẹ','ẻ','ẽ','ế','ề','ể','ễ','ệ','ỉ','ị','ọ','ỏ','ố','ồ','ổ','ỗ','ộ','ớ','ờ','ở','ỡ','ợ','ụ','ủ','ứ','ừ','ử','ữ','ự','ỳ','ỵ','ỷ','ỹ','ἀ','ἁ','ἂ','ἃ','ἄ','ἅ','ἆ','ἇ','ἐ','ἑ','ἒ','ἓ','ἔ','ἕ','ἠ','ἡ','ἢ','ἣ','ἤ','ἥ','ἦ','ἧ','ἰ','ἱ','ἲ','ἳ','ἴ','ἵ','ἶ','ἷ','ὀ','ὁ','ὂ','ὃ','ὄ','ὅ',
	'ὑ',
	'ὓ',
	'ὕ',
	'ὗ','ὠ','ὡ','ὢ','ὣ','ὤ','ὥ','ὦ','ὧ','ὰ','ά','ὲ','έ','ὴ','ή','ὶ','ί','ὸ','ό','ὺ','ύ','ὼ','ώ','ᾀ','ᾁ','ᾂ','ᾃ','ᾄ','ᾅ','ᾆ','ᾇ','ᾐ','ᾑ','ᾒ','ᾓ','ᾔ','ᾕ','ᾖ','ᾗ','ᾠ','ᾡ','ᾢ','ᾣ','ᾤ','ᾥ','ᾦ','ᾧ','ᾰ','ᾱ',
	'ᾳ',
	'ι',
	'ῃ',
	'ῐ','ῑ',
	'ῠ','ῡ',
	'ῥ',
	'ῳ',
	'ⰰ','ⰱ','ⰲ','ⰳ','ⰴ','ⰵ','ⰶ','ⰷ','ⰸ','ⰹ','ⰺ','ⰻ','ⰼ','ⰽ','ⰾ','ⰿ','ⱀ','ⱁ','ⱂ','ⱃ','ⱄ','ⱅ','ⱆ','ⱇ','ⱈ','ⱉ','ⱊ','ⱋ','ⱌ','ⱍ','ⱎ','ⱏ','ⱐ','ⱑ','ⱒ','ⱓ','ⱔ','ⱕ','ⱖ','ⱗ','ⱘ','ⱙ','ⱚ','ⱛ','ⱜ','ⱝ','ⱞ','ⲁ','ⲃ','ⲅ','ⲇ','ⲉ','ⲋ','ⲍ','ⲏ','ⲑ','ⲓ','ⲕ','ⲗ','ⲙ','ⲛ','ⲝ','ⲟ','ⲡ','ⲣ','ⲥ','ⲧ','ⲩ','ⲫ','ⲭ','ⲯ','ⲱ','ⲳ','ⲵ','ⲷ','ⲹ','ⲻ','ⲽ','ⲿ','ⳁ','ⳃ','ⳅ','ⳇ','ⳉ','ⳋ','ⳍ','ⳏ','ⳑ','ⳓ','ⳕ','ⳗ','ⳙ','ⳛ','ⳝ','ⳟ','ⳡ','ⳣ',
	'ⴀ','ⴁ','ⴂ','ⴃ','ⴄ','ⴅ','ⴆ','ⴇ','ⴈ','ⴉ','ⴊ','ⴋ','ⴌ','ⴍ','ⴎ','ⴏ','ⴐ','ⴑ','ⴒ','ⴓ','ⴔ','ⴕ','ⴖ','ⴗ','ⴘ','ⴙ','ⴚ','ⴛ','ⴜ','ⴝ','ⴞ','ⴟ','ⴠ','ⴡ','ⴢ','ⴣ','ⴤ','ⴥ',
	'ａ','ｂ','ｃ','ｄ','ｅ','ｆ','ｇ','ｈ','ｉ','ｊ','ｋ','ｌ','ｍ','ｎ','ｏ','ｐ','ｑ','ｒ','ｓ','ｔ','ｕ','ｖ','ｗ','ｘ','ｙ','ｚ',
);
