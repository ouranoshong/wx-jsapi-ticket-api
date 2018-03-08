<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 3:53 PM
 */

namespace Wx\JSAPI\Ticket;


class Configuration
{
    public $accessToken;

    public $expiresSeconds = 7200;

    public function __construct(array $settings = [])
    {
        if (isset($settings['accessToken']) ) {
            $this->accessToken = $settings['accessToken'];
        }
    }
}