<?php
/**
 * User: Christian Hoefer
 * Date: 06.11.2014
 * Time: 17:49
 */

namespace allatnet\yii2\modules\extendedrights\components;


use yii\base\Component;

class Generator extends Component {

	private $controllers = [];

	public function getControllerActions(){
		// Frontend Controllers
		$this->getControllers(\Yii::$app->basePath.DIRECTORY_SEPARATOR.'controllers');
		$directory = scandir(\Yii::$app->basePath.DIRECTORY_SEPARATOR.'modules');
		foreach ($directory as $module) {
			if($module{0} !== '.'){
				$modulePath = \Yii::$app->basePath.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'controllers';
				$this->getControllers($modulePath, $module);
			}
		}

		foreach( $this->controllers as $key => $controller ) {
			$actions    = [];
			$file       = fopen($controller['path'], 'r');
			$lineNumber = 0;
			while (feof($file) === false) {
				++$lineNumber;
				$line = fgets($file);
				preg_match('/public[ \t]+function[ \t]+action([A-Z]{1}[a-zA-Z0-9]+)[ \t]*\(/', $line, $matches);
				if ($matches !== array()) {
					$name                       = $matches[1];
					$actions[strtolower($name)] = [
						'name' => $name,
						'line' => $lineNumber
					];
				}
			}

			$this->controllers[$key]['actions'] = $actions;
		}
		return $this->controllers;
	}

	public function getControllers($path, $module = '') {
		if(is_dir($path)){
			$controllerDirectory = scandir($path);
			foreach ($controllerDirectory as $file) {
				if($file{0} !== '.'){
					$filePath = $path.DIRECTORY_SEPARATOR.$file;
					if( strpos(strtolower($file), 'controller')!==false )
					{
						$name = substr($file, 0, -14);
						$this->controllers[ strtolower($filePath) ] = array(
							'name'=>$name,
							'file'=>$file,
							'path'=>$filePath,
							'module'=>ucfirst($module),
						);
					}
				}
			}
		}
	}

}