<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="news-list__custom">

	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="news-list__item">
			<div class="item__title"><?echo $arItem["NAME"]?></div>
			<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>


					<div class="property__label"><?=$arProperty["NAME"]?></div>
						<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
							<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
						<?else:?>
							<div class="property__value">
								<?=$arProperty["DISPLAY_VALUE"];?>
							</div>
					<?endif?>

					<? if ($arProperty["LINK_IBLOCK_ID"]>0): ?>
					<? $EXTERNAL_IBLOCK = $arProperty["LINK_IBLOCK_ID"]; ?>

					<? foreach($arProperty["VALUE"] as $extPropID) { ?>
						<div class="property__address">
						<? $arFilter = Array("IBLOCK_ID"=>$EXTERNAL_IBLOCK, "ID"=>$extPropID);
						$res = CIBlockElement::GetList(Array(), $arFilter); 
						if ($ob = $res->GetNextElement()){; 
							$arProps = $ob->GetProperties(); 
							foreach($arProps as $extProp){ ?>
								<span class="property__value"><?=$extProp["VALUE"]; ?></span>
							<?}?>
						<?}?>
						</div>
						<?}?>
					<?endif?>




			<?endforeach;?>
		</div>
	<?endforeach;?>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>

</div>
