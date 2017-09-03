<?php
$title    = NULL;
$username = NULL;
$counter  = NULL;

$title    = $atts['title'];
$username = $atts['username'];
$counter  = $atts['counter'];


if ( $counter == 'right' ) {
	$counter = 'horizontal';
} else if ( $counter == 'top' ) {
	$counter = 'vertical';
} else {
	$counter = 'none';	
}

echo '<a href="//twitter.com/share" class="twittertweet twitter-share-button" data-text="' . $title . '" data-count="' . $counter . '" data-via="' . $username . '" data-lang="en">Tweet</a>';
?>