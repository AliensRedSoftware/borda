<?php
class upload {
	function execute () {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/core/classes/module.php';
		$module = new module();
		//$module->alert_bootstrap('danger' , '[Ошибка!] -> ' , 'Описание должно быть!');
		$module->html("
<div class='ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable'>
   <div class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix'>
      <span id='ui-dialog-title-dialog' class='ui-dialog-title'>Заголовок</span>
      <a class='ui-dialog-titlebar-close ui-corner-all' href='#'><span class='ui-icon ui-icon-closethick'>close</span></a>
   </div>
   <div style='height: 200px; min-height: 109px; width: auto;' class='ui-dialog-content ui-widget-content' id='dialog'>
      <p>Содержимое диалогового окна.</p>
   </div>
</div>
		");
	}
}
$upload = new upload();
$upload->execute();
