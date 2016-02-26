<?php
  class Client {
      private $name;
      private $client_id;
      private $id;

      function __construct($name, $client_id, $id = null)
      {
          $this->name = $name;
          $this->client_id = $client_id;
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

      function getClientId()
      {
          return $this->client_id;
      }

      function getId()
      {
          return $this->id;
      }




  } ?>
