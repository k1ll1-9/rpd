<? /** @noinspection ALL */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CMain $APPLICATION */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @var string $templateFolder */

use VAVT\Main\MUP;

$APPLICATION->SetTitle('РПД - ' . $arResult['upName'] . ' - ' . $arResult['upYear'] . ' - ' . $arResult['subjectName']);

?>
    <div class="d-flex justify-content-center align-items-center">
        <div id="app"></div>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');



