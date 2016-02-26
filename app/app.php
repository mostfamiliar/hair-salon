<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__."/../views"
    ));

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app)
    {
        $stylist = new Stylist($_POST['stylist']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));

    });

    $app->post("/clients", function() use ($app)
    {
        $name = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];
        $new_client = new Client($name, $stylist_id, $id = null);
        $new_client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylists.html.twig', array('stylist'=> $stylist, 'clients' => $stylist->getClients()));

    });

    $app->post("/delete_stylists", function() use ($app)
    {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function ($id) use ($app)
    {
        $stylist = Stylist::find($id);
        $client = Stylist::find($id);
        return $app['twig']->render('stylists.html.twig', array('stylist'=> $stylist, 'clients' => $client));
    });

    $app->patch("/clients/{id}", function ($id) use ($app)
    {
        $new_name = $_POST['new_name'];
        $client = Client::find($id);
        $client->updateName($new_name);
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylists.html.twig', array('stylist'=> $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/delete_all_clients", function() use ($app)
    {
        Client::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/delete_stylists", function() use ($app)
    {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/clients/{id}/edit", function ($id) use ($app)
    {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });



    return $app;
 ?>
