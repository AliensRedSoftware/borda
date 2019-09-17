<?php

/**
 * youtube дополнительные функций
 * v1.0
 */
class youtube {

	/**
	 * Возвращает видео с ютуба
	 */
	public function video ($data_embed = 'BcZ8oZAJnhk', $width = 240, $height = 240) {
		return "<div class='youtube' data-embed='$data_embed' style='width:$width;height:$height;'><div class='play-button'></div></div>";
	}

	/**
	 * Возвращает видео с ютуба
	 */
	public function getCheckMd5Array(array $iteam) {
		$i = -1;
		$successlistvidos = [];
		foreach ($iteam as $d) {
			if (trim($d) != null) {
				$value_img = "https://img.youtube.com/vi/" . $d . "/sddefault.jpg";
				$imagefile = getimagesize($value_img);
				$width = $imagefile[0];
				$height = $imagefile[1];
				if ($width == 0 && $height == 0) {
				} else {
					$currentmd5 = md5_file($value_img);
					array_push($successlistvidos, $d);
					array_shift($iteam);
					$next = $iteam;
					foreach ($next as $key) {
						$kcs = "https://img.youtube.com/vi/" . $key . "/sddefault.jpg";
						if ($currentmd5 == md5_file($kcs)) {
							array_pop($successlistvidos);
						}
					}
				}
			}
		}
		return $successlistvidos;
	}
}