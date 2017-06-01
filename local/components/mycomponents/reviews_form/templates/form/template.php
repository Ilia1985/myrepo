<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$componentPath = $this->__component->__path;
?>
<div id="myreviewsForm">
	<h5><?=GetMessage("MYREVIEWS_FORM_TITLE");?></h5>
	<form role="form" name="myreviewsForm"  action="<?=$componentPath?>/ajax.php" method="POST">
		<input type="hidden" name="cur_page" value="<?=$arResult['CUR_PAGE']?>">	
		<input type="hidden" name="reviews_list_refresh" value="<?=$arParams['REVIEWS_LIST_AJAX_REFRESH']?>">		
		<input type="hidden" name="review_type" value="<?=$arParams['REVIEW_TYPE']?>">		
		<?if( !empty($arParams['ELEMENT_ID']) ):?>
			<input type="hidden" name="element_id" value="<?=$arParams['ELEMENT_ID']?>">
		<?endif;?>
	
		<input type="hidden" name="review_type" value="<?=$arParams['REVIEW_TYPE']?>">
		<div class="form-group has-feedback">
			<input type="text" class="form-control" name="autor" value="" placeholder="<?=GetMessage("MYREVIEWS_FORM_NAME");?>">
		</div>
		<div class="form-group has-feedback">
			<textarea class="form-control" name="text" placeholder="<?=GetMessage("MYREVIEWS_FORM_REVIEW");?>" rows="6" ></textarea>
		</div>
		<div class="form-group">
			<input type="submit" name="submit_form" class="my-btn  btn btn-lg rounded" value="Отправить">
		</div>
	</form>	
</div>