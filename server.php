<?php
/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2017/06/28
 * Time: 11:53 AM.
 */
require(__DIR__.'/vendor/autoload.php');

class Zinger
{
    protected $storeDir;

    public function __construct()
    {
        $this->storeDir = realpath(__DIR__.'/../farm/data/i18n/en_US/store');
    }

    public function zing($number, $callback)
    {
        $callback($number * 100);
    }

    public function store($itemid, $callback)
    {
        $filePath = sprintf('%s/%d.php', $this->storeDir, $itemid);
        echo $filePath, PHP_EOL;
        if (!file_exists($filePath)) {
            $item = (object) [
                'id' => (int) $itemid,
                'name' => 'not exist',
            ];
        } else {
            $item = include $filePath;
        }

        $callback($item);
    }

    public function ids($callback)
    {
        $filePath = sprintf('%s/IdentityMaps.php', $this->storeDir);
        echo $filePath, PHP_EOL;
        $idList = include $filePath;
        $callback($idList);
    }
}

$loop = new React\EventLoop\StreamSelectLoop();
$server = new DNode\DNode($loop, new Zinger());
$server->listen(7070);
$loop->run();
