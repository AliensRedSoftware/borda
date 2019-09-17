<?php
class doska {
	
	/**
	 * Создать доску
	 */
	function newdoska ($name, $description, $type) {
		require_once '../ini/ini.php';
		$ini = new ini('options');
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
		require_once '../xlib/xlib.php';
		$xlib = new xlib();
		require_once '../../../../options.php';
		$options = new options();
		$list = $ini->getKeys($type);
		if ($ini->is_key($type, $name) == true) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Не удается создать доску потому что такая уже есть!", 'danger');
			die();
		}
		foreach ($list as $key) {
			if ($ini->get($type, $key) == $description) {
				echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Не удается создать доску потому что доска с таким описанием уже есть!", 'danger');
				die();
			}
		}
        $ini->set($type, $name, $description);
		file_put_contents("../../../uri/о/$name.php" , '<?php
class ftk extends xlib {
    function __construct() {
        $this->req(["head", "body", "footer"]);
        $head = new head();
        $body = new body();
        $footer = new footer();
        $this->execute($head, $body, $footer);
    }
    function execute ($head, $body, $footer) {
        $selected = urldecode($this->geturi(2));
        $head->execute("/о/" . $selected);
        $dir = scandir(mb_substr($this->getTheme(), 1) . "uri/о/" . $selected);
        $body->layout_tred($dir);
        $footer->execute();
    }
}
');
		mkdir("../../../uri/о/$name");
		echo $bootstrap->alert($bootstrap->ico('info-sign') . "Доска успешно создалась <a href='/о/$name' class='alert-link'>{Перейти в созданную доску}</a>.", 'success');
		$xlib->js("document.location.href = \"/о/$name\";");
	}

	/**
	 * Создание доски
	 */
    function execute () {
        $name = trim($_POST['title']);
        $description = trim($_POST['description']);
		$type = $_POST['type'];
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		if($name == null) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Название доски не должно быть пустое!", 'danger');
			$xlib->js("$('input#title').val(null);");
			die();
		}
		if($description == null) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Описание не должно быть пустое!", 'danger');
			$xlib->js("$('input#description').val(null);");
			die();
		}
		if(strlen($name) >= 16) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Символов в название не более чем 15", 'danger');
			die();
		}
		if(strlen($description) >= 30) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Символов в описание краткое не более чем 30", 'danger');
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
		$badDescription = $xlib->isCharArray($char, $description);
		if ($badDescription == true) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такой символ <b>[$badDescription]</b> нельзя использовать", 'danger');
			die();
		}
		$badDescription = $xlib->isCharArray($number, $description);
		if ($badDescription == true) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такую цифру <b>[$badDescription]</b> нельзя использовать", 'danger');
			die();
		}
		$this->newdoska($name, $description, $type);//Создать новую доску
	}
}
$event = new doska();
$event->execute();
