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
        if(isset($_GET['genre'])){
            $results_url = $url . '/database/search?genre='. urlencode($_GET["search_term"]) . '&key='. $consumerKey . '&secret=' . $consumerSecret;
            //initialize the session
            $ch = curl_init();
            //Set the User-Agent Identifier
            curl_setopt($ch, CURLOPT_USERAGENT, 'CRATE/0.1 +http://your-site-here.com');
            //Set the URL of the page or file to download.
            curl_setopt($ch, CURLOPT_URL, $results_url);
            //Ask cURL to return the contents in a variable instead of simply echoing them
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //Execute the curl session
            $output = curl_exec($ch);
            //close the session
            curl_close ($ch);

            $results_array = json_decode($output, true);
        } else if (isset($_GET['artist'])) {
            $results_url = $url . '/database/search?artist='. urlencode($_GET["search_term"]) . '&key='. $consumerKey . '&secret=' . $consumerSecret;
            //initialize the session
            $ch = curl_init();
            //Set the User-Agent Identifier
            curl_setopt($ch, CURLOPT_USERAGENT, 'CRATE/0.1 +http://your-site-here.com');
            //Set the URL of the page or file to download.
            curl_setopt($ch, CURLOPT_URL, $results_url);
            //Ask cURL to return the contents in a variable instead of simply echoing them
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //Execute the curl session
            $output = curl_exec($ch);
            //close the session
            curl_close ($ch);

            $results_array = json_decode($output, true);
        } else if (isset($_GET['year'])) {
            $results_url = $url . '/database/search?year='. urlencode($_GET["search_term"]) . '&key='. $consumerKey . '&secret=' . $consumerSecret;
            //initialize the session
            $ch = curl_init();
            //Set the User-Agent Identifier
            curl_setopt($ch, CURLOPT_USERAGENT, 'CRATE/0.1 +http://your-site-here.com');
            //Set the URL of the page or file to download.
            curl_setopt($ch, CURLOPT_URL, $results_url);
            //Ask cURL to return the contents in a variable instead of simply echoing them
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //Execute the curl session
            $output = curl_exec($ch);
            //close the session
            curl_close ($ch);

            $results_array = json_decode($output, true);
        } else {
            $results_url = $url . '/database/search?q='. urlencode($_GET["search_term"]) . '&key='. $consumerKey . '&secret=' . $consumerSecret;
            //initialize the session
            $ch = curl_init();
            //Set the User-Agent Identifier
            curl_setopt($ch, CURLOPT_USERAGENT, 'CRATE/0.1 +http://your-site-here.com');
            //Set the URL of the page or file to download.
            curl_setopt($ch, CURLOPT_URL, $results_url);
            //Ask cURL to return the contents in a variable instead of simply echoing them
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //Execute the curl session
            $output = curl_exec($ch);
            //close the session
            curl_close ($ch);

            $results_array = json_decode($output, true);
        }
        $pages_array = $results_array['pagination'];
        print_r($results_array);
        return $app['twig']->render("index.html.twig", array(
            'users' => User::getAll(),
            'results' => $results_array['results'],
            'pages' => $pages_array
        ));
    });

    $app->get("/search/{page}", function($page) use ($app){
        $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
        $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
        $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
        $url = "https://api.discogs.com/"; // add the resource info to the url. Ex. releases/1

        $results_url = $url . '/database/search?q=' . urlencode($_GET["search_term"]). '&per_page=50&secret=' . $consumerSecret . '&page='. $page . '&key='. $consumerKey;
        //initialize the session
        $ch = curl_init();
        //Set the User-Agent Identifier
        curl_setopt($ch, CURLOPT_USERAGENT, 'CRATE/0.1 +http://your-site-here.com');
        //Set the URL of the page or file to download.
        curl_setopt($ch, CURLOPT_URL, $results_url);
        //Ask cURL to return the contents in a variable instead of simply echoing them
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //Execute the curl session
        $output = curl_exec($ch);
        //close the session
        curl_close ($ch);

        $results_array = json_decode($output, true);
        $pages_array = $results_array['pagination'];

        return $app['twig']->render("index.html.twig", array(
            'users' => User::getAll(),
            'results' => $results_array['results'],
            'pages' => $pages_array
        ));
    });

    $app->get("/artist/{id}", function($id) use ($app){
        https://api.discogs.com/artists/1982526
        $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
        $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
        $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
        $url = "https://api.discogs.com/";

        $results_url = $url . '/artists/' . $id;

        $ch = curl_init();
        //Set the User-Agent Identifier
        curl_setopt($ch, CURLOPT_USERAGENT, 'CRATE/0.1 +http://your-site-here.com');
        //Set the URL of the page or file to download.
        curl_setopt($ch, CURLOPT_URL, $results_url);
        //Ask cURL to return the contents in a variable instead of simply echoing them
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //Execute the curl session
        $output = curl_exec($ch);
        //close the session
        curl_close ($ch);

        $results_array = json_decode($output, true);
        print_r($results_array);
        return $app['twig']->render("artist_bio.html.twig", array(
            'users' => User::getAll(),
            'results' => $results_array
        ));
    });

    return $app;
?>
