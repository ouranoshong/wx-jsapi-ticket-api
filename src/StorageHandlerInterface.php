<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 3:52 PM
 */

namespace Wx\JSAPI\Ticket;


interface StorageHandlerInterface
{
    /**
     * define method that how to save token
     * @param $key
     * @param $value
     * @return mixed
     */
    public function save($key, $value);

    /**
     * define  method that how to get token
     * @param $key
     * @return mixed
     */
    public function get($key);
}