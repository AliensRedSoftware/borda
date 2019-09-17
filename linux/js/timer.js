"use strict";

/**
 * Таймер 
 */
let timer = {
	
	/*
	 * Таймер с инпатум
	 * Cookie - Название кука (Хранение времени)
	 * timerInput - Поля с числом (input value)
	 * Update - Функция выполнение обновление по окончания таймера
	 * View - html контент
	 */ 
	Update: function (Cookie, timerInput, Update, View, type = 'click') {
		if (Cookies.get(Cookie) != null) {
			$('#' + timerInput).val(Cookies.get(Cookie));
		}
		if ($('#' + timerInput).val() >= 10) {
			var tik = $('#' + timerInput).val();
			var timerId = setInterval(function() {
				if (type == 'submit') { 
					$('#' + Update).submit(); //Обновление таймера
				} else {
					$('#' + Update).click(); //Обновление таймера
				}
				tik = $('#' + timerInput).val();
			},tik * 1000); // 1 сек = 1000сек...
			var s = setInterval(function() {
				tik = tik - 1;
				$('#' + View).html(tik);
			}, 1000);
		}
		$('#' + timerInput).bind('input', function() {
			var val = $(this).val();
			if (val >= 10 && val <= 60) {
				Cookies.set(Cookie, val);
				clearInterval(timerId);
				clearInterval(s);
				$('#' + View).html(null);
				tik = val;
				timerId = setInterval(function() {
					if (type == 'submit') { 
						$('#' + Update).submit(); //Обновление таймера
					} else {
						$('#' + Update).click(); //Обновление таймера
					}
					tik = val;
				},tik * 1000);
				s = setInterval(function() {
					tik = tik - 1;
					$('#' + View).html(tik);
				}, 1000);

			} else {
				Cookies.set(Cookie, $('#' + timerInput).val());
				clearInterval(timerId);
				clearInterval(s);
				$('#' + View).html(null);
			}
		});

	}
};
