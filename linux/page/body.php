<?php
use head;

/**
 * Тело сайта
 * -----------
 * Merkus
 */
class body extends xlib {

	/**
	 * Возвращаем меню которая сверху
	 * -------------------------------
	 * @return string
	 */
	protected function getMenuHight () {
		//-->Подключение классов
		$xmessage		=	new xmessage();
		$skinmanager	=	new skinmanager();
		$yandex			=	new yandex();
		$xlayout		=	new xlayout();
		//--
		$skinmanager->getSettings();//Возвращаем меню с настройками skinmanager
		//-->Модальная форма (#newSpace)
		$skinmanager->modal([
			'id'		=>	'newSpace',
			'title'		=>	'Создание нового пространство' . $xmessage->getVersion(),
			'content'	=>	$xmessage->getCreateSpace()
		]);
		//-->Модальная форма (#newPoint)
		$skinmanager->modal([
			'id'		=>	'newPoint',
			'title'		=>	'Создание новой точки' . $xmessage->getVersion(),
			'content'	=>	$xmessage->getCreateDot()
		]);
		//-->Модальная форма (#donate)
		$skinmanager->modal([
			'id'		=>	'donate',
			'title'		=>	$skinmanager->ico('heart') . ' ' . 'Помочь автору' . $yandex->getVersion(),
			'content'	=>	$yandex->donate()
		]);
		//-->Открытие формы модальной (#donate)
		$donate = $skinmanager->a([
					'title'	=>	$skinmanager->ico('heart') . ' ' . 'Помочь автору :)',
					'href'	=>	'#donate',
					'modal'	=>	'donate'
				]);
		$menu = $skinmanager->dropdown([
					$skinmanager->ico('comment') . ' ' . 'Общение' => [
						'item' => [
							'Новая пространство'	=>	['href' => '#newSpace',	'modal' => true],
							'Новая точка'			=>	['href' => '#newPoint',	'modal' => true]
						]
					],
					$skinmanager->ico('bell') . ' ' . 'Социальные сети' => [
						'content' => [' ', $donate, ' '],
						'item' => [
							'Мы в дискорде'		=> ['href' => 'https://discordapp.com/invite/A4GWdAM'],
							'Мы в телеграмме'	=> ['href' => 'https://t.me/http_s2s5']
						]
					],
					$skinmanager->ico ('cog') . ' ' . 'Дополнительные' => [
						'content' => [' '],
						'item' => [
							$skinmanager->ico('adjust') . ' ' . 'Скин менеджер' => ['href' => '#skinmanager', 'modal' => true]
						]
					]
			]);
		return	$skinmanager->border(['content' => $menu]);
	}

	/**
	 * Возвращаем sidebar
	 * -------------------
	 * @return string
	 */
	public function sidebar () {
		$xmessage = new xmessage();
		return $this->div([
        	'css'		=>	['padding' => '10px'],
        	'class'		=>	'animated fadeIn',
			'content'	=>	$xmessage->getDot()
		]);
	}

	/**
     * Возвращаем макет главной страницы
	 * ----------------------------------
	 * content - контент
	 * ----------------------------------
	 * @return string
     */
	public function layout ($content = 'Привет') {
		$skinmanager	=	new skinmanager();
		$xlayout		=	new xlayout();
        $AnimeSvg		=	new AnimeSvg();
    	$anime = $AnimeSvg->getAnime([
        	'width'	=>	'85%',
        	'css'	=>	[
						 'position'			=> 'fixed',
						 'margin-top'		=>	'-10px',
						 'margin-right'		=>	'-10px',
						 'opacity'			=>	'0.15',
						 'z-index'			=>	'999',
						 'pointer-events'	=>	'none'
						],
        	'hair'	=>	'gray',
        	'body'	=> 'lightpink'
        ]);
		$xlayout->setLeft_aside(350, $this->sidebar());
		return $xlayout->get($this->div([
        				'class'		=>	'animated fadeIn',
        				'css'		=>	[
											'margin-top'	=>	'10px',
											'margin-right'	=>	'10px'
										],
						'content'	=>	$anime . $this->getMenuHight() . $content
					])
				);
	}

	/**
	 * Возвращаем все нити
	 * -------------------
	 */
	function getlist() {
		$xmessage		=	new xmessage();
		$skinmanager	=	new skinmanager();
		require_once '.' . $this->getPathModules('capi/execute/getMsg.php');
		$getMsg			=	new getMsg();
		$list			=	[];
		foreach($xmessage->getDotToArray() as $dot) {
			foreach ($xmessage->getSpace($dot) as $space) {
				$msg = $getMsg->Msg($space, $dot);
				foreach ($msg as $id => $data) {
					array_push($list, $xmessage->getThread($id, 5, $skinmanager->a(['title' => 'Открыть', 'href' => "о/$dot/$space/$id"])));
				}
			}
		}
		return $list;
	}

    /**
     * Возвращаем главная страница
     * ----------------------------
     * @return string
     */
	public function execute () {
		$skinmanager	=	new skinmanager();
  		$xcatalog		=	new xcatalog();
    	$content		=	$xcatalog->getPagination([
        							'max'		=> 5,
        							'indent'	=> 5,
        							'content'	=> $this->getlist()]);
		echo $this->layout($content);
	}

    /**
     * Возвращаем (404)
     * -----------------
     * @return string
     */
	function layout_404 () {
		$skinmanager	=	new skinmanager();
		$img			=	$skinmanager->img(['src' => "https://i.gifer.com/yH.gif"]);
		$content = $skinmanager->panel([
							'title'		=>	'Страница не найдена 404 :)',
							'css'		=>	['text-align' => 'center'],
							'content'	=>	$img
						]);
		echo $this->layout($content);
	}

	/**
     * Возвращаем (403)
     * -----------------
     * @return string
     */
	function layout_403 () {
		$skinmanager	=	new skinmanager();
		$img			=	$skinmanager->img([
								'src'	=>	"https://i.gifer.com/yH.gif"
							]);
		$content = $skinmanager->panel([
						'title'		=>	'Страница недоступная 403 :)',
						'content'	=>	$img
					]);
		echo $this->layout($content);
	}

	/**
     * Возвращаем страницу с post запросами
	 * -------------------------------------
	 * @return string
     */
	public function layout_post ($title, $content) {
		$skinmanager	=	new skinmanager();
		$content		=	$skinmanager->panel([
								'title'		=>	$title,
								'content'	=>	$content
							]);
		die($this->layout($content));
	}

	/**
	 * Возвращаем точки
	 */
	public function layout_Dot () {
		$skinmanager	=	new skinmanager();
  		$xcatalog		=	new xcatalog();
		$xmessage		=	new xmessage();
		$dot			=	$this->geturi(2);
		$list			=	[];
		foreach ($xmessage->getSpace($dot) as $space) {
			foreach ($xmessage->getIdToArray($space, $dot) as $id) {
				array_push($list, $xmessage->getThread($id, 5, $skinmanager->a(['title' => 'Открыть', 'href' => "/о/$dot/$space/$id"])));
			}
		}
		$newSpace 		=	$skinmanager->panel(['title' => 'Новое пространство', 'content' => $xmessage->getCreateSpace($dot)]);
    	$content		=	$newSpace . $xcatalog->getPagination([
        							'max'		=> 5,
        							'indent'	=> 5,
        							'content'	=> $list]);
		echo $this->layout($content);
	}
	/**
	 * Возвращаем нити
	 * ----------------
	 * @return string
	 */
	function layout_Thread () {
		$xmessage		=	new xmessage();
		$skinmanager	=	new skinmanager();
		$list			=	[];
		$dot			=	$this->geturi(2);
		$space			=	$this->geturi(3);
		$_REQUEST['dot']=	$dot;
		foreach ($xmessage->getIdToArray($space, $dot) as $id) {
			array_push($list,  $xmessage->getThread($id, 5, $skinmanager->a(['title' => 'Открыть', 'href' => "/о/$dot/$space/$id"])));
		}
		$xcatalog		=	new xcatalog();
    	$content		=	$xcatalog->getPagination([
        						'max'		=> 5,
        						'indent'	=> 5,
        						'content'	=> $list]);
		$threads		=	$skinmanager->panel([
									'title'		=>	'Новая нить :)',
									'content'	=>	$xmessage->getCreateThread()
								]);
		if (!$list) {
			$content = $skinmanager->panel([
				'title'	=>	'Оповещение :)',
				'content' => 'Если вы видите данное оповещение значит это нить пустая </br>Вы первый кто может создать в этой нить :)'
			]);
		}
		echo $this->layout($threads . $content);
	}

	/**
	 * Возвращаем мульти форму + нить
	 * -------------------------------
	 * id	-	Адрес нити
	 * @return string
	 */
	function layout_multiForm ($id = false) {
		$xmessage		=	new xmessage();
		$content		=	$xmessage->multiForm($id);
		echo $this->layout($content);
		/*
		die();
		$xmessage = new xmessage();
		$bootstrap = new bootstrap();
		$tred = $this->div([
				'id' => 'response',
				'style' => 'word-wrap: break-word;',
				'content' =>
				$bootstrap->panel([
					'title' => $id,
					'align' => 'left',
					'content' => $content
			])
		]);
        $list = $this->getMenu();
        $head = $this->padding([
    		'top' => '10px',
    		'bottom' => '10px',
    		'content' => $this->head()
        ]);
        echo $this->div([
        		'class' => 'animated fadein',
			'style' => 'display: flex;',
        		'content' => $list . $this->padding([
	        		'right' => '10px',
				'style' => 'width: 70%;',
	        		'content' => $head . $bootstrap->border([
		        		'content' => $xmessage->sendPost()
	        		])
        	])
        ]);*/
	}


}
