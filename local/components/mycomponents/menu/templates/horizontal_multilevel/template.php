<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult['SECTIONS'])):?>
<ul id="<?$menuBlockId?>" class="horizontal-multilevel-menu">
<?
$previousLevel = 0;
foreach($arResult['SECTIONS'] as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"] - 1));?>
			</ul>
		</div>
	</li>		
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class='root-li'><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"
					onmouseover="mymenu.changeSectionPicure(this, '<?=$arItem['ID']?>'); return false;"
				>
					<?=$arItem["TEXT"]?>
				</a>
				<div class="sub-menu-container <?=( ($arParams['SHOW_POPULAR'] == 'Y')? 'show-item' : '')?>">
					<?if( $arParams['SHOW_POPULAR'] == 'Y' ):?>
						<div class='item-container' data-role="desc-img-block">
							<p>
								<a class='title' href = "<?=$arResult["ITEMS_DESC"][$arItem['ID']]['DETAIL_PAGE_URL']?>">
									<?=$arResult["ITEMS_DESC"][$arItem['ID']]['NAME']?>
								</a>
							</p>
							<?if( !empty($arResult["ITEMS_DESC"][$arItem['ID']]['PICTURE']) ):?>
							<a href = "<?=$arResult["ITEMS_DESC"][$arItem['ID']]['DETAIL_PAGE_URL']?>">
								<img src="<?=$arResult["ITEMS_DESC"][$arItem['ID']]['PICTURE']?>">
							</a>
							<?endif;?>
							<p class='description'>
								Число просмотров: 
								<span class='count'>
									<?=intval($arResult["ITEMS_DESC"][$arItem['ID']]['SHOW_COUNTER'])?>
								</span>
							</p>
						</div>	
					<?endif;?>	
				<ul>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
					<a href="<?=$arItem["LINK"]?>" class="parent"
						onmouseover="mymenu.changeSectionPicure(this, '<?=$arItem['ID']?>'); return false;"
					>
						<?=$arItem["TEXT"]?>						
					</a>
				<ul>
		<?endif?>

	<?else:?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
				<a href="<?=$arItem["LINK"]?>"
					onmouseover="mymenu.changeSectionPicure(this, '<?=$arItem['ID']?>'); return false;"
				>
					<?=$arItem["TEXT"]?>
				</a>
			</li>
		<?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-2) );?>
			</ul>

		</div>
	</li>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<script>
	BX.ready(function () {
		window.mymenu = new CreateMymenu(<?=CUtil::PhpToJSObject($arResult["ITEMS_DESC"])?>);
	});
</script>
<?endif?>

