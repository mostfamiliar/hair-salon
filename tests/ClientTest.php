<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Client.php";
require_once "src/Stylist.php";

$server = 'mysql:host=localhost;dbname=hair_salon_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);


class  ClientTest  extends PHPUnit_Framework_TestCase{

        // protected function tearDown()
        // {
        //   Stylist::deleteAll();
        //   Client::deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $name = "Barb";
            $client_id = 1;
            $new_client = new Client($name, $client_id);

            //Act
            $result = $new_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
    }
?>
