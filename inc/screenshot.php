<?php $url = realpath(__DIR__ . '/..'); //set explicit paths to bin etc.
	require_once $url . '/vendor/autoload.php'; //composer autoload 
   
	//specifics for this WordPress theme
	$remoteSite = get_post_meta( get_the_ID(), 'site-url', true ); //the URL referenced in the post
	$cleanUrl = preg_replace("(^https?://)", "", $remoteSite ); //remove http or https
	$cleanUrl = str_replace('/', "_", $cleanUrl); //replace / with _
	var_dump($cleanUrl);

   //basic screenshot pieces	
    use JonnyW\PhantomJs\Client;

    $client = Client::getInstance();
    $client->getEngine()->setPath($url . '/bin/phantomjs');
	
    $width  = 1200;
    $height = 800;
    $top    = 0;
    $left   = 0;
    
    /** 
     * @see JonnyW\PhantomJs\Http\CaptureRequest
     **/
    $request = $client->getMessageFactory()->createCaptureRequest($remoteSite, 'GET');
    $request->setOutputFile($url . '/screenshots/'. $cleanUrl . '.jpg');
    $request->setViewportSize($width, $height);
    $request->setCaptureDimensions($width, $height, $top, $left);

    /** 
     * @see JonnyW\PhantomJs\Http\Response 
     **/
    $response = $client->getMessageFactory()->createResponse();

    // Send the request
    $client->send($request, $response);
    ?>