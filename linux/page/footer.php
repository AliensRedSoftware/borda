<?php
class footer extends xlib {

	/**
	 * Выполнить
	 */
    function execute () {
        echo "<footer>";
		$this->add_js([
			'jquery-1.10.2.min.js',
			'js.cookie-2.2.0.min.js',
			'js.js',
			'timer.js',
			'uuid.js',
			'youtube.js'
		]);
        echo "</footer>";
    }
}
