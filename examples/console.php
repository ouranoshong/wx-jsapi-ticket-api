<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 4:18 PM
 */

require __DIR__ . '/bootstrap.php';

$console = new \Symfony\Component\Console\Application('Wx Token Console');

$ticketConfiguration = new \Wx\JSAPI\Ticket\Configuration();
$ticketConfiguration->accessToken = null !== $client->get() ? $client->get()->access_token : '';
$ticketClient = new \Wx\JSAPI\Ticket\Client($ticketConfiguration);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(
    [
        'client' => new \Wx\Access\Token\Command\ClientHelper(
            $client
        ),
        'ticketClient' => new \Wx\JSAPI\Ticket\Command\ClientHelper(
            $ticketClient
        )
    ]
);

$console->setHelperSet($helperSet);

$console->addCommands(
    [
        new \Wx\Access\Token\Command\WxTokenFetchAndSaveCommand(),
        new \Wx\Access\Token\Command\WxTokenGetCommand(),
        new \Wx\JSAPI\Ticket\Command\FetchAndSaveCommand(),
        new \Wx\JSAPI\Ticket\Command\GetCommand()
    ]
);

$console->run();