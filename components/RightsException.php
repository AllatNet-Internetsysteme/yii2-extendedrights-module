<?php
/**
 * Created by PhpStorm.
 * User: ch
 * Date: 28.01.2016
 * Time: 16:20
 */

namespace allatnet\yii2\modules\extendedrights\components;


use yii\web\HttpException;

class RightsException extends HttpException
{

	public function __construct($status = null, $message = null, $code = 0, \Exception $previous = null) {
		if (empty($status))
			$status = 403;
		if (empty($message))
			$message = 'Berechtigungsfehler';
		$this->statusCode = $status;
		parent::__construct($status, $message, $code, $previous);
	}
}