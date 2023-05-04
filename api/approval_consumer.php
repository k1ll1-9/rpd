<?php
if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

define('NOT_CHECK_PERMISSIONS', true);
define('BX_BUFFER_USED', true);

require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/local/components/syllabuses/main/templates/.default/vendor/autoload.php";

use VAVT\Services\Rabbit;
use VAVT\UP\Cipher;
use VAVT\UP\RPDManager;

$rabbit = new Rabbit('RPD approval consumer');
$rabbit->checkProcess();

/*//uncomment to abort cron for debug
if (\count($argv) < 2){
    die();
}*/

$callback = function ($msg) {

   // file_put_contents($_SERVER["DOCUMENT_ROOT"] .'/rpd.json',json_encode($msg));

    foreach ($msg as $item) {
        if (null === $item) {
            return false;
        }
    }

    $signedPDF = \base64_decode(Cipher::decryptSSL($msg['pdfSSL']));
    $sign = \base64_decode(Cipher::decryptSSL($msg['sigSSL']));
    $discCode = Cipher::decryptSSL($msg['disciplineCodeSSL']);
    $kafedra = Cipher::decryptSSL($msg['kafedraSSL']);
    $syllabusID = Cipher::decryptSSL($msg['syllabusIDSSL']);

    $params = [
        'syllabusID' => $syllabusID,
        'code' => $discCode,
        'kafedra' => $kafedra
    ];



    $json = RPDManager::getDisciplineData($params);

    if (!$json) {
        return false;
    }

    $discIndex = \json_decode($json, true)['disciplineIndex'];
    $path = '/mnt/synology_nfs/syllabuses/' . $syllabusID . '/rpd/' . $discCode . '/' . $kafedra . '/' . $discIndex . '.pdf';

    $PDFSaved = \file_put_contents($path, $signedPDF);
    \chmod($path, 0775);
    $sigSaved = \file_put_contents($path . '.sig', $sign);
    \chmod($path . '.sig', 0775);

    if ($sigSaved && $PDFSaved) {

        $res = RPDManager::saveApprovedRPDtoDB($params, $path);

        if ($res) {
            return RPDManager::uploadRPDToRemote($params);
        }

    } else {
        return false;
    }

};

$rabbit->get_infin('VAVT_signedrpd', $callback, 600);
