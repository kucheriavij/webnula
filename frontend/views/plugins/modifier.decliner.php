<?php
/**
 * 
 *
 * @author 
 * @link 
 * @copyright 
 * @license 
 */

function smarty_modifier_decliner($count, $words, $template = '{count}') {
	$cnt__ = $count;
	$count = abs($count) % 100;
	$n1 = $count % 10;
	
	if( is_string($words) ) {
		$words = explode(',', str_replace(', ', ',', $words));
	}
	
	if ($count > 10 && $count < 20)
		$result = array('{count}' => $cnt__, '{suffix}' => $words[2]);
	else if ($n1 > 1 && $n1 < 5)
		$result = array('{count}' => $cnt__, '{suffix}' => $words[1]);
	else if ($n1 == 1)
		$result = array('{count}' => $cnt__, '{suffix}' => $words[0]);
	else
		$result = array('{count}' => $cnt__, '{suffix}' => $words[2]);
		
	return strtr($template, $result);
}
