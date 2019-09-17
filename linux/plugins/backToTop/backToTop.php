<?php

/**
 * Кнопка поднятие вверх
 */
class backToTop {
	
	protected $align = 'bottom: 0px;', $color = '#374760', $colorHover = '#3cc091', $title = 'Подняться наверх!', $width = 40, $height = 40, $margin_left = 'margin-left: 40px;', $margin_bottom = 'margin-bottom: 40px;', $animation = 'bounce';

	/**
	 * Создание кнопки наверх
	 */
	public function getHtml () {
		$jquery = new jquery();
		$xlib = new xlib();
		$color = $this->color;
		$colorHover = $this->colorHover;
		$title = $this->title;
		$align = $this->align;
		$width = $this->width;
		$height = $this->height;
		$margin_left = $this->margin_left;
		$margin_bottom = $this->margin_bottom;
		$animation = $this->animation;
		$animShow = $animation . 'in';
		$animExit = $animation . 'Out';
		$js = "$(window).scroll(function(){ return $(window).scrollTop() > 200 ? $('#back-to-top').addClass('show $animShow').removeClass('$animExit') : $('#back-to-top').removeClass('$animShow').addClass('$animExit')}),$('#back-to-top').click(function() {return $('html,body').animate({scrollTop: '0'})});";
		$jquery->addLoad($js);
		$style = "<style>.back-to-top{visibility: visible;position: fixed;background-color: $color;width: $width;height: $height;$align cursor: pointer;opacity: 0;$margin_left $margin_bottom}.back-to-top:hover{background-color: $colorHover;opacity: 1}.back-to-top.show {visibility: visible;position: fixed;$align z-index: 90;opacity: 1;transition: all .6s;}</style>";
		return $style . "<div class='back-to-top animated show $animExit' id='back-to-top' title='$title'></div>";
	}

	/**
	 * Устанавливает расположение
	 */
	public function setAlign ($align = 'left') {
		if ($align == 'bottom-left') {
			$align = 'bottom: 0px;';
		} 
		if ($align == 'left') {
			$align = 'bottom: 50%;';
		}
		if ($align == 'center') {
			$align = 'bottom: 50%;';
			$align .= 'left: 50%;';
		}
		if ($align == 'right') {
			$procent = 100 - $this->width / 10;
			$align = "bottom: 50%;";
			$align .= "left: $procent%;";
		}
		if ($align == 'top') {
			$align = "bottom: 0%;";
			$align .= "left: 50%;";
		}
		if ($align == 'bottom') {
			$procent = 100 - $this->height / 10;
			$align = "bottom: $procent%;";
			$align .= "left: 50%;";
		}
		if ($align == 'bottom-right') {
			$procentwidth = 100 - $this->width / 10;
			$align = "bottom: 0;";
			$align .= "left: $procentwidth%;";
		}
		if ($align == 'top-right') {
			$procentwidth = 100 - $this->width / 10;
			$align = "bottom: 5%;";
			$align .= "left: $procentwidth%;";
		}
		$this->align = $align;
	}

	/**
	 * Устанавливает подсказку
	 */
	public function setTitle ($title = 'Подняться наверх!') {
		$this->title = $title;
	}

	/**
	 * Устанавливает Цвет
	 */
	public function setColor ($color = '#374760') {
		$this->color = $color;
	}

	/**
	 * Устанавливает Ширину
	 */
	public function setWidth ($width = '40px') {
		$this->width = $width;
	}

	/**
	 * Устанавливает Высоту
	 */
	public function setHeight ($height = '40px') {
		$this->width = $height;
	}

	/**
	 * Устанавливает отступ слева
	 */
	public function setPaddingLeft ($value = '40px') {
		$this->margin_left = "margin-bottom: $value;";
	}

	/**
	 * Устанавливает от низа
	 */
	public function setPaddingBottom ($value = '40px') {
		$this->margin_bottom = "margin-bottom: $value;";
	}

	/**
	 * Устанавливает анимацию
	 */
	public function setAnimation ($name = 'bounce') {
		$this->animation = $name;
	}

	/**
	 * Устанавливает Цвет выделение
	 */
	public function setColorHover ($color = '#3cc091') {
		$this->colorHover = $color;
	}
}
