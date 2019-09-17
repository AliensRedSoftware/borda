<?php
class head extends xlib {
	
	/**
	 * Выполнить
	 * ----------
	 */
	function __construct () {
		$skinmanager	=	new	skinmanager();
    	$skinmanager->setDefault('bootstrap337');
    	$skinmanager->ApplySkin();
    }

	/**
	 * Выполнить
	 * ----------
	 * title - Загаловок
	 */
	function execute ($title) {
		$this->ico('ico.png');
		$this->setTitle($title);
		$this->utf8();
		$this->description("s2s5 - слим спейс");
		$this->tag("Аниме, Картинки, Пикчи, +100500, Порно");
		$this->add_css(['animate.css']);
    }
}
