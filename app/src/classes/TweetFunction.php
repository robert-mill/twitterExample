<?php
define('DBHOST','localhost');
define('DBUSERNAME','root');
define('DBPASSWORD','');
define('DBNAME','twitter_db');
define('TWEETTABLE','tweettable');

require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "303889012-yMgmiuUCQW7qZFMIXre21csG640xXMyljLkPjjfv",
    'oauth_access_token_secret' => "5bc8xsM0wvV6r62V6bQHtewgk7PcUiARt2ODHZrqTizay",
    'consumer_key' => "ljyURaKDwxqOunLqD3jOEZtcB",
    'consumer_secret' => "pLVDtqwNeianI8bKDDwvRbN4XWcEnmWdeR3EqkE8XZuRHA3zYM"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$requestMethod = "GET";

$getfield = '?screen_name=easyjet&count=20';
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest(),$assoc = TRUE);
if( isset($string["errors"])  && $string["errors"][0]["message"] != "") {
    echo "<h3>Sorry, there was a  problem.</h3><p>Twitter returned the following error message:</p><p>     <em>".$string['errors'][0]["message"]."</em></p>";exit();}
if($string!==NULL){
    //Thu Jul 07 12:25:29 +0000 2016


    foreach($string as $items)
    {
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet ID: ".$items['id_str']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br /><hr />";
        echo "friends_count: ". $items['user']['friends_count']."<br /><hr />";
        echo "favourites_count: ". $items['user']['favourites_count']."<br /><hr />";

        echo insertTweets($items['user']['name'],$items['user']['screen_name'],$items['text'],$items['created_at'],$items['id_str'],$items['user']['followers_count']);
    }

}else{
    echo 'GGG';
}
function insertTweets($name,$screen_name,$text,$created_at,$id_str,$followers_count){
    $mysqli = new mysqli(DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);
    if ($mysqli->connect_errno) {
        return 'Failed to connect to Database: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
    }

    $prepareStmt='INSERT INTO '.DBNAME.'.'.TWEETTABLE.' (name, screen_name, text, created_at, id_str, followers_count) VALUES (?,?,?,?,?,?);';
    if ($insert_stmt = $mysqli->prepare($prepareStmt)){
        $insert_stmt->bind_param('ssssid', $name,$screen_name,$text,$created_at,$id_str,$followers_count);
        if (!$insert_stmt->execute()) {
            $insert_stmt->close();
            return 'Tweet Creation cannot be done at this moment.';
        }elseif($insert_stmt->affected_rows>0){
            $insert_stmt->close();
            return 'Tweet Added.';
        }else{
            $insert_stmt->close();
            return 'No Tweet were Added.';
        }
    }else{
        return 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error;
    }
}              ?>