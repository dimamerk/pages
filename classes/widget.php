<?php
	
namespace pagescms\widget;
use pagescms\factory\Factory;

abstract class Widget{

	public static function start($widgetName,array $optionsArray = array()){
		
		$widget = Factory::getWidget($widgetName);
		return $widget->run($optionsArray);
	}

	abstract protected function run(array $optionsArray = array());

}

class Helper{

	public static function convertDate($datetime){
		$mounthArray = [1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
						5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
						9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря'];

		$unixtime = strtotime($datetime);
		$dateArray = getdate($unixtime);
		$dateArray['hours'] = ($dateArray['hours'] < 10) ? '0'.$dateArray['hours'] : $dateArray['hours'];
		$dateArray['minutes'] = ($dateArray['minutes'] < 10) ? '0'.$dateArray['minutes'] : $dateArray['minutes'];
		$ret = $dateArray['mday'].' '.$mounthArray[$dateArray['mon']].' '.$dateArray['year'].' в '.$dateArray['hours'].':'.$dateArray['minutes'];
		return $ret;
	}

	public static function escape($text){
		return htmlspecialchars($text);
	}

}

?>