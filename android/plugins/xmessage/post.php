<?php
class post {
	
	/**
	 * Добавить новый пост
	 */
	function pushpost ($name, $description, $vidos, $img) {
		$id = $_POST['post_index'];
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		require_once '../../../../mysql.php';
		$mysql = new mysql();
		$sql = mysqli_connect($mysql->ip, $mysql->user , $mysql->password, $mysql->database);
		//ДОП+++++++++
		$time = date('Y-m-d') . '=>' . date('H:i:s', time() - date('Z'));
		mysqli_query($sql , "INSERT INTO `$id` (`id` , `text` , `name` , `vidos` , `img` , `time`) VALUES (NULL , '$description' , '$name' , '$vidos' , '$img' , '$time');");
		require_once 'refresh.php';
		$event = new refresh();
		mysqli_close($sql);
	}

    function execute () {
	    $name = trim($_POST['name']);//Имя
	    $description = trim($_POST['text']);//Имя
	    $video = trim($_POST['vs']);
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		require_once '../youtube/youtube.php';
		$youtube = new youtube();
		if($name == null){$name = 'Неизвестный';} //Проверка на имя
		if(strlen($description) >= 8096) { //Проверка на кол-во описание
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести описание не более 8096 символов.', 'danger');
			die();
		}
		if(strlen($name) <= 6) { //Проверка на кол-во имя
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести имя более 6 символов.', 'danger');
			die();
		}
		if(strlen($name) >= 32) { //Проверка на кол-во имя
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . 'Нужно ввести имя не более 32 символов.', 'danger');
			die();
		}
		$postname = $xlib->isCharArray(['>', '<', '"'], $name);//Имя
	    if ($postname == true) {
	    	echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такой символ <b>$postname</b> нельзя использовать в имени!", 'danger');
	    	die();
	    } 
	    $postdescription = $xlib->isCharArray(['>', '<', '"'], $description);//Описание
	    if ($postdescription == true) {
	    	echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "такой символ <b>$postdescription</b> нельзя использовать в описание!", 'danger');
	    	die();
	    }
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
		if (trim($text) == null && trim($src_video) == null && trim($src_img) == null) {
			echo $bootstrap->alert($bootstrap->ico('exclamation-sign') . "Пустой пост не отправить :)", 'danger');
			die();
		}
	    $this->pushpost($name, trim($text), $src_video, $src_img);//Отправка поста
	}
}

$event = new post();
$event->execute();
