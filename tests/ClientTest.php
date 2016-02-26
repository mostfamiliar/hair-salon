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

        protected function tearDown()
        {
          Stylist::deleteAll();
          Client::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Barb";
            $stylist_id = 1;
            $new_client = new Client($name, $stylist_id);

            //Act
            $result = $new_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Barb";
            $stylist_id = 1;
            $id = 2;
            $new_client = new Client($name, $stylist_id, $id);

            //Act
            $result = $new_client->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "don";
            $id = null;
            $new_stylist = new Stylist($name, $id);
            $new_stylist->save();

            $name = "Barb";
            $stylist_id = $new_stylist->getId();
            $id = null;
            $new_client = new Client($name, $stylist_id, $id);
            $new_client->save();


            //Act
            $result = Client::getAll();
            var_dump($new_client);
            var_dump($result);
            //Assert
            $this->assertEquals($new_client, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $name = "toody";
            $id = null;
            $new_stylist = new Stylist($name, $id);
            $new_stylist->save();

            $name = "Patty";
            $stylist_id = $new_stylist->getId();
            $new_client = new Client($name, $stylist_id, $id);
            $new_client->save();

            $name2 = "Monica";
            $new_client2 = new Client($name2, $stylist_id, $id);
            $new_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$new_client, $new_client2], $result);
        }


        // function test_getStylistId()
        // {
        //     //Arrange
        //     $name = "Todd";
        //     $id = null;
        //     $new_stylist = new Stylist($name, $id);
        //     $new_stylist->save();
        //
        //     $name = "Barb";
        //     $stylist_id = 1;
        //     $id = 2;
        //     $new_client = new Client($name, $stylist_id, $id);
        //     $new_client->save();
        //
        //     //Act
        //     $result = $new_client->getStylistId();
        //
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result);
        // }
    }
?>
