<?php

class connection {

    private $dbhost = "localhost";
    private $dbuser = "asteriskuser";
    private $dbpass = "aaSY-69@syna";
    private $dbname = "astdialerdb";
    protected $connection;
    protected $result;

    public function getResult() {
        return $this->result;
    }

    public function connect() {
        $this->connection = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass)
                or die('Erro ao conectar no banco de dados!');

        mysqli_select_db($this->connection, $this->dbname) or die('Erro ao selecionar banco de dados!');
    }

    public function disconnect() {
        mysqli_close($this->connection);
    }

    public function execute($sql) {
        $this->connect();
        $this->result = mysqli_query($this->connection, $sql);
        $this->disconnect();
    }

    public function getDataAssoc($sql) {
        $this->connect();
        $this->result = mysqli_query($this->connection, $sql);

        $rows = array();

        while ($row = mysqli_fetch_assoc($this->result)) {
            $rows[] = $row;
        }

        $this->disconnect();
        return $rows;
    }

    public function getDataArray($sql) {
        $this->connect();
        $this->result = mysqli_query($this->connection, $sql);

        $rows = array();

        while ($row = mysqli_fetch_array($this->result)) {
            $rows[] = $row;
        }

        $this->disconnect();
        return $rows;
    }

}