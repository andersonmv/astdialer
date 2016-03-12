<?php

class campaing {

    protected $id;
    protected $state;
    protected $name;
    protected $max_retries;
    protected $max_calls;
    protected $prefix;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getMax_retries() {
        return $this->max_retries;
    }

    public function setMax_retries($max_retries) {
        $this->max_retries = $max_retries;
    }

    public function getMax_calls() {
        return $this->max_calls;
    }

    public function setMax_calls($max_calls) {
        $this->max_calls = $max_calls;
    }

    public function getPrefix() {
        return $this->prefix;
    }

    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    public function processCSV($data, $files) {
        $file = fopen($files['numberslist']['tmp_name'], 'r');

        $rows = array();

        while (($row = fgetcsv($file)) !== FALSE) {
            $rows[] = $row;
        }

        $counter = 0;

        foreach ($rows as $current_row) {
            $exploded = explode(";", $current_row[0]);
            $prefix = $exploded[0];
            $number = $exploded[1];
            $campaing_id = $data['id'];

            $sql = "INSERT INTO numberlist (prefix, phonenumber, campaing_id) VALUES ('$prefix', '$number', '$campaing_id')";
            $connection = new connection();
            $connection->execute($sql);
            $counter++;
        }

        return $counter;
    }

    public function getNumbersCount($id) {
        $sql = "SELECT count(n.phonenumber) FROM numberlist n INNER JOIN campaings c WHERE n.campaing_id = c.id AND c.id = $id";

        $connection = new connection();
        $data = $connection->getData($sql);

        return $data[0]['count(n.phonenumber)'];
    }

    public function selectAll() {
        $sql = "SELECT * FROM campaings";

        $connection = new connection();
        return $connection->getData($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM campaings WHERE id = $id";

        $connection = new connection();
        $connection->execute($sql);
        return $connection->getResult();
    }

    public function change($data) {
        $id = $data['id'];
        $state = $data['state'];
        $name = $data['name'];
        $max_retries = $data['max_retries'];
        $max_calls = $data['max_calls'];
        $prefix = $data['prefix'];

        $sql = "UPDATE campaings SET state = '$state', name = '$name', max_retries = '$max_retries', max_calls = '$max_calls', prefix = '$prefix'  WHERE id = '$id'";

        $connection = new connection();
        $connection->execute($sql);
        return $connection->getResult();
    }

    public function insert($data) {
        $state = $data['state'];
        $name = $data['name'];
        $max_retries = $data['max_retries'];
        $max_calls = $data['max_calls'];
        $prefix = null;

        if (isset($data['prefix'])) {
            $prefix = $data['prefix'];
        }

        $sql = "INSERT INTO campaings (state, name, max_retries, max_calls, prefix) VALUES ('$state', '$name', '$max_retries', '$max_calls', '$prefix')";

        $connection = new connection();
        $connection->execute($sql);
        return $connection->getResult();
    }

    public function load($id) {
        $sql = "SELECT * FROM campaings WHERE id = $id";

        $connection = new connection();
        $data = $connection->getData($sql);

        $this->id = $data[0]['id'];
        $this->state = $data[0]['state'];
        $this->name = $data[0]['name'];
        $this->max_retries = $data[0]['max_retries'];
        $this->max_calls = $data[0]['max_calls'];
        $this->prefix = $data[0]['prefix'];
    }

}
