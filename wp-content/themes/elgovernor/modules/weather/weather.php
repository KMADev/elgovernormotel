<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 4/25/2017
 * Time: 10:02 PM
 */

function getNewWeather($loc){

	$cacheFile = "cache/weather";

	if ( file_exists($cacheFile)){
		$filetime = filemtime($cacheFile);
		$minago = strtotime('-15 minutes');

		if($filetime > $minago) {
			$data = file_get_contents($cacheFile);
			return $data;
		}else {

			unlink( $cacheFile );

		}
	}

	$BASE_URL = "http://query.yahooapis.com/v1/public/yql";
	$yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$loc.'")';
	$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";

	$session = curl_init($yql_query_url);
	curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
	$json = curl_exec($session);
	file_put_contents( $cacheFile, $json );

	return $json;
}

add_action('wp_ajax_loadWeather', 'loadWeather');
add_action('wp_ajax_nopriv_loadWeather', 'loadWeather');
function loadWeather(){

    $result[] = '';

	$loc = $_REQUEST['location'];
	$weather = getNewWeather($loc);

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo $weather;
    }

	wp_die();

}

//[getweather days="1" format="mini" location="Port St. Joe, FL"]
function getweather_func( $atts ){
    $debugweather = FALSE;

    $a = shortcode_atts(array(
        'days' => 1,
        'format' => 'mini',
        'location' => 'Mexico Beach, FL',
    ), $atts);

    if($debugweather) {
        print_r( array(
            'days' => $a['days'],
            'format' => $a['format'],
            'location' => $a['location'],
        ));
    }

    $output = '<div class="weather" data-location="' . $a['location'] . '" data-format="' . $a['format'] . '" data-days="' . $a['days'] . '" ><div class="weather-container "><!--'.$_SESSION['weather'].'--></div></div>';

    wp_enqueue_style('weather-style' );
    wp_enqueue_script( 'weather-ajax' );

    return $output;

}
add_shortcode( 'getweather', 'getweather_func' );