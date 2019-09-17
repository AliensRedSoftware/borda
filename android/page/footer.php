<?php
class footer extends xlib {
    function execute () {
        echo "<footer>";
		$this->add_js
		([
            'jquery-3.4.1.min.js',
            'jquery.cookie-1.4.1.min.js',
            'js.js',
            'bootstrap.js',
            'KozYouTubeUtils.js',
			'lightbox.js',
            'youtube.js'
		], 'js');
        echo "</footer>";
    }
}
