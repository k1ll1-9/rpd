<?

use Bitrix\Main\Context;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}
define('NOT_CHECK_PERMISSIONS', true);
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

$post = Context::getCurrent()->getRequest()->getPost('test');

$body = file_get_contents('php://input');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    die($body);
}