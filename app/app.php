
 <?php



    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/User.php';
    require_once __DIR__.'/../src/Record.php';
    session_start();

    $server = 'mysql:host=localhost;dbname=discogs';
    $user = 'root';
    $password = 'root';
    $DB = new PDO($server, $user, $password);


    // session_start();
    // if( isset($_SESSION['search_term'])){
    //   echo "set";
    // }

    $app = new Silex\Application();


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__ . '/../views',
    ));

    $app->get("/", function() use ($app){
      $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
      $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
      $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
      $url = "https://api.discogs.com/";

      $results_url = $url . '/database/search?q=&per_page=50&key='. $consumerKey . '&secret=' . $consumerSecret;

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

    $app->get("/search", function() use ($app){
        $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
        $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
        $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
        $url = "https://api.discogs.com/"; // add the resource info to the url. Ex. releases/1
        $search_term = $_GET["search_term"];
        $_SESSION['search_term'] = $search_term;


        if(isset($_GET['genre'])){
            $results_url = $url . '/database/search?genre='. urlencode($_SESSION['search_term']) . '&per_page=50&key='. $consumerKey . '&secret=' . $consumerSecret;
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
            $results_url = $url . '/database/search?artist='. urlencode($_SESSION['search_term']) . '&key='. $consumerKey . '&secret=' . $consumerSecret;
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
            $results_url = $url . '/database/search?year='. urlencode($_SESSION['search_term']) . '&per_page=50&key='. $consumerKey . '&secret=' . $consumerSecret;
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
            $results_url = $url . '/database/search?type=release&q='. urlencode($_SESSION['search_term']) . '&per_page=50&key='. $consumerKey . '&secret=' . $consumerSecret;
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
            // print_r($results_array);
        }
        $pages_array = $results_array['pagination'];
        // print_r($results_array);
        return $app['twig']->render("search.html.twig", array(
            'user' => $_SESSION['user'],
            'results' => $results_array['results'],
            'pages' => $pages_array
        ));
    });

    $app->get("/search/{page}", function($page) use ($app){
        // print_r($_SESSION['search_term']);
        $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
        $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
        $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
        $url = "https://api.discogs.com/"; // add the resource info to the url. Ex. releases/1


        $results_url = $url . '/database/search?q=' . urlencode($_SESSION['search_term']) . '&per_page=50&secret=' . $consumerSecret . '&page='. $page . '&key='. $consumerKey;
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
        $type = $results_array['type'];
        $pages_array = $results_array['pagination'];

        return $app['twig']->render("search.html.twig", array(
            'users' => User::getAll(),
            'results' => $results_array['results'],
            'pages' => $pages_array
        ));
    });

    $app->get("/release/{id}", function($id) use ($app){
        // https://api.discogs.com/artists/1982526
        $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
        $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
        $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
        $url = "https://api.discogs.com/";
        $_SESSION['release_id'] = $id;
        $results_url = $url . '/releases/' . $_SESSION['release_id'] . '?key=' . $consumerKey . '&secret=' . $consumerSecret;
        // $_SESSION['']
        // results curl
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



        // // print_r($results_array['videos'][0]['uri']);
        // // releases curl
        // $releases_url = $url . '/artists/' . $id .'/releases'. '?key=' . $consumerKey . '&secret=' . $consumerSecret;
        // $ch2 = curl_init();
        // //Set the User-Agent Identifier
        // curl_setopt($ch2, CURLOPT_USERAGENT, 'CRATE/0.1 +http://your-site-here.com');
        // //Set the URL of the page or file to download.
        // curl_setopt($ch2, CURLOPT_URL, $releases_url);
        // //Ask cURL to return the contents in a variable instead of simply echoing them
        // curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        // //Execute the curl session
        // $output = curl_exec($ch2);
        // //close the session
        // curl_close ($ch2);
        //
        // $releases_array = json_decode($output, true);

        // print_r($results_array['videos'][0]['uri']);
        print_r($results_array['labels'][0]);
        return $app['twig']->render("release.html.twig", array(
            'user' => $_SESSION['user'],
            'results' => $results_array,
            'label' => $results_array['labels'][0],
            'year' => $results_array['year'],
            'genres' => $results_array['genres'],
            'tracklist' => $results_array['tracklist'],
            'artist' => $results_array['artists'][0],
            'images' => $results_array['images']
        ));
    });


        //LOGIN ROUTE
        $app->get("/login", function() use ($app){
            $user_name = $_GET['user_name'];
            $password = $_GET['password'];
            $user = User::login($user_name, $password);
            $_SESSION['user'] = $user;
            // print_r(User::getAll());
            if (isset($_SESSION['user'])){
                return $app['twig']->render("collection.html.twig", array(
                    'user' => $_SESSION['user'],
                    'collection' => $user->getRecords()
                ));
            } else {
                $error = "Incorrect login info.";
                return $app['twig']->render("index.html.twig", array('error' => $error));
            }
        });

        //VIEW SINGLE RECORD ROUTE
        $app->get("/view_record/{id}", function($id) use ($app){
            $record = Record::find($id);
            return $app['twig']->render("record.html.twig", array('record' => $record));
        });

        //ADD RECORD TO COLLECTION ROUTE
        $app->post("/add_record", function() use ($app){
            $consumerKey = 'sgLbtXTMMDiImTNCBXgm';
            $consumerSecret = 'EzoLruPOcgrPzIYtiqARnBmbfNPsLYvN';
            $token = 'AlgbUBFeznIfeIvjzNEIvmFmiDQGWHtbgrFJuAGC';
            $url = "https://api.discogs.com/";
            $results_url = $url . '/releases/' . $_SESSION['release_id'] . '?key=' . $consumerKey . '&secret=' . $consumerSecret;
            // $_SESSION['']
            // results curl
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
            $tracks = array();
            $labels = array();
            $images = array();

            foreach($results_array['tracklist'] as $track){
                array_push($tracks, $track['title']);
            }
            foreach($results_array['labels'] as $label){
                array_push($labels, $label['name']);
            }
            foreach($results_array['images'] as $image){
                array_push($images, $image['resource_url']);
            }
            // print_r($results_array['artists'][0]['name']);
            $title = $results_array['tracklist'][0]['title'];
            $artist = $results_array['artists'][0]['name'];
            $genre = $results_array['genres'][0];
            $track = implode($tracks);
            $year = $results_array['year'];
            $label = $labels[0];
            $images = $images[0];
            $id = null;

            $records = $_SESSION['user']->getRecords();
            $found_record = null;

            foreach($records as $record){
                $record_name = $record->getTitle();
                $record_artist = $record->getArtist();
                if($record_name == $title && $record_artist == $artist ){
                    $error = "Already in your collection";
                    return $app['twig']->render("release.html.twig", array('error' => $error));
                } else {
                    $new_record = new Record($title, $artist, $genre, $track, $year, $images, $label, $id);
                    $new_record->save();
                }

            }


        // if record id is in the db
            // then can't add again
            // return record already in collection
        // else
            // add it to collection



            $_SESSION['user']->addRecord($new_record);
            return $app['twig']->render("release.html.twig", array(
                'user' => $_SESSION['user'],
                'results' => $results_array,
                'label' => $results_array['labels'][0],
                'year' => $results_array['year'],
                'genres' => $results_array['genres'],
                'tracklist' => $results_array['tracklist'],
                'artist' => $results_array['artists'][0],
                'images' => $results_array['images'],
                'succes' => $success
            ));
        });

        //DELETE RECORD FROM COLLECTION
        $app->delete("/delete_record/{id}", function($id) use ($app){
            $record = Record::find($id);
            $record->delete();
            return $app['twig']->render("release.html.twig");
        });

        //COLLECTION ROUTE
        $app->get("/view_collection/{id}", function($id) use ($app){
            $user = $_SESSION['user'];
            return $app['twig']->render("collection.html.twig", array('collection' => $user->getRecords()));
        });



    return $app;
?>



<!-- psuedo code -->
<!-- "community": {"status": "Accepted", "rating": {"count": 237, "average": 4.77} -->
