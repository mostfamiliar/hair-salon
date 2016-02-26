<?php
    class Stylist {
            private $name;
            private $id;

            function __construct($name, $id = null)
            {
                $this->name = $name;
                $this->id = $id;
            }

            function setName($new_name)
            {
                $this->name = $new_name;
            }

            function getName()
            {
                return $this->name;
            }

            function getId()
            {
                return $this->id;
            }

            function save()
            {
                $GLOBALS['DB']->exec("INSERT INTO stylist (name) VALUES ('{$this->getName()}');");
                $this->id = $GLOBALS['DB']->lastInsertId();
            }

            function getClients()
            {
                $clients = array();
                $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client WHERE    stylist_id = {$this->getId()}");

                foreach($returned_clients as $client) {
                      $name = $client['name'];
                      $stylist_id = $client['stylist_id'];
                      $id = $client['id'];
                      $new_client = new Client($name, $stylist_id, $id);
                      array_push($clients, $new_client);
                  }

              return $clients;
            }

            static function getAll()
            {
                $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylist;");
                $stylists = array();

                foreach($returned_stylists as $stylist)
                {
                    $name = $stylist['name'];
                    $id = $stylist['id'];
                    $new_stylist = new Stylist($name, $id);
                    array_push($stylists, $new_stylist);
                }

                return $stylists;
            }

            function update($new_name)
            {
                $GLOBALS['DB']->exec("UPDATE stylist SET name =
                '{$new_name}' WHERE id = {$this->getId()};");
                $this->setName($new_name);
            }

            static function find($search_id)
            {
                $found_stylist = null;
                $stylists = Stylist::getAll();
                foreach($stylists as $stylist)
                {
                    $stylist_id = $stylist->getId();
                    if ($stylist_id == $search_id)
                    {
                        $found_stylist = $stylist;
                    }
                }

                return $found_stylist;
            }

            function deleteStylist()
            {
                $GLOBALS['DB']->exec("DELETE FROM stylist WHERE id = {$this->getId()};");
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM stylist;");
            }



} ?>
