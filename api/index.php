<?

use Bitrix\Main\Context;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}
define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

$action = Context::getCurrent()->getRequest()['action'];

//$body = file_get_contents('php://input');

switch ($action){
    case 'getData':
        $data = \file_get_contents(__DIR__.'/data.json');
        die($data);
        break;
}