<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if( empty($arParams["AJAX_CALL"])):?>
<div id="myreviewsList">
<?endif;?>
<?if( !empty($arResult['ITEMS']) ):?>
	<h2><?=GetMessage('MYREVIEWS_LIST_TITLE')?></h2>
	<?foreach($arResult['ITEMS'] as $arItem):?>
		<div class='review'>
			<p class='title'>
				<span class='data'><?=$arItem['UF_DATA']->format("h:m:s d-m-Y");?></span>
				<span class='autor'><?=$arItem['UF_AUTOR']?></span>
			</p>
			<p class='text'>
				<?=$arItem['UF_TEXT']?>
			</p>
		</div>
	<?endforeach;?>
<?endif;?>
<?if( empty($arParams["AJAX_CALL"])):?>
</div>
<?endif;?>