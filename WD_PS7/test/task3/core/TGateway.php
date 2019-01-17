<?php

namespace core;

trait TGateway
{
    private function badGateway()
    {
        http_response_code(404);
        include '404.html';
    }
}