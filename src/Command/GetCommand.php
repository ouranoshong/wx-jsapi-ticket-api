<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 4:08 PM
 */

namespace Wx\JSAPI\Ticket\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wx\JSAPI\Ticket\Client;

class GetCommand extends Command
{
    public function configure()
    {
        $this->setName('wx:jsapi:ticket:get')
            ->setDescription('Get jsapi ticket from cache file.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Client $client */
        $client = $this->getHelper('WxJSAPITicketClient')->getClient();
        $output->writeln(json_encode((array)$client->get(), JSON_PRETTY_PRINT));
    }
}