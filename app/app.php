    <?php


    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/User.php';



    $server = 'mysql:host=localhost;dbname=discogs';
    $user = 'root';
    $password = 'root';
    $DB = new PDO($server, $user, $password);



    $app = new Silex\Application();


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__ . '/../views',
    ));

    $app->get("/", function() use ($app){

        return $app['twig']->render("index.html.twig", array(
            'users' => User::getAll()
        ));
    });

    $app->get("/search", function() use ($app){
        $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
        $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
        $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
        $url = "https://api.discogs.com/"; // add the resource info to the url. Ex. releases/1
        $artists_url = $url . '/database/search?artist='. urlencode($_GET["artist"]) . '&key='. $consumerKey . '&secret=' . $consumerSecret;
        //initialize the session
        $ch = curl_init();
        //Set the User-Agent Identifier
        curl_setopt($ch, CURLOPT_USERAGENT, 'YOUR_APP_NAME_HERE/0.1 +http://your-site-here.com');
        //Set the URL of the page or file to download.
        curl_setopt($ch, CURLOPT_URL, $artists_url);
        //Ask cURL to return the contents in a variable instead of simply echoing them
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //Execute the curl session
        $output = curl_exec($ch);
        //close the session
        curl_close ($ch);

        $artists_array = json_decode($output, true);
        // print_r($artists_array);
        // $img = $artists_array['results'][0]['thumb'];
        // print_r($artists_array['results']);


        return $app['twig']->render("index.html.twig", array(
            'users' => User::getAll(),
            'results' => $artists_array['results']
        ));
    });

    return $app;
?>
