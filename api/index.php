<?php
/** @global $USER */

use Bitrix\Main\Context;
use VAVT\Services\Postgres;

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require __DIR__ .'/RPDManager.php';

$request = Context::getCurrent()->getRequest();
$method = $request->getRequestMethod();

switch ($method) {
    case 'GET':
    {
        switch ($request->getQuery('action')) {
            case 'getSyllabusesList':

                $res = RPDManager::getSyllabusesList();

                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            case 'getRPDList':

                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'],true);

                $res = RPDManager::getRPDList($params);

                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            case 'getRPDData':
                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'],true);

                $res = RPDManager::getRPDFromDB($params);

                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
        break;
    }
    case 'POST' :
    {
        //для получения json'a используем поток 'php://input'
        $request = \json_decode(\file_get_contents('php://input'), true);
        switch ($request['action']) {
            case 'setData':
                $res = RPDManager::setRPDData($request);

                die(\json_encode($res,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            case 'uploadFile':
                die(\json_encode(123,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            case 'test':
                die(json_encode(['id' => $USER->GetID()]));
        }

    }
}

