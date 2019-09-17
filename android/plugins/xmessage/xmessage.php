<?php
class xmessage {

    /**
     * Возвращает кол-во тредов в доске
	 * $id - название доски
     */
    public function getCountDoska ($id) {
		$xlib = new xlib();
		$path = '.' . $xlib->getTheme() . "uri/о/$id";
		if (is_dir($path) == false) {
			return -1;
		}
		$iteam = scandir($path);
		$i = 0;
		foreach ($iteam as $value) {
			if ($value != '.' && $value != '..') {
				$i++;
			}
		}
		return $i;
    }

    /**
     * Возвращает опцию доски
     */
    public function getOptions () {
        $bootstrap = new bootstrap();
        $type = $this->getType();
		foreach ($type as $val) {
			$list = $this->getDoski($val);
			foreach ($list as $ass) {
				$options .= $bootstrap->opt($ass);
			}
		}
        return $options;
    }

    /**
     * Возвращает опцию доски
     */
    public function getOptionsType () {
        $bootstrap = new bootstrap();
        $list = $this->getType();
		foreach ($list as $val) {
            $options .= $bootstrap->opt($val);
		}
        return $options;
    }

    /**
     * Возвращает доски в виде массива
	 * $type - Категорий доски
     */
    public function getDoski ($type) {
		$ini = new ini('options');
		$list = $ini->getKeys($type);
		return $list;
    }

    /**
     * Возвращает категорий в виде массива
     */
    public function getType () {
		$ini = new ini('options');
		$list = $ini->getSections();
		return $list;
    }

    /**
     * Возвращает форму с тредами
     * $id - Индентификатор
     */
    public function getTred() {
		$xlib = new xlib();
		$refresh = $xlib->getPathModules("xmessage/refresh.php");
		$xlib->js("
$(document).ready(function() {
	/**
	 * Получение контента
	 */
	$('#refresh').submit(function(event) {
	    event.preventDefault();
		var arr = $(this).serializeArray();
		$('#loadingcontent').html(\"<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div></div>\");
		arr.push({name: 'post_index', value:$('#post_index').val()});
		$.post('$refresh', arr, function(data) {
			// show the response
	        $('#text').val(null);
			$('#youtube').val(null);
			$('#other').val(null);
			$('#response').html(data);
			var youtube = document.querySelectorAll('.youtube');
			for(var i = 0; i < youtube.length; i++) {
				var source = 'https://img.youtube.com/vi/' + youtube[i].dataset.embed + '/sddefault.jpg';
				var image = new Image();
					image.src = source;
					image.addEventListener('load', function() {
						youtube[i].appendChild(image);
					}(i));
						youtube[i].addEventListener('click', function() {
						var iframe = document.createElement('iframe');
						iframe.setAttribute('frameborder', '0');
						iframe.setAttribute('allowfullscreen', '');
						iframe.setAttribute('src', 'https://www.youtube.com/embed/' + this.dataset.embed + '?rel=0&showinfo=0&autoplay=1');
						this.innerHTML = '';
						this.appendChild(iframe);
				});
			};
	        $('#loadingcontent').empty();
		}).fail(function() {
			$('#response').html(\"<div class='alert alert-danger alert-dismissible show' role='alert' align='left'>Ошибка в запросе пожалуйста обновите страницу или выйдите из браузера =(<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>\");
	    });
	});");
    }

    /**
     * Возвращает форму создание треда
     * $id - индендификатор
     */
    public function showTred(array $options = ['id']) {
        $xlib = new xlib();
        $bootstrap = new bootstrap();
        $id = $options['id'];
        if ($id == null) {
            $id = uniqid();
        }
        $tred = $xlib->getPathModules("xmessage/tred.php");
        $xlib->js("
$(document).ready(function() {

    /**
     * Создать новый тред
     */
    $('#$id').submit(function() {
        $('#getTred').html(\"<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div></div>\");
		var arr = $(this).serializeArray();
		var youtstr = arr[4]['value'];
		var youtarr = youtstr.split(' ');
		var y = '';
	    if(youtstr.length != 0) {
			youtarr.forEach(function(cuka) {
				nya = KozYouTubeUtils.parseId(cuka);
				if (nya != 'undefined'.text) { //НУА Блять как же меня заебала это всё почему я блять не сдох...
					y += nya + ' ';
				}
			});
		}
		arr.push({name: 'vs', value:y});
		$.post('$tred', arr, function(data){
			$('#getTred').html(data);
            var youtube = document.querySelectorAll('.youtube');
			for(var i = 0; i < youtube.length; i++) {
				var source = 'https://img.youtube.com/vi/' + youtube[i].dataset.embed + '/sddefault.jpg';
				var image = new Image();
					image.src = source;
					image.addEventListener('load', function() {
						youtube[i].appendChild(image);
					}(i));
						youtube[i].addEventListener('click', function() {
						var iframe = document.createElement('iframe');
						iframe.setAttribute('frameborder', '0');
						iframe.setAttribute('allowfullscreen', '');
						iframe.setAttribute('src', 'https://www.youtube.com/embed/' + this.dataset.embed + '?rel=0&showinfo=0&autoplay=1');
						this.innerHTML = '';
						this.appendChild(iframe);
				});
			};
	    }).fail(function() {
	        $('#getTred').html(\"<div class='alert alert-danger alert-dismissible show' role='alert' align='left'>Ошибка в запросе пожалуйста обновите страницу или выйдите из браузера =(<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>\");
	    });
	    return false;
    });
});");
        return $xlib->evnform([
                'id' => $id,
			    'content' =>
					$bootstrap->input("Как называется тред ?)", "title") .
					$bootstrap->input("Имя создателя (Неизвестный)", "name") .
					$bootstrap->combobox([
						'id' => 'selected',
						'option' => $this->getOptions()
					]) .
					$bootstrap->combobox([
						'id' => 'event',
						'option' => $bootstrap->opt('Создать тред') . $bootstrap->opt('Просмотр')
					]) .
					$bootstrap->textarea("Описание (текст) (используйте знак => \"Пробел\" чтобы добавить более одного файла)", "text") .
					    $bootstrap->sep([
							'modal' => true,
							'content' => $xlib->padding([
							'top' => 15,
								'content' => $bootstrap->btn([
									'modal' => true,
									'type' => 'submit',
									'title' => 'Выполнить',
									'theme' => 'primary',
								])
						])
					]) .
					$xlib->div([
						'id' => 'getTred'
					])
	    ]);
    }

    /**
     * Создать доску
     * $id - индентификатор
     */
    public function showDoska(array $options = ['id']) {
        $id = $options['id'];
        if ($id == null) {
            $id = uniqid();
        }
        $xlib = new xlib();
        $bootstrap = new bootstrap();
        $tred = $xlib->getPathModules("xmessage/doska.php");
        $xlib->js("
$(document).ready(function() {

    /**
     * Создать новую доску
     */
    $('#$id').submit(function() {
        $('#getDoska').html(\"<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div></div>\");
		$.post('$tred', $(this).serialize(), function(data){
			$('#getDoska').html(data);
	    }).fail(function() {
	        $('#getDoska').html(\"<div class='alert alert-danger alert-dismissible show' role='alert' align='left'>Ошибка в запросе пожалуйста обновите страницу или выйдите из браузера =(<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>\");
	    });
	    return false;
    });
});");
        return $xlib->evnform([
		    'id' => $id,
		    'content' =>
				$bootstrap->combobox([
					'id' => 'type',
					'option' => $this->getOptionsType()
				]) .
			    $bootstrap->input("Название", "title") .
			    $bootstrap->input("Описание краткое", "description") .
			    $bootstrap->sep([
				    'modal' => true,
				    'content' => $xlib->padding([
					    'top' => 15,
					    'content' => $bootstrap->btn([
						    'modal' => true,
						    'type' => 'submit',
						    'theme' => 'primary',
						    'title' => 'Выполнить'
					    ])
				    ])
			    ]) .
		    $xlib->div([
			    'id' => 'getDoska'
		    ])
	    ]);
    }

    /**
     * Создать тип
     * $id - индентификатор
     */
    public function showType(array $options = ['id']) {
        $id = $options['id'];
        if ($id == null) {
            $id = uniqid();
        }
        $xlib = new xlib();
        $bootstrap = new bootstrap();
        $tred = $xlib->getPathModules("xmessage/type.php");
        $xlib->js("
$(document).ready(function() {

    /**
     * Создать новую доску
     */
    $('#$id').submit(function() {
        $('#getType').html(\"<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div></div>\");
		$.post('$tred', $(this).serialize(), function(data){
			$('#getType').html(data);
	    }).fail(function() {
	        $('#getType').html(\"<div class='alert alert-danger alert-dismissible show' role='alert' align='left'>Ошибка в запросе пожалуйста обновите страницу или выйдите из браузера =(<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>\");
	    });
	    return false;
    });
});");
        return $xlib->evnform([
		    'id' => $id,
		    'content' =>
			    $bootstrap->input("Название", "title") .
			    $bootstrap->sep([
				    'modal' => true,
				    'content' => $xlib->padding([
					    'top' => 15,
					    'content' => $bootstrap->btn([
						    'modal' => true,
						    'type' => 'submit',
						    'theme' => 'primary',
						    'title' => 'Выполнить'
					    ])
				    ])
			    ]) .
		    $xlib->div([
			    'id' => 'getType'
		    ])
	    ]);
    }

    /**
     * Форма отправки постов
     */
	public function sendpost() {
		$xlib = new xlib();
		$xmessage = new xmessage();
        $bootstrap = new bootstrap();
		$refresh = $xlib->getPathModules("xmessage/refresh.php");
		$post = $xlib->getPathModules("xmessage/post.php");
		$xlib->js("
$(document).ready(function() {
		var arr = $(this).serializeArray();
		$('#loadingcontent').html(\"<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div></div>\");
		arr.push({name: 'post_index', value:$('#post_index').val()});
		$.post('$refresh', arr, function(data) {
			// show the response
	        $('#text').val(null);
			$('#youtube').val(null);
			$('#other').val(null);
			$('#response').html(data);
			var youtube = document.querySelectorAll('.youtube');
			for(var i = 0; i < youtube.length; i++) {
				var source = 'https://img.youtube.com/vi/' + youtube[i].dataset.embed + '/sddefault.jpg';
				var image = new Image();
					image.src = source;
					image.addEventListener('load', function() {
						youtube[i].appendChild(image);
					}(i));
						youtube[i].addEventListener('click', function() {
						var iframe = document.createElement('iframe');
						iframe.setAttribute('frameborder', '0');
						iframe.setAttribute('allowfullscreen', '');
						iframe.setAttribute('src', 'https://www.youtube.com/embed/' + this.dataset.embed + '?rel=0&showinfo=0&autoplay=1');
						this.innerHTML = '';
						this.appendChild(iframe);
				});
			};
	        $('#loadingcontent').empty();
		}).fail(function() {
			$('#response').html(\"<div class='alert alert-danger alert-dismissible show' role='alert' align='left'>Ошибка в запросе пожалуйста обновите страницу или выйдите из браузера =(<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>\");
	    });
	/**
	 * Получение контента
	 */
	$('#refresh').submit(function(event) {
	    event.preventDefault();
		var arr = $(this).serializeArray();
		$('#loadingcontent').html(\"<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div></div>\");
		arr.push({name: 'post_index', value:$('#post_index').val()});
		$.post('$refresh', arr, function(data) {
			// show the response
	        $('#text').val(null);
			$('#youtube').val(null);
			$('#other').val(null);
			$('#response').html(data);
			var youtube = document.querySelectorAll('.youtube');
			for(var i = 0; i < youtube.length; i++) {
				var source = 'https://img.youtube.com/vi/' + youtube[i].dataset.embed + '/sddefault.jpg';
				var image = new Image();
					image.src = source;
					image.addEventListener('load', function() {
						youtube[i].appendChild(image);
					}(i));
						youtube[i].addEventListener('click', function() {
						var iframe = document.createElement('iframe');
						iframe.setAttribute('frameborder', '0');
						iframe.setAttribute('allowfullscreen', '');
						iframe.setAttribute('src', 'https://www.youtube.com/embed/' + this.dataset.embed + '?rel=0&showinfo=0&autoplay=1');
						this.innerHTML = '';
						this.appendChild(iframe);
				});
			};
	        $('#loadingcontent').empty();
		}).fail(function() {
			$('#response').html(\"<div class='alert alert-danger alert-dismissible show' role='alert' align='left'>Ошибка в запросе пожалуйста обновите страницу или выйдите из браузера =(<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>\");
	    });
	});

	/**
	 * Отправка новый постов
	 */
	$('#post').submit(function(event) {
		event.preventDefault();
		$('#loadingcontent').html(\"<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div></div>\");
		var arr = $(this).serializeArray();
		var youtstr = arr[2]['value'];
		var youtarr = youtstr.split(' ');
		var y = '';
	    if(youtstr.length != 0) {
			youtarr.forEach(function(cuka) {
				nya = KozYouTubeUtils.parseId(cuka);
				if (nya != 'undefined'.text) { //НУА Блять как же меня заебала это всё почему я блять не сдох...
					y += nya + ' ';
				}
			});
		}
		arr.push({name: 'vs', value:y});
		$('#response').empty();
		$.post('$post', arr, function(data) {
			$('#response').html(data);
	        $('#loadingcontent').empty();
			var youtube = document.querySelectorAll('.youtube');
			for(var i = 0; i < youtube.length; i++) {
				var source = 'https://img.youtube.com/vi/' + youtube[i].dataset.embed + '/sddefault.jpg';
				var image = new Image();
					image.src = source;
					image.addEventListener('load', function() {
						youtube[i].appendChild(image);
					}(i));
						youtube[i].addEventListener('click', function() {
						var iframe = document.createElement('iframe');
						iframe.setAttribute('frameborder', '0');
						iframe.setAttribute('allowfullscreen', '');
						iframe.setAttribute('src', 'https://www.youtube.com/embed/' + this.dataset.embed + '?rel=0&showinfo=0&autoplay=1');
						this.innerHTML = '';
						this.appendChild(iframe);
				});
			};
            $(\"textarea#text\").val(null);
            $(\"textarea#youtube\").val(null);
			$(\"textarea#other\").val(null);
		}).fail(function() {
			$('#response').html(\"<div class='alert alert-danger alert-dismissible show' role='alert' align='left'>Ошибка в запросе пожалуйста обновите страницу или выйдите из браузера =(<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>\");
		});
	});
});");
        $formsendpost = $xlib->padding([
        	'top' => 15,
        	'content' => $xlib->evnform([
        		'id' => 'post',
        		'content' => $bootstrap->border([
        			'align' => 'left',
        			'content' =>
		        		$bootstrap->input('ид отправителя треда', 'post_index', $xlib->geturi(3)) .
		        		$bootstrap->input("Имя создателя поста (Неизвестный)", 'name') .
		        		$bootstrap->textarea("Описание (текст) (используйте знак => \"Пробел\" чтобы добавить более одного файла)", 'text') .
		        		$bootstrap->btn([
		        			'title' => $bootstrap->ico('ok'),
		        			'type' => 'submit'
	        			])
        		])
        	])
        ]);
     	return $bootstrap->border([
     		'align' => 'left',
     		'content' => $xlib->div(['id' => 'loadingcontent']) . $xlib->evnform([
				'id' => 'refresh',
				'content' =>
			 		$bootstrap->btn([
			 			'id' => 'postform',
				 		'title' => $bootstrap->ico('send'),
						'collaps' => '-'
			 		]) .
					$bootstrap->btn([
						'type' => 'submit', 
				 		'title' => $bootstrap->ico('refresh')
			 		])
				]) . $bootstrap->collaps($formsendpost, 'postform')
	     	]) . $xlib->div(['id' => 'response']);
	}
}
