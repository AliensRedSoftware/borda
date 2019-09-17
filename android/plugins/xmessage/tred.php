<?php
class tred {
	
	/**
	 * Создание треда
	 */	
	function createtred ($title, $name, $description, $selected, $video) {
        $id = $_POST['post_index'];
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		require_once '../youtube/youtube.php';
		$youtube = new youtube();
		$id = uniqid(); //Сгенерировать уникальный ID
		//ДОП+++++++++
		$time = date('Y-m-d') . '=>' . date('H:i:s', time() - date('Z'));
		//ДОП+++++++++
		//Видео
		$uri = null;
		$text = null;
		$descriptionArray = explode("\n", $description);
		foreach ($descriptionArray as $description) {
			$text .= "\n";
			$ls = explode(' ', $description);
			foreach ($ls as $value) {
				$url = $xlib->isCharArray(['https://'], $value);
				if ($url == true) {
					$notyoutube = $xlib->isCharArray(['youtube','youtu'], $value);
					if ($notyoutube == false) {
						$uri .= $value . ' ';
					}
				} else {
					$text .= $value . ' ';
				}
			}
		}

		//Картинки
		if ($uri != null) {
			$imghref = explode(" ", trim($uri));
			$successlistimg = $xlib->getCheckMd5Array($imghref);
	        foreach ($successlistimg as $value) {
				$src_img .= $value . ' ';
			}
		}
		if ($video != null) {
			$successlistvidos = $youtube->getCheckMd5Array(explode(" " , $video));
			foreach ($successlistvidos as $value) {
				$src_video .= $value . ' ';
			}
		}
		require_once '../../../../mysql.php';
		$mysql = new mysql();
		$sql = mysqli_connect($mysql->ip, $mysql->user , $mysql->password, $mysql->database);
		mysqli_multi_query($sql , 
"CREATE TABLE `$mysql->database`.`$id` ( `id` INT NOT NULL AUTO_INCREMENT , `text` TEXT NOT NULL , `name` VARCHAR(32) NOT NULL , `time` VARCHAR(24) NOT NULL , PRIMARY KEY (`id`) , `vidos` TEXT NOT NULL , `img` TEXT NOT NULL) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;" .
"INSERT INTO `$id` (`id` , `text` , `name` , `vidos` , `img` , `time`) VALUES (NULL , '$text', '$name' , '$src_video' , '$src_img', '$time');" . 
"INSERT INTO `view` (`id`, `name`, `description`, `title`, `selected`, `uuid`) VALUES (NULL, '$name', '$description', '$title' , '$selected' , '$id');"
);
		$xlib->isDir("../../../uri/о/$selected");
		file_put_contents("../../../uri/о/$selected/$id.php" , '<?php
class ftk extends xlib {
    function __construct() {
        $this->req(["head", "body", "footer"]);
        $head = new head();
        $body = new body();
        $footer = new footer();
        $this->execute($head, $body, $footer);
    }
    
    function execute($head, $body, $footer) {
        $head->execute(' . "'$title'" . ');
        $body->layout_post();
        $footer->execute();
    }
}');
		chmod("../../../uri/о/$selected/$id.php", 0777);
		mysqli_close($sql);
		$xlib->js("document.location.href = \"/о/$selected/$id\";");
	}
    
	/**
	 * Пред просмотра треда
	 */	
	function previwgen ($title, $name, $description, $selected, $video) {
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		require_once '../lightbox/lightbox.php';
		$lightbox = new lightbox();
		require_once '../youtube/youtube.php';
		$youtube = new youtube();
		//ДОП+++++++++
		$time = date('Y-m-d') . '=>' . date('H:i:s', time() - date('Z'));
		//ДОП+++++++++
		$uri = null;
		$text = null;
		$descriptionArray = explode("\n", $description);
		foreach ($descriptionArray as $description) {
			$text .= "\n";
			$ls = explode(' ', $description);
			foreach ($ls as $value) {
				$url = $xlib->isCharArray(['https://'], $value);
				if ($url == true) {
					$notyoutube = $xlib->isCharArray(['youtube','youtu'], $value);
					if ($notyoutube == false) {
						$uri .= $value . ' ';
					}
				} else {
					$text .= $value . ' ';
				}
			}
		}
		
		//Картинки
		if ($uri != null) {
			$imghref = explode(" ", trim($uri));
			$successlistimg = $xlib->getCheckMd5Array($imghref);
	        foreach ($successlistimg as $value) {
				$src_img .= $xlib->margin([
						'all' => 10,
						'content' => $bootstrap->border([
							'content' => $lightbox->img($value, 240)
					])
				]);
			}
		}
		if ($video != null) {
			$successlistvidos = $youtube->getCheckMd5Array(explode(" " , $video));
			foreach ($successlistvidos as $value) {
				$src_video .= $xlib->margin([
					'all' => 5,
					'content' => $youtube->video($value, 420, 240)
				]);
			}
		}
		if (trim($text) == null) {
			echo $bootstrap->panel([
				'align' => 'left',
				'title' => $xlib->div([
					'style' => 'word-wrap: break-word;',
					'content' => "[0]->[$time]->$name"
				]),
				'content' => $xlib->getHtml("<div style=\"display:flex;flex-wrap:wrap;\">$src_video $src_img</div>")
			]);
		} else {
			foreach (explode(" ", $text) as $value) {
				$textSend .= $value . ' ';
			}
			$space = explode("\n", trim($textSend));
			foreach ($space as $value) {
				if ($value != null) {
					$desc .= $value . "<br/>";
				}
			}
			if($space == null) {
				$desc = $textSend;
			}
			echo $bootstrap->panel([
				'align' => 'left',
				'title' => $xlib->div([
					'style' => 'word-wrap: break-word;',
					'content' => "[0]->[$time]->$name"
				]),
				'content' => $xlib->div([
					'style' => 'word-wrap: break-word;',
                    "content" => trim($desc)
                    ]) . $xlib->getHtml("<div style=\"display:flex;flex-wrap:wrap;\">$src_video $src_img</div>")
			]);
		}
	}

	/**
	 * Выполнить команду
	 */
    function execute () {
        $title = trim($_POST['title']);//Название
        $name = trim($_POST['name']);//Имя
        $selected = trim($_POST['selected']);//Выбранная доска
        $description = trim($_POST['text']);//Текст
        $video = $_POST['vs'];
        $event = $_POST['event'];//Действие
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		if($name == null){$name = 'Неизвестный';} //Проверка на имя
		if(strlen($description) >= 8096) { //Проверка на кол-во описание
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести описание не более 8096 символов.', 'danger');
			die();
		}		
		if(strlen($description) == 0) { //Проверка на кол-во описание
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести описание более 0 символов.', 'danger');
			$xlib->js("$('#text').val(null);");
			die();
		}
		if(strlen($name) <= 6) { //Проверка на кол-во имя
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести имя более 6 символов.', 'danger');
			$xlib->js("$('#title').val(null);");
			die();
		}
		if(strlen($name) >= 32) { //Проверка на кол-во имя
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести имя не более 32 символов.', 'danger');
			die();
		}
		if(strlen($title) <= 6) { //Проверка на кол-во название 
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести название более 6 символов.', 'danger');
			$xlib->js("$('#title').val(null);");
			die();
		}
		//Проверка на бажность символьность
		$posttitle = $xlib->isCharArray(['>', '<', '"'], $title);//Название
        if ($posttitle == true) {
        	echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такой символ <b>$posttitle</b> нельзя использовать в название!", "danger");
        	die();
        }
        $postname = $xlib->isCharArray(['>', '<', '"'], $name);//Имя
        if ($postname == true) {
        	echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такой символ <b>$postname</b> нельзя использовать в имени!", "danger");
        	die();
        } 
        $postdescription = $xlib->isCharArray(['>', '<', '"'], $description);//Описание
        if ($postdescription == true) {
        	echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такой символ <b>$postdescription</b> нельзя использовать в описание!", "danger");
        	die();
        }
        if ($event == 'Создать тред') {
        	$this->createtred($title, $name, $description, $selected, $video);//Создание треда ;)
        } else {
        	$this->previwgen($title, $name, $description, $selected, $video);//Просмотр превью треда
        }
    }
}
$event = new tred();
$event->execute();
