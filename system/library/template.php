<?php

class Template {

	private $adaptor;



  	public function __construct($adaptor) {

	    $class = 'Template\\' . $adaptor;

		$expire='';
		
		if (class_exists($class)) {

			$this->adaptor = new $class($expire);

		} else {

			throw new \Exception('Error: Could not load template adaptor ' . $adaptor . '!');

		}

	}



	public function set($key, $value) {

		$this->adaptor->set($key, $value);

	}



	public function render($template) {

		return $this->adaptor->render($template);

	}

}
