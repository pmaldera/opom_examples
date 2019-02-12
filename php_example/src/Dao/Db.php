<?php

class Db
{
    private $protocol;
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $connection;

    public function __construct(string $pProtocol, string $pHost, string $pDbname, string $pUser, string $pPassword)
    {
        $this->protocol = $pProtocol;
        $this->host = $pHost;
        $this->dbname = $pDbname;
        $this->user = $pUser;
        $this->password = $pPassword; // En réalité je ne conseille pas de le stocker
    }

    public function connect()
    {
        try{
            //Ecriture multi-ligne plus lisibles pour les grosses fonctions
            $this->connection = new PDO(
                $this->protocol.':host='.$this->host.';dbname='.$this->dbname,
                $this->user,
                $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        }
        catch(PDOException $ex){
            print_r($ex);
        }
    }

    public function isConnected()
    {
        return isset($this->connection);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

?>