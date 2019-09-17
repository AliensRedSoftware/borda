$(document).ready(function() {
	
    if (getNameThemeBootstrap() != false) {
        var selected = getNameThemeBootstrap();
        $('#theme').val(selected);
        setThemeBootstrap(getThemeBootstrap()); //Изменить тему
    }

    /**
     * Лист изменение темы bootstrap
     */
    $('#theme').change(function() {
        var previwTheme = getThemeBootstrap();
        var theme = $('#theme').val();
        switch(theme) {
            case 'Светло-белая':
                Cookies.set("themeBootstrap", "default");
            break;
            case 'Светло-синия':
                Cookies.set("themeBootstrap", "primary");
            break;
            case 'Светло-зеленная':
                Cookies.set("themeBootstrap", "success");
            break;
            case 'Светло-голубая':
                Cookies.set("themeBootstrap", "info");
            break;
            case 'Светло-желтая':
                Cookies.set("themeBootstrap", "warning");
            break;
            case 'Светло-красная':
                Cookies.set("themeBootstrap", "danger");
            break;
            default:
                Cookies.set("themeBootstrap", "default");
            break;
        }
        setThemeBootstrap(getThemeBootstrap(), previwTheme); //Изменить тему
    });
});

/**
 * Устанавливает тему bootstrap
 */
function setThemeBootstrap (theme = 'default', previw = 'default') {
	if (theme != 'default') {
		$('.panel-' + previw).toggleClass('panel-' + theme).removeClass('panel-' + previw);
		$('.btn-' + previw).toggleClass('btn-' + theme).removeClass('btn-' + previw);
		$('.text-' + previw).toggleClass('text-' + theme).removeClass('text-' + previw);
	} 
	if (previw != 'default') {
		$('.panel-' + previw).toggleClass('panel-' + theme).removeClass('panel-' + previw);
		$('.btn-' + previw).toggleClass('btn-' + theme).removeClass('btn-' + previw);
		$('.text-' + previw).toggleClass('text-' + theme).removeClass('text-' + previw);
	} 
}

/**
 * Возвращает тему выбранную bootstrap
 */
function getThemeBootstrap () {
    if (Cookies.get('themeBootstrap') != 'undefined') {
        return Cookies.get('themeBootstrap');
    } else {
        return false;
    }
}

/**
 * Возвращает имя темы bootstrap
 */
function getNameThemeBootstrap() {
    switch(getThemeBootstrap()) {
	case 'default':
            return 'Светло-белая';
        break;
        case 'primary':
            return 'Светло-синия';
        break;
        case 'success':
            return 'Светло-зеленная';
        break;
        case 'info':
            return 'Светло-голубая';
        break;
        case 'warning':
            return 'Светло-желтая';
        break;
        case 'danger':
            return 'Светло-красная';
        break;
        default:
            return false;
        break;
    }
}

function count (array) {
	var i = 0;
	array.forEach (function() {
		i += 1;
	});
	return i;
}
