<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	 
           public function __construct(){

           	parent::__construct();

        $this->output->set_header('Expires: Sat, 06 Feb 2016 05:00:00 GMT');
        $this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
        $this->output->set_header('Pragma: no-cache');

       }

	public function index()
	{

	}

	public function get_map()
	{
		require_once(APPPATH.'controllers/TwitterAPIExchange.php');

		$address = urlencode($this->input->post('address'));
		$tweets_num = $this->input->post('tweets_num');
		$radius = $this->input->post('radius');
		if($radius == '' || $radius == 0){
			$radius = 50;
		}

		if($tweets_num == '' || $tweets_num == 0 || $tweets_num > 100){
			$tweets_num = 15;
		}

		$url = 'http://maps.google.com/maps/api/geocode/json?address='.$address;
		$ch = curl_init();
   		curl_setopt($ch, CURLOPT_URL, $url);
   		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   		$geoloc = json_decode(curl_exec($ch), true);
   		if(count($geoloc['results']) != 0){
   			
   		$formatted_address = $geoloc['results'][0]['formatted_address'];
		$lat = $geoloc['results'][0]['geometry']['location']['lat'];
		$lng = $geoloc['results'][0]['geometry']['location']['lng'];
		$location = $lat . ',' . $lng . ',' . $radius . 'km';

		$settings = array(
    'oauth_access_token' => "631982613-KrFPScU3Z203jQ63pg5Sx4g277mSgfl0N1v6EBU7",
    'oauth_access_token_secret' => "Q7MGwYwnuWT4LQFr5iXCLZyd7PZYFQwW6BvQzxsRrWzjQ",
    'consumer_key' => "HYLrNMAxj2L5DenPyjvWJPDbL",
    'consumer_secret' => "UT3J1ONFc1aWQAEBFHYfvjYCynWhFCAqdeMEDuZvWaSOvNMyGo"
	);
		$searchURL = 'https://api.twitter.com/1.1/search/tweets.json';
		$requestMethod = 'GET';
		$getfield = '?lang=en&q=&count='.$tweets_num.'&geocode='.$location;
		$twitter = new TwitterAPIExchange($settings);
		$tweets = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($searchURL, $requestMethod)
             ->performRequest());


		$items = $tweets->statuses;
		$tweets_array = array();
		foreach ($items as $key) {
			if($key->geo != null && count($key->geo) != 0 ){
			$tweet_array = array(
				'created'=>$key->created_at,
				'tweet'=>$key->text,
				'profile'=>$key->user->profile_image_url,
				'username'=>$key->user->name,
				'tag'=>$key->user->screen_name,
				'geo'=>$key->geo
				);
			array_push($tweets_array, $tweet_array);
		}
		}
	}else{

		$tweets_array = array();
		$formatted_address = '';
	}

		$result=array('tweets'=>$tweets_array,'status'=>'ok','formatted_address'=>$formatted_address);
		echo json_encode($result);

	}

}
