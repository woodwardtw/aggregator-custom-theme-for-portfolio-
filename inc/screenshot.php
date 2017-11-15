<?php $url = realpath(__DIR__ . '/..'); //set explicit paths to bin etc.
	require_once $url . '/vendor/autoload.php'; //composer autoload 
   
	//specifics for this WordPress theme
	$remoteSite = get_post_meta( get_the_ID(), 'site-url', true ); //the URL referenced in the post
	$cleanUrl = preg_replace("(^https?://)", "", $remoteSite ); //remove http or https
	$cleanUrl = str_replace('/', "_", $cleanUrl); //replace / with _

   //basic screenshot pieces	
    use JonnyW\PhantomJs\Client;

    $client = Client::getInstance();
    $client->getEngine()->setPath($url . '/bin/phantomjs');

    $width  = 1366;
    $height = 768;
    $top    = 0;
    $left   = 0;
    
    /** 
     * @see JonnyW\PhantomJs\Http\CaptureRequest
     **/
    $delay = 1; // 1 second rendering time

    $request = $client->getMessageFactory()->createCaptureRequest($remoteSite, 'GET');
    $request->setDelay($delay);
    $request->setOutputFile($url . '/screenshots/'. $cleanUrl . '.jpg');
    $request->setViewportSize($width, $height);
    $request->setCaptureDimensions($width, $height, $top, $left);

    /** 
     * @see JonnyW\PhantomJs\Http\Response 
     **/
    $response = $client->getMessageFactory()->createResponse();

    // Send the request
    $client->send($request, $response);

    //set the date of the screenshot
    $date = date('Y-m-d H:i:s');
    update_post_meta( get_the_ID(), 'screenshot-date', $date );

    ?>