<?php
/**
 * Created by Luiz Henrique Soares.
 * User: Yoda
 * Date: 30/09/2016
 * Time: 18:15
 */

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;

class PagSeguroController extends Controller
{
    public function getSessionId()
    {
        $credentials =  \PagSeguroConfig::getAccountCredentials();

        return ['sessionId' => \PagSeguroSessionService::getSession($credentials)];
    }
}