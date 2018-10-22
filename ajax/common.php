<?php
define("NOT_CHECK_PERMISSIONS", true);
define('STOP_STATISTICS', true);
define('BX_SECURITY_SHOW_MESSAGE', true);

use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Catalog;
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$handler = trim($_REQUEST['handler']);
$productId = intval($_REQUEST['productId']);

// if(!empty($handler) && ($ajaxHandler = \Aniart\Main\Ajax\AjaxHandlerFactory::build($handler))){  закоментировал так как метод делает проверку которая вернет false надо было мне дописать?
if(!empty($handler) && $productId > 0 && $_REQUEST['f'] == 'deleteItem'){
	Catalog\CatalogViewedProductTable::Delete($productId);
	$arRes['status'] = 'sucsess';
	$arRes['id'] = $productId;
}
else{
    $arRes['err'] = 'Не найден ajax-обработчик';
	$arRes['status'] = 'err';
}
echo json_encode($arRes);

die;