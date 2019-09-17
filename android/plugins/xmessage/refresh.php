<?php
class refresh {
	
	function execute () {
		$id = $_POST['post_index'];
		require_once '../../../../mysql.php';
		$mysql = new mysql();
		$sql = mysqli_connect($mysql->ip, $mysql->user , $mysql->password, $mysql->database);
        require_once '../bootstrap/bootstrap.php';
		$bootstrap = new bootstrap();
        require_once '../xlib/xlib.php';
		$xlib = new xlib();
		require_once '../lightbox/lightbox.php';
		$lightbox = new lightbox();
		require_once '../youtube/youtube.php';
		$youtube = new youtube();
		$result = mysqli_query($sql , "SELECT * FROM `$id` ORDER BY `id` DESC");
		$content = '';
		while ($row = mysqli_fetch_array($result)) {
			$name = $row['name'];
			$description = trim($row['text']);
			$vidos = trim($row['vidos']);
			$imgserver = trim($row['img']);
			$time = $row['time'];
			$src_video = "";
			$src_img = "";
			$index++;
			if($imgserver != null) {
				$imghref = explode(" " , $imgserver);
				foreach ($imghref as $value_img) {
					$src_img .= $xlib->padding([
						'all' => 5,
						'content' => $bootstrap->border([
							'content' => $lightbox->img($value_img, 240)
						])
					]);
				}
			}
			if ($vidos != null) {
				$vidoshref = explode(' ' , $vidos);
				foreach ($vidoshref as $value_vidos) {
					$src_video .= $xlib->padding([
						'all' => 5,
						'content' => $youtube->video($value_vidos, 420, 240)
					]);
				}
			}
            if ($description != null) {
				$description = null;
				$space = explode("\n", trim($row['text']));
				foreach ($space as $value) {
					$description .= $value . "<br/>";
				}
				if($space == null) {
					$description = $row['text'];
				}
        		$content .= $bootstrap->panel([
					'align' => 'left',
					'title' => $xlib->div([
						'style' => 'word-wrap: break-word;',
						'content' => "[0]->[$time]->$name"
					]),
					'content' => $xlib->div([
						'style' => 'word-wrap: break-word;',
		                "content" => trim($description)
		                ]) . $xlib->getHtml("<div style=\"display:flex;flex-wrap:wrap;\">$src_video $src_img</div>")
				]);
			} else {
				$content .= $bootstrap->panel([
					'align' => 'left',
					'title' => $xlib->div([
						'style' => 'word-wrap: break-word;',
						'content' => "[0]->[$time]->$name"
					]),
					'content' => $xlib->getHtml("<div style=\"display:flex;flex-wrap:wrap;\">$src_video $src_img</div>")
				]);
			}
		}
		echo $bootstrap->panel([
			'align' => 'left',
			'title' => $id,
			'content' => $content
		]);
	}
}
$event = new refresh();
$event->execute();
