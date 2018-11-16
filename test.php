<html>
<head>
	<meta charset="UTF-8"/>
<title>HashTag Search</title>
</head>
<form method="post">
	"Donot include # Symbol" Only type the word:
	<input type="text" name="Tweet" placeholder="search Words"/>
    <input type="submit" name="test" value="Search" /><br/>	
</form>
</html>

<?php
if(array_key_exists('test',$_POST))
{
   searchfun();
}

function searchfun()
{
	$t=$_POST["Tweet"];
	$scr='#'.$t;
	$list ="";
	include "include/twitteroauth.php";
	$accesstoken = "1062409241195999232-CxyW2MpRfMonllz0e7wKcpk1mmK14a";
	$accesstokensecret= "XbEck22Y212pk21p6KSIvgTBnahEPiuXEgb4NocIBceXI";
	$consumer = "UBYHUSbWOiuST4HH2dzGzDCS2";
	$consumersecret ="50bwfS1xt5VVfYNf9UFIhKLpOcYTj1DYPu76EfDsfSQeJHfX9z";
	$twitter=new TwitterOAuth($consumer,$consumersecret,$accesstoken,$accesstokensecret);
	$tweets=$twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$_POST["Tweet"].'&result_type=mixed&count=100');
	foreach ($tweets as $tweet) {
			foreach ($tweet as $tw) {
				//echo $tw->text.'<br>.';
				if (is_object($tw) && stripos($tw->text,$scr)!== false) 
				{
					$list = $list . "@" . $tw->user->screen_name ."<br/>";
				}
			}
	}
	echo $list;
}
?>