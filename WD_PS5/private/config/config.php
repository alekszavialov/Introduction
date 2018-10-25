<?php

define("PRIVATE_DIR", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("CLASSES_DIR", dirname(__DIR__) . DIRECTORY_SEPARATOR . "classes" .
    DIRECTORY_SEPARATOR );

const dataDB = PRIVATE_DIR . "json" . DIRECTORY_SEPARATOR . "messages.json";
const usersDB = PRIVATE_DIR . "json" . DIRECTORY_SEPARATOR . "users.json";
const ERROR = "Oops, smth go wrong(";
const MIN_NAME_LENGTH = 4;
const MAX_NAME_LENGTH = 20;
const MIN_PASS_LENGTH = 6;
const MAX_PASS_LENGTH = 16;
const LOGIN_REG = "([^\w\d-_])";
const PASSWORD_REG = "([^\w\d])";