<?php
class head extends xlib {
    
	function execute ($title) {
		$this->ico('ico.png');
		$this->setTitle($title);
		$this->utf8();
		$this->description("s2s5 - слим спейс");//О сайте
		$this->tag("Аниме , картинки , пикчи");
		$this->loader_css();
		$this->add_js(['jquery-3.4.1.min.js']);
    }
}
