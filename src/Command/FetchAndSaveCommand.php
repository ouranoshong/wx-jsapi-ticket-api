<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 4:07 PM
 */

namespace Wx\JSAPI\Ticket\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Wx\JSAPI\Ticket\Client;

class FetchAndSaveCommand extends Command
{
    public function configure()
    {
        $this->setName('wx:jsapi:ticket:fetch-and-save')
            ->setDescription('Fetch then save jsapi ticket from wei xin service.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Client $client */
        $client = $this->getHelper('WxJSAPITicketClient')->getClient();

        $io = new SymfonyStyle($input, $output);

        if ($io->confirm('Are you sure')) {
            $token = $client->fetchAndSave();

            if ($token->ticket) {
                $io->success('fetch successfully : '.json_encode((array)$token, JSON_PRETTY_PRINT));
            } else {
                $io->error('fetch wrong data!');
            }
        }

    }
}