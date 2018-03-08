<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 3:50 PM
 */

namespace Wx\JSAPI\Ticket;


class Client
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var StorageHandlerInterface
     */
    private $storage;

    /**
     * @var string
     */
    private $keyName = 'wx-jsapi-ticket';

    /**
     * Client constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param StorageHandlerInterface $storageHandler
     */
    public function setStorageHandler(StorageHandlerInterface $storageHandler)
    {
        $this->storage = $storageHandler;
    }

    /**
     * @return null|Ticket
     */
    public function fetchAndSave()
    {
        $content = $this->fetch();
        if ($content) {
            $ticket = new Ticket();
            $this->setTicket($ticket, json_decode($content, true));
            $this->save($ticket);
        }
        return $this->get();
    }

    /**
     * @return bool|string
     */
    public function fetch()
    {
        return file_get_contents(
            'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.
            $this->configuration->accessToken.'&type=jsapi'
        );
    }

    /**
     * @param Ticket $ticket
     * @param $content
     */
    protected function setTicket(Ticket $ticket, $content)
    {
        foreach ($ticket as $key => $value) {
            if (isset($content[$key])) {
                $ticket->{$key} = $content[$key];
            }
        }
    }

    /**
     * @param Ticket $ticket
     * @return null|Ticket
     */
    public function save(Ticket $ticket)
    {
        $this->getStorage()->save($this->keyName, serialize($ticket));
        return $this->get();
    }

    /**
     * @return FileStorageHandler|StorageHandlerInterface
     */
    public function getStorage()
    {
        if (!$this->storage) {
            $this->storage = new FileStorageHandler();
        }
        return $this->storage;
    }

    /**
     * @return Ticket|null
     */
    public function get()
    {
        return unserialize($this->getStorage()->get($this->keyName));
    }

    public function isExpired()
    {
        if ($updateTime = $this->getStorage()->getUpdateTime($this->keyName)) {
            return (time() - $updateTime) > $this->configuration->expiresSeconds;
        }

        return true;
    }

    public function setKeyName($name) {
        $this->keyName = $name;
    }
}