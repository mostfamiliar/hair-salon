<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Stylist.php";
require_once "src/Client.php";

$server = 'mysql:host=localhost;dbname=hair_salon_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class  StylistTest  extends PHPUnit_Framework_TestCase{


        protected function tearDown()
        {
          Stylist::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Bob";
            $new_stylist = new Stylist($name);

            //Act
            $result = $new_stylist->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Trish";
            $id = 1;
            $new_stylist = new Stylist($name, $id);

            //Act
            $result = $new_stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Sean";
            $new_stylist = new Stylist($name);
            $new_stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($new_stylist, $result[0]);

        }
        function test_getClients()
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
            $result = $new_stylist->getClients();

            //Assert
            $this->assertEquals([$new_client, $new_client2], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Sean";
            $new_stylist = new Stylist($name);
            $new_stylist->save();

            $name2 = "Patty";
            $new_stylist2 = new Stylist($name2);
            $new_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$new_stylist, $new_stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Hannah";
            $new_stylist = new Stylist($name);
            $new_stylist->save();

            $name2 = "James";
            $new_stylist2 = new Stylist($name2);
            $new_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        function test_update()
        {
            //Arrange
            $name = "Hannah";
            $id = null;
            $new_stylist = new Stylist($name, $id);
            $new_stylist->save();

            $new_name = "Hans";

            //Act
            $result = $new_stylist->update($new_name);


            //Assert
            $this->assertEquals($new_name, $new_stylist->getName());
        }

        function test_deleteStylist()
        {
            //Arrange
            $name = "Hannah";
            $id = null;
            $new_stylist = new Stylist($name, $id);
            $new_stylist->save();

            $name2 = "James";
            $new_stylist2 = new Stylist($name2, $id);
            $new_stylist2->save();


            //Act
            $new_stylist->deleteStylist();

            //Assert
            $this->assertEquals([$new_stylist2], Stylist::getAll());
        }

        function test_find()
        {
            //Arrange
            $name = "Hannah";
            $new_stylist = new Stylist($name);
            $new_stylist->save();
            $name2 = "Mark";
            $new_stylist2 = new Stylist($name);
            $new_stylist2->save();

            //Act
            $result = Stylist::find($new_stylist->getId());

            //Assert
            $this->assertEquals($new_stylist, $result);
        }


}
 ?>
