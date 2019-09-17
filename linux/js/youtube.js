"use strict";

let youtube = {
	
	/**
	 * Обновляет
	 */ 
	Update: function () {
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
	},
	
	/**
	 * Возвращает embed код 
	 */
	getEmbed: function(text) {
		var output = [];//Ni7TQRK-dgM удалит
		var columstr = text.split('\n');
		columstr.forEach(function (val) {
			val = val.trim();
			var space = val.split(' ');
			space.forEach(function (spc) {
				if (spc != ' ') {
					let videoId = spc.match(/http[s]?:\/\/(www.)?youtube.com\/watch\S*v=([\w\-]+)/i);
					if (videoId) {
						if (count(output) >= 1) {
							var слово = 'Насвай';
							output.forEach(function(ls) { //Проверка на совпадение одинаковых индентификаторов
								if(videoId[2] == ls) {
										слово = 'Эй брат отдай';
										return;
									}
								});
								if (слово == 'Насвай') {
									output.push(videoId[2]);
								}
						} else {
							output.push(videoId[2]);
						}
					}
					else {
						videoId = spc.match(/http[s]?:\/\/youtu.be\/(\w+[\-\w+]\w+)/i);
						var слово = 'Насвай';
						if (videoId) {
							if (count(output) >= 1) {
								output.forEach(function(ls) { //Проверка на совпадение одинаковых индентификаторов
									if(videoId[1] == ls) {
										слово = 'Эй брат отдай';
										return;
									}
								});
								if (слово == 'Насвай') {
									output.push(videoId[1]);
								}
							} else {
								output.push(videoId[1]);
							}
						}
					}
				}
			});
		});
		if(count(output) > 1) {
			return output;
		} else {
			if (count(output) == 1) {
				return output[0];
			} else {
				return false;
			}
		}
    },
    
    /**
     * Возвращает embed в виде строки с разделителям
     */ 
    getEmbedStr: function(text, char = ' ') {
		var Arr = this.getEmbed(text);
		var тварь = '';
		var i = 0;
		if (Array.isArray(Arr) == false) {
			return Arr;//....
		} else {
			Arr.forEach(function(cuka) {
				i++;
				if (count(Arr) == i) {
					тварь += cuka;
				} else {
					тварь += cuka + char;
				}
			});
			return тварь; //Возвращает ввиде знака char переменная указывается в функций
		}
	}
    
};
