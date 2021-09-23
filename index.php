<?php

use Bitrix\Main\Page\Asset;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('RPD Form - dev');

$asset = Asset::getInstance();
$asset->addJs('/rpd/dist/js/app.js');
?>
    <div class="d-flex justify-content-center align-items-center">
        <div id="app"></div>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
