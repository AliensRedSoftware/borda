<?php
class doska {
	
	/**
	 * Создать новую категорию
	 */
	function newtype ($name) {
		require_once '../ini/ini.php';
		$ini = new ini('options');
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
		require_once '../xlib/xlib.php';
		$xlib = new xlib();
		require_once '../../../../options.php';
		$options = new options();
        $list = $ini->getSections();
        foreach ($list as $val) {
            if ($name == $val) {
				echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Не удается создать категорию потому что такая уже есть!", 'danger');
				die();
            }
        }
		$ini->addSection($name);
		
		echo $bootstrap->alert($bootstrap->ico('info-sign') . "Категория успешно создалась ;)", 'success');
		//$xlib->js("document.location.href = \"/о/$name\";");
	}

	/**
	 * Создание доски
	 */
    function execute () {
        $name = trim($_POST['title']);
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		if($name == null) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Название доски не должно быть пустое!", 'danger');
			$xlib->js("$('input#title').val(null);");
			die();
		}
		if(strlen($name) >= 16) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Символов в название не более чем 15", 'danger');
			die();
		}
		$char = $xlib->getCharToArray();
		$number = $xlib->getNumberToArray();
		$badName = $xlib->isCharArray($char, $name);
		if ($badName == true) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такой символ <b>[$badName]</b> нельзя использовать", 'danger');
			die();
		}
		$badName = $xlib->isCharArray($number, $name);
		if ($badName == true) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такую цифру <b>[$badName]</b> нельзя использовать", 'danger');
			die();
		}
		$this->newtype($name);
	}
}
$event = new doska();
$event->execute();
