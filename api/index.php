<?php
/** @global $USER */

use Bitrix\Main\Context;
use VAVT\Services\Postgres;

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require __DIR__ . '/RPDManager.php';

$request = Context::getCurrent()->getRequest();
$method = $request->getRequestMethod();

switch ($method) {
    case 'GET':
    {
        switch ($request->getQuery('action')) {
            case 'initApp':
            {

                $data['user'] = RPDManager::getUserInfo();

                die(\json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
            case 'getSyllabusesList':

                $res = RPDManager::getSyllabusesList();

                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            case 'getRPDList':

                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'], true);

                $res['list'] = RPDManager::getRPDList($params);
                $res['syllabusFiles'] = RPDManager::getSyllabusFiles($params);
                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            case 'getRPDData':
                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'], true);

                $res = RPDManager::getRPDFromDB($params);

                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
        break;
    }
    case 'POST' :
    {
        $contentType = $request->getHeader('content-type');
        if ($contentType === 'application/json') {
            $data = \json_decode(\file_get_contents('php://input'), true);
            switch ($data['action']) {
                case 'setData':
                    $res = RPDManager::setRPDData($data);
                    die(\json_encode($res));
                    break;
            }
        } else {
            switch ($request['action']) {
                case 'uploadSyllabusFile':
                    $params = \json_decode($request->getPost('params'), true);
                    $file = $request->getFile('file');
                    $res = RPDManager::uploadSyllabusFile($params,$file);
                    die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
            break;
        }
    }
}

