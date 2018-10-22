<?php
use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Config\Option,
	Bitrix\Main\Localization\Loc,
	Bitrix\Sale,
	Bitrix\Iblock\Component\ElementList,
	Bitrix\Catalog;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

if(!Loader::includeModule('iblock')) die;

class RecentViewed extends \CBitrixComponent
{	
	protected function GetProducts()
	{
		$arViewed = array();
		$basketUserId = (int)Sale\Fuser::getId();
		if ($basketUserId > 0){
			$viewedIterator = Catalog\CatalogViewedProductTable::getList(array(
				'select' => array('ID', 'PRODUCT_ID', 'ELEMENT_ID'),
				'filter' => array('=FUSER_ID' => $basketUserId, '=SITE_ID' => SITE_ID),
				'order' => array('DATE_VISIT' => 'DESC'),
				'limit' => 5
			));

			while ($arFields = $viewedIterator->fetch()){
				
				$arFields['PRICE'] = $arPrice = CPrice::GetBasePrice($arFields["ELEMENT_ID"], false, false);
				$res = CIBlockElement::GetByID($arFields["ELEMENT_ID"]);// вариант не очень, лучше бы одним скопом передать все ИД
				if($ar_res = $res->GetNext()){
					$arFields['ELEMENT'] = $ar_res;
				}
				$arResult['ELEMENTS'][] = $arFields;
			}
			return $arResult;
		}
	}

	
	public function executeComponent()
	{
		$this->setFrameMode(false);
		$this->arResult = array_merge($this->arResult, $this->GetProducts());

		$this->includeComponentTemplate();
	}
}