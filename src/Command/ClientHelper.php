<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 4:06 PM
 */

namespace Wx\JSAPI\Ticket\Command;


use Symfony\Component\Console\Helper\Helper;
use Wx\JSAPI\Ticket\Client;

class ClientHelper extends Helper
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getClient() {
        return $this->client;
    }


    public function getName()
    {
        return 'WxJSAPITicketClient';
    }

}