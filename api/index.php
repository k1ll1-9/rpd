<?php

use Bitrix\Main\Context;

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}
define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

$request = Context::getCurrent()->getRequest();
$method = $request->getRequestMethod();

switch ($method) {
    case 'GET':
    {
        switch ($request->getQuery('action')) {
            case 'getData':
                $data = \file_get_contents(__DIR__ . '/data.json');
                die($data);
        }
        break;
    }
    case 'POST' : {
        //axios использует поток 'php://input' вместо POST'а 
        $request = \json_decode(\file_get_contents('php://input'), true);
        switch ($request['action']) {
            case 'setData':
                $data = $request['data'];
                die(\json_encode($data));
        }
    }
}
