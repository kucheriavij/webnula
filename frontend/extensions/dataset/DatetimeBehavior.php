<?php
/**
 * @author
 * @version
 * @see
 * @link
 * @license
 */

namespace application\extensions\dataset;

use kernel\storage\Type;
use kernel\components\DateTimeHelper;

class DatetimeBehavior extends DateTimeHelper {
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		
		if( $owner[$type->name] === '0000-00-00 00:00:00' ) {
			return "";
		}
		
		$format = 'Y-m-d H:i:s';
		if(isset($params['format'])) {
			$format = $params['format'];
		} else if( isset($type->options['format']) ) {
			$format = $type->options['format'];
		} else if( isset($params['locale']) ) {
			$format = '%Y-%m-%d %H:%M:%S';
		}
		
		$timestamp = strtotime($owner[$type->name]);
		if( isset($params['locale']) ) {
			$lcAll = setlocale(LC_ALL);
			$locale = $this->getLocale($params['locale']);
			array_unshift($locale, LC_ALL);
			call_user_func_array('setlocale', $locale);
			$date = strftime($format, $timestamp);
		} else {
			$date = $this->formatDate($format, $timestamp);
		}
		
		if( stripos(PHP_OS, 'win') !== false ) {
			$date = iconv('windows-1251', 'utf-8', $date);
		}
		if( isset($lcAll) ) {
			setlocale(LC_ALL, $lcAll);
		}
		return $date;
	}
	
	public function store(Type $type)
	{
		// NOTHING
	}
	
	public function delete(Type $type)
	{
		// NOTHING
	}
	
	public function cleanUp(Type $type, array $params = array())
	{
		// NOTHING
	}
}
