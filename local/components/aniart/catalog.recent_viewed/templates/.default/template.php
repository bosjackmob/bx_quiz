<?php
use Aniart\Main\Interfaces\ProductInterface;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(empty($arResult['ELEMENTS'])){
	return;
}
?><pre><?//print_r($arResult['ELEMENTS']);?></pre>
<div id="recent_viewed_items" class="bx_item_list_you_looked_horizontal col5 bx_green">
	<div class="bx_item_list_title">Последние просмотренные товары:</div>
	<div class="bx_item_list_section">
		<div class="bx_item_list_slide" style="height: auto;">
			<?foreach($arResult['ELEMENTS'] as $product):
				if($product['ELEMENT']["PREVIEW_PICTURE"] != ''){
					$arFile = CFile::GetFileArray($product['ELEMENT']["PREVIEW_PICTURE"]);
				}elseif($product['ELEMENT']["DETAIL_PICTURE"] != ''){
					$arFile = CFile::GetFileArray($product['ELEMENT']["DETAIL_PICTURE"]);
				}
				
			?>
			<div class="bx_catalog_item" style="position: relative" data-id="<?=$product['ID']?>">
				<div class="">
					<a href="<?=$product['ELEMENT']['DETAIL_PAGE_URL']?>"
					   class="bx_catalog_item_images"
					   style="background-image: url('<?=$arFile['SRC']?>')"
					   title="<?=$product['ELEMENT']['NAME']?>">
					</a>
					<div class="bx_catalog_item_title">
						<a href="<?=$product['ELEMENT']['DETAIL_PAGE_URL']?>" title="<?=$product['ELEMENT']['NAME']?>">
							<?=$product['ELEMENT']['NAME']?>
						</a>
					</div>
					<div class="bx_catalog_item_price">
						<div id="bx_1182278561_66_price" class="bx_price"><?=CurrencyFormat($product['PRICE']["PRICE"], $product['PRICE']["CURRENCY"]);?></div>
					</div>
				</div>
				<div class="delete-recent-item"></div>
			</div>
			<?endforeach?>
			<div style="clear: both;"></div>
		</div>
	</div>
</div>
