<?php
//database handler
class db
{
    protected $servername;
    protected $username;
    protected $password;
    protected $database;
    public $connection;
    protected $apitoken = 'my-api-key';

    protected function connect()
    {
        $this->servername = "server-address";
        $this->username = "username";
        $this->password = "password";
        $this->database = "movies";

        $connection = new mysqli($this->servername, $this->username, $this->password, $this->database) or die("Unable to connect to Database");
        return $connection;

    }

    function __destruct()
    {
        //disconnect DB connection on destruct
        $this->connection = NULL;
    }

}

?>
