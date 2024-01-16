<?php
    namespace Core;

    use mysqli;

    class database
    {
        public function __construct()
        {
            $servername = "localhost";
            $username = "root";
            $password = "123";

            //$conn = mysql_connect($servername, $username, $password
            $conn = new mysqli($servername, $username, $password);

            if(!$conn) {
                //die ("Connection failed: " . mysqli_connect_error());
                die("Connection failed: " . $conn->connect_error());
            }
            echo "Connected successfully ";
        }

        public function HelloWorld(){
            echo "Hello World";
        }
    }
?>