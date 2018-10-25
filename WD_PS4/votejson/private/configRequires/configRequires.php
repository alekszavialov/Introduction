<?php
/** @noinspection PhpUnhandledExceptionInspection */

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";

if (!file_exists(JSON_MANIPULATE) || !file_exists(VOTE_DB)) {
    throw new Exception('Config file broken!');
}

require_once JSON_MANIPULATE;