<?php

namespace engine\core\database;

use \PDO;

class connection
{
    private $link;

    /**
     * connection constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * @return $this
     */
    public function connect()
    {
        $config = [
            'host' => 'localhost',
            'dbname' => 'test_pdo',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ];

        $dsn = 'mysql:host='.$config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'];

        $this->link = new PDO($dsn,$config['username'],$config['password']);

        return $this;
    }

    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);

        return $sth->execute();
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql)
    {
        $exe = $this->link->prepare($sql);

        $exe->execute();

        $result = $exe->fetchAll(PDO::FETCH_ASSOC);

        if($result === false)
        {
            return [];
        }

        return $result;
    }
}