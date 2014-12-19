<?php

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require_once(__DIR__ . '/../config/web.php');

$localFilename = dirname(__FILE__) . '/../config/local.php';
if (file_exists($localFilename))
	$config = mergeConfigArray($config, require($localFilename));

(new yii\web\Application($config))->run();


/**
 * Рекурсивно мерджит массивы с конфигами по хитрой схеме.
 * Если элемент массива $a - массив, а $b - null, тогда затирает этот элемент в $a
 * array $a массив A
 * array $b массив B
 */
function mergeConfigArray($a, $b) {
	$args=func_get_args();
	$res=array_shift($args);
	while (!empty($args)) {
		$next=array_shift($args);
		foreach ($next as $k => $v) {
			if (is_integer($k))
				isset($res[$k]) ? $res[]=$v : $res[$k]=$v;
			else if (is_null($v) && isset($res[$k]) && is_array($res[$k]))
				unset($res[$k]);
			else if ($v instanceof SReplaceArray)
				$res[$k] = $v->data;
			else if (is_array($v) && isset($res[$k]) && is_array($res[$k]))
				$res[$k] = mergeConfigArray($res[$k],$v);
			else
				$res[$k]=$v;
		}
	}
	return $res;
}