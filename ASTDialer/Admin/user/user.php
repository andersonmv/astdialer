<?php

class user {

    protected $id;
    protected $name;
    protected $username;
    protected $password;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function doLogin($data) {
        $enteredUsername = $data['username'];
        $enteredPassword = base64_encode($data['password']);

        $sql = "SELECT * FROM users WHERE username = '$enteredUsername' AND password = '$enteredPassword'";

        $connection = new connection();
        $result = $connection->getLoginData($sql);

        if (mysqli_num_rows($result) > 0) {
            session_start();

            $_SESSION['logged'] = true;
            $_SESSION['username'] = $enteredUsername;
            header("Location: ../index.php");
        } else {
            header("Location: ../login.php");
        }
    }

    public function selectAll() {
        $sql = "SELECT * FROM users";

        $connection = new connection();
        return $connection->getData($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = $id";

        $connection = new connection();
        $connection->execute($sql);
        return $connection->getResult();
    }

    public function change($data) {
        $id = $data['id'];
        $name = $data['name'];
        $username = $data['username'];

        $enteredPassword = $data['password1'];

        $password = base64_encode($enteredPassword);

        $sql = "UPDATE users SET name = '$name', username = '$username', password = '$password' WHERE id = '$id'";

        $connection = new connection();
        $connection->execute($sql);
        return $connection->getResult();
    }

    public function insert($data) {
        $name = $data['name'];
        $username = $data['username'];
        $enteredPassword = $data['password1'];

        $password = base64_encode($enteredPassword);

        $sql = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')";

        $connection = new connection();
        $connection->execute($sql);
        return $connection->getResult();
    }

    public function load($id) {
        $sql = "SELECT * FROM users WHERE id = $id";

        $connection = new connection();
        $data = $connection->getData($sql);

        $this->id = $data[0]['id'];
        $this->name = $data[0]['name'];
        $this->username = $data[0]['username'];
        $this->password = $data[0]['password'];
    }

}