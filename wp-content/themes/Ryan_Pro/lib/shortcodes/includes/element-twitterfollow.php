<?php
$counter  = NULL;
$username = NULL;

$counter   = $atts['counter'];
$username  = $atts['username'];


if ( $counter == 'on' ) {
	$counter = 'true';
} else {
	$counter = 'false';	
}

echo '<div class="twitterfollow">',
	 '<a href="//twitter.com/' . $username . '" class="twitter-follow-button" data-show-count="' . $counter . '" data-lang="en">Follow @ ' . $username . '</a>',
	 '</div>';


?>