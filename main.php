<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler(
	'iblock', 'OnAfterIBlockElementAdd', 'updateElementName'
);
$eventManager->addEventHandler(
	'iblock', 'OnAfterIBlockElementUpdate', 'updateElementName'
);

function updateElementName(&$arFields)
{
	if (empty($arFields['ID'])) return;

	$targetIBlockId = null;  // TODO: set a value
	$checkField = null;  // TODO: set a value

	if ($arFields['IBLOCK_ID'] != $targetIBlockId) return;

	if (isset($arFields[$checkField])
		&& $arFields[$checkField] == 'Y')
	{
		Loader::includeModule('iblock');
		$newName = 'Смекалка ' . date('d.m.Y', strtotime('+18 days'));
		$element = new CIBlockElement();
		$element->Update($arFields['ID'], ['NAME' => $newName]);
	}
}
