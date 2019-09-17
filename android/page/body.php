<?php
use head;
class body extends xlib {

    /**
     * Возвращает доски
     */
    function getDoski() {
        $ini = new ini('options');
        $bootstrap = new bootstrap();
        $xmessage = new xmessage();
        foreach($xmessage->getType() as $type) {
            $btndoski = null;
            $countDoski = 0;
            foreach ($xmessage->getDoski($type) as $doska) {
                $countDoski++;
                $count = $xmessage->getCountDoska($doska);
                $description = $ini->get($type, $doska);
                $btndoski .= $bootstrap->btn([
                    'title' => "[$doska] ($description) " . $bootstrap->span($count),
                    'href' => '/о/' . $doska,
                    'style' => 'width:100%;'
                ]);
            }
            $doski = $bootstrap->border([
                'content' => $btndoski
            ]);
            $id = uniqid();
			$btn .= $bootstrap->btn([
	 			'id' => $id,
		 		'title' => $type . ' ' . $bootstrap->span($countDoski),
                'style' => 'width: 100%;',
				'collaps' => $this->padding([
                    'top' => 15,
                    'content' => $bootstrap->collaps($doski, $id)
                ])
	 		]) ;
        }
        return $btn;
    }
    /**
     * Создание меню
     */
    function head() {
        $bootstrap = new bootstrap();
        $yandex = new yandex();
		$xmessage = new xmessage();

		/**
		 * тред форма ;)
		 */
		$tred = $bootstrap->form([
			'title' => 'Новый тред ;)',
			'id' => $tred,
			'content' => $xmessage->showTred()
		]);

		/**
		 * О сайте
		 */
		$author = $bootstrap->form([
			'title' => 'О сайте',
			'align' => 'right',
			'id' => $doska,
			'content' => $bootstrap->h('Здравствуйте вы сейчас находитесь на сайте s2s5 - слим спейс', 4) . $bootstrap->sep([
					'modal' => true
				]) .
				$bootstrap->h('Правила общее (Что делать нельзя)',4) . '1.Не обзываться<br/>2.Не мусорить<br/>3.Не придумывать новые правила<br/>4.Не пытаться сломать сайт<br/>6.Не придумывать про себя плохие мысли<br/>7.Не делать суицида из-за сайта<br/>8.Не помогать пользователям другим в суициде<br/>9.Не думать о суициде<br/>10.Не думать о наркотиках и возможность постинга также<br/>11.Не кидать плохие сайты<br/>12.Не советовать плохие советы<br/>13.Не обманывать<br/>14.Не обманывать на деньги<br/>15.Не обзывать сайт<br/>16.Не кидать где можно купить наркотики<br/>17.Не советовать плохие наркотики<br/>18.Не кидать голых девачек которым нету 18+ лет<br/>19.Не кидать запрещенных рецептов под видом разрешенных<br/>20.Не разделать себя (Все мы большая дружная семья)<br/>202.Не кидать картинки куски мясо живых людей<br/>201.Не советовать сломать клавиатуру и мышку<br/>200.Не думать то что пользователи на сайте это всего лишь какие-то аноны НЕТ! (Все мы большая дружная семья)<br/>199.Не предлогать сайты с запрещенными детскими роликами и картинками<br/>1812.Не ссорится из-за тянок (Все мы большая дружная семья)<br/>1832.Не ссорится из-за 2д или 3д то что что лучше' .
				 $bootstrap->sep([
					'modal' => true
				]) . $bootstrap->h('Правила общее (Что делать можно)',4) . '228.Можно отправлять постинг соблюдая правила<br/>229.Можно публиковать свои интересные проекты<br/>230.Можно отправлять красивые картинки<br/>231.Можно публиковать свои скрытые каналы<br/>232.Можно постить хоть столько и создавать доски также<br/>' .
				 $bootstrap->sep([
					'modal' => true
				]) . 'Спасибо что прочитали правила желаю вам удачи в постинге думаю вам понравится :)' .
				 $bootstrap->sep([
					'modal' => true
				]) . $this->padding([
						'top' => 15,
						'content' => $bootstrap->btn([
								'modalType' => 'exit',
								'modal' => true,
								'title' => 'Выйти назад в окно'
						])	
					])
		]);

		/**
		 * Доска форма ;)
		 */
		$doska = $bootstrap->form([
			'title' => 'Новая доска ;)',
			'id' => $doska,
			'content' => $xmessage->showDoska()
		]);

		/**
		 * Типы формы ;)
		 */
		$type = $bootstrap->form([
			'title' => 'Новая категория',
			'id' => $type,
			'content' => $xmessage->showType()
		]);

		/**
		 * Донат форма ;)
		 */
		$donate = $bootstrap->form([
			'title' => 'Помочь автору',
			'id' => $donate,
			'content' => $yandex->donate([
				'title' => 'На таблеточки',
				'pay' => 300,
				'width' => '100%'
			])
		]);
		return $bootstrap->btn([
       		'title' => $bootstrap->ico('send') . ' Общение',
       		'theme' => 'primary',
       		'style' => 'width: 100%;',
       		'menu' => $bootstrap->menu([
                'width' => '100%',
       			'item' => $bootstrap->item([
       				'title' => 'Новый тред',
       				'modal' => true,
       				'id' => $tred
       			]) .
       			$bootstrap->item([
       				'title' => 'Новая доска',
       				'modal' => true,
       				'id' => $doska
       			]) .
                $bootstrap->item([
       				'title' => 'Новая категория',
       				'modal' => true,
       				'id' => $type
       			]) .
       			$bootstrap->item([
       				'title' => 'Помочь автору',
       				'modal' => true,
       				'id' => $donate
       			]) .
       			$bootstrap->item([
       				'title' => 'О сайте',
       				'modal' => true,
       				'id' => $author
       			])
       		])
       	]);

    }
    
    /**
     * Возвращаем каталог картинок превью
     */
    function getImg () {
        return $this->getrand(['
			"https://static.zerochan.net/H2SO4.full.285293.jpg"' , 
			'"https://static.zerochan.net/Fukahire.full.1038198.jpg"' , 
			'"https://static.zerochan.net/IA.full.878867.jpg"' ,
			'"https://static.zerochan.net/Minami.Kotori.full.2034768.jpg"' ,
			'"https://static.zerochan.net/Kocchi.Muite.Baby.full.604692.jpg"' ,
			'"https://static.zerochan.net/Sawasawa.full.917925.jpg"' ,
			'"https://static.zerochan.net/CUL.full.421666.jpg"' ,
			'"https://static.zerochan.net/Hermione.Granger.full.1820484.jpg"' ,
			'"https://static.zerochan.net/Sawasawa.full.917949.jpg"' ,
			'"https://static.zerochan.net/Erise.full.1282638.jpg"' , 
			'"https://static.zerochan.net/Ifrit.%28Arknights%29.full.2580549.jpg"' ,
			'"https://static.zerochan.net/Yazawa.Niko.full.2580511.png"' ,
			'"https://static.zerochan.net/Ookami.Mio.full.2580505.jpg"' ,
			'"https://s1.zerochan.net/Hinata.Kaho.600.2580284.jpg"' ,
			'"https://static.zerochan.net/Hoshikawa.Mafuyu.full.2580285.jpg"' ,
			'"https://static.zerochan.net/Amano.Miu.full.2580286.jpg"'
		]);
    }
    
    /**
     * Главная страница
     */
	function execute () {
        $bootstrap = new bootstrap();
        $lightbox = new lightbox();
		$xmessage = new xmessage();
        $ini = new ini('options');
        $count = $ini->getCountSections();
        $list = $this->div([
        	'class' => 'animated bounceIn',
        	'content' => $bootstrap->panel([
        		'title' => 'Категорий ' . $bootstrap->span($count),
        		'theme' => 'primary',
        		'width' => '356',
        		'content' => $this->getDoski()
        	])
        ]);

        $head = $this->padding([
    		'top' => '10px',
    		'bottom' => '10px',
    		'content' => $this->head()
        ]);

        echo $this->div([
        		'class' => 'animated fadein',
        		'style' => 'padding-left: 10px;padding-right: 10px;',
        		'content' => $head . $list . $bootstrap->border([
	        		'content' => $lightbox->img($this->getImg())
        		])
        ]);
	}
    
    /**
     * Страница не найдена
     */
	function layout_404 () {
        $bootstrap = new bootstrap();
        $ini = new ini('options');
        $count = $ini->getCountSections();
        $list = $this->div([
        	'class' => 'animated bounceIn',
        	'style' => 'padding:10px',
        	'content' => $bootstrap->panel([
        		'title' => 'Доски ' . $bootstrap->span($count),
        		'theme' => 'primary',
        		'width' => '356',
        		'content' => $this->getDoski()
        	])
        ]);

        $head = $this->padding([
    		'top' => '10px',
    		'right' => '10px',
    		'left' => '10px',
    		'content' => $this->head()
        ]);

        echo $this->div([
        		'class' => 'animated fadein',
        		'content' => $head . $list . $this->padding([
	        		'left' => '10px',
	        		'right' => '10px',
	        		'content' => $bootstrap->border([
		        		'content' => $bootstrap->h("Страница не найдена :(",1)
	        		])
        	])
        ]);
	}

	/**
     * Страница 403
     */
	function layout_403 () {
        $bootstrap = new bootstrap();
		$xmessage = new xmessage();
        $ini = new ini('options');
        $count = $ini->getCountSections();
        $list = $this->div([
        	'class' => 'animated bounceIn',
        	'style' => 'padding:10px',
        	'content' => $bootstrap->panel([
        		'title' => 'Доски ' . $bootstrap->span($count),
        		'theme' => 'primary',
        		'width' => '356',
        		'content' => $this->getDoski()
        	])
        ]);

        $head = $this->padding([
    		'top' => '10px',
    		'right' => '10px',
    		'left' => '10px',
    		'content' => $this->head()
        ]);

        echo $this->div([
        		'class' => 'animated fadein',
        		'content' => $head . $list . $this->padding([
	        		'left' => '10px',
	        		'right' => '10px',
	        		'content' => $bootstrap->border([
		        		'content' => $bootstrap->h("Это не страница а папка сайт может открыть только страницу! :(",1) . $bootstrap->h("Пожалуйста вернитесь на главную страницу!") . $bootstrap->btn([
		        				'title' => "Вернуться на главную страницу",
		        				'href' => "/?i=1"
		        			])
	        		])
        	])
        ]);

	}
	
	/**
	 * Возвращаем тред
	 */
	function layout_tred () {
		$xmessage = new xmessage();
        $bootstrap = new bootstrap();
        $ini = new ini('options');
        $count = $ini->getCountSections();
		$sql = $this->getmysql();
		$result = mysqli_query($sql , "SELECT * FROM `view` WHERE 1");
		$selected = $this->geturi(2);
		while ($row = mysqli_fetch_array($result)) {
			if($row['title'] != null && $row['selected'] == $selected) {
				$tred .= $bootstrap->btn([
					'theme' => $this->getrand(['danger', 'primary', 'success']),
					'title' => $row['title'],
					'href' => "/о/$selected/" . $row['uuid']
				]);
			}
		}

        $list = $this->div([
        	'class' => 'animated bounceIn',
        	'style' => 'padding:10px',
        	'content' => $bootstrap->panel([
        		'title' => 'Доски ' . $bootstrap->span($count),
        		'theme' => 'primary',
        		'width' => '356',
        		'content' => $this->getDoski()
        	])
        ]);

        $head = $this->padding([
    		'top' => '10px',
    		'right' => '10px',
    		'left' => '10px',
    		'content' => $this->head()
        ]);

        echo $this->div([
        		'class' => 'animated fadein',
        		'content' => $head . $list . $this->padding([
	        		'left' => '10px',
	        		'right' => '10px',
	        		'content' => $bootstrap->border([
		        		'content' => $tred
	        		])
        	])
        ]);
	}

	/** 
	 * Возвращает подключенные посты
	 */
	function layout_post () {
		$xmessage = new xmessage();
        $bootstrap = new bootstrap();
        $lightbox = new lightbox();
        $youtube = new youtube();
        $ini = new ini('options');
        $count = $ini->getCountSections();
        $list = $this->div([
        	'class' => 'animated bounceIn',
        	'style' => 'padding:10px',
        	'content' => $bootstrap->panel([
        		'title' => 'Доски ' . $bootstrap->span($count),
        		'theme' => 'primary',
        		'width' => '356',
        		'content' => $this->getDoski()
        	])
        ]);

        $head = $this->padding([
    		'top' => '10px',
    		'right' => '10px',
    		'left' => '10px',
    		'content' => $this->head()
        ]);

        echo $this->div([
        		'class' => 'animated fadein',
        		'content' => $head . $list . $this->padding([
	        		'left' => '10px',
	        		'right' => '10px',
	        		'content' => $bootstrap->border([
		        		'content' => $xmessage->sendpost()
	        		])
        	])
        ]);
	}

}
