<?php

/**
 * Кнопка поднятие вверх
 */
class backToTop {
	
	/**
	 * Создание кнопки наверх
	 */
	public function execute ($title = 'Подняться наверх!') {
		echo "<div class='back-to-top' id='back-to-top' title='$title'></div>";
	}
}