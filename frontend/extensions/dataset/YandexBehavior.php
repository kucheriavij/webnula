<?php
/**
 * @author  Martyushev Dmitry (dangozero@gmail.com)
 * @copyright Copyright (c) 2014, dangozero
 * @license LICENSE
 */
namespace application\extensions\dataset;

use \CJSON;
use \Yii;

use kernel\storage\Type;
use kernel\components\DatasetActiveBehavior;

class YandexBehavior extends DatasetActiveBehavior {
	private static $_counter = 0;
	
	public function valueOf(Type $type, array $params = array())
	{
		$owner = $this->getOwner();
		$field = $type->name;
		Yii::app()->clientScript->registerScriptFile('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');
		
$_format = <<<DATA
ymaps.ready(function(){
        var map = new ymaps.Map("{id}", {
            center: [{centerX}, {centerY}],
            zoom: {zoom},
            type: "yandex#map"
        });
        map.controls.add("zoomControl").add("mapTools").add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));
        map.geoObjects.add(new ymaps.Placemark([{pointX}, {pointY}], {
            balloonContent: '{content}'
        }, {
            preset: "twirl#lightblueDotIcon"
        }));
	});
DATA;
		if(!isset($params['template'])) {
			$template = '<div class="yandex-map" id="{id}"></div>';
		} else {
			$template = $params['template'];
		}
		
		$content = '';
		if( isset($params['content']) ) {
			$content = $params['content'];
		}
		
		$data = CJSON::decode($owner->{$field});
		$bhId= self::$_counter;
		
		$_format = strtr($_format, array(
			'{centerX}' => $data['mapCenter'][0],
			'{centerY}' => $data['mapCenter'][1],
			'{pointX}' => $data['point'][0],
			'{pointY}' => $data['point'][1],
			'{content}' => $content,
			'{zoom}' => $data['mapZoom'],
			'{id}' => 'ymap-'.$bhId
		));
		$template = strtr($template, array(
			'{id}' => 'ymap-'.$bhId
		));
		Yii::app()->clientScript->registerScript(__CLASS__.'#ymap-'.$bhId, $_format);
		self::$_counter++;
		echo $template;
	}
	
	public function store(Type $type)
	{
		
	}
	
	public function delete(Type $type)
	{
		
	}
	
	public function cleanUp(Type $type, array $params = array())
	{
		
	}
}
