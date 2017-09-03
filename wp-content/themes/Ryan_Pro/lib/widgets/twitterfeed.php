<?php

/* Declare constants */
define( 'TS_PLUGIN_DIR', get_template_directory() . '/lib/widgets' );
define( 'TS_PLUGIN_URL', get_template_directory_uri() . '/lib/widgets' );

/* ----------------------------------------------------------------------------------
	Twitter Feed
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'thinkup_widget_tweet_scroll' ) ) {
	class thinkup_widget_tweet_scroll extends WP_Widget {

		/* Register widget description. */
		public function __construct() {
			$widget_ops = array('classname' => 'widget thinkup_widget_twitterfeed', 'description' => 'Displays your latest tweets.' );
			parent::__construct('thinkup_widget_tweet_scroll', 'ThinkUpThemes: Twitter Feed', $widget_ops);
		}

		/* Add widget structure to Admin area. */
		function form($instance) {
			$default_entries = array(
				'title'               => 'Twitter',
				'username'            => 'ThinkUpThemes',
				'visible_tweets'      => '10',
				'time'                => true,
				'date_format'         => 'style2',
				'consumer_key'        => '',
				'consumer_secret'     => '',
				'access_token'        => '',
				'access_token_secret' => '',
			);
			$instance = wp_parse_args((array) $instance, $default_entries);
			?>

			<!-- Widget Title: Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ryan') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" type="text" />
			</p>

			<!-- Username: Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:', 'ryan') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" type="text" />
			</p>

			<!-- Visible Tweets: Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id('visible_tweets'); ?>"><?php _e('Number of tweets to show:', 'ryan') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('visible_tweets'); ?>" name="<?php echo $this->get_field_name('visible_tweets'); ?>" value="<?php echo $instance['visible_tweets']; ?>" type="text" />
			</p>

			<!-- Time: Checkbox Input -->
			<p>
					<label for="<?php echo $this->get_field_id('time'); ?>"><?php _e('Show or hide timestamp:', 'ryan') ?></label><br />
				<input type="checkbox" id="<?php echo $this->get_field_id('time'); ?>" name="<?php echo $this->get_field_name('time'); ?>" <?php if ($instance['time'] == true) echo 'checked' ?>/><label for="<?php echo $this->get_field_id('time'); ?>"> <?php _e('Show', 'ryan') ?></label>
			</p>

			<!-- Date Format: Radio Input -->
			<p>
				<label for="<?php echo $this->get_field_id('date_format'); ?>"><?php _e('Date Format:', 'ryan') ?></label><br />
				<input type="radio" id="<?php echo $this->get_field_id('date_format'); ?>-1" name="<?php echo $this->get_field_name('date_format'); ?>" value="style1" <?php if ($instance['date_format'] == 'style1') echo 'checked=checked' ?>/> <label for="<?php echo $this->get_field_id('date_format'); ?>-1"> <?php _e('European', 'ryan') ?></label><br />
				<input type="radio" id="<?php echo $this->get_field_id('date_format'); ?>-2" name="<?php echo $this->get_field_name('date_format'); ?>" value="style2" <?php if ($instance['date_format'] == 'style2') echo 'checked=checked' ?>/> <label for="<?php echo $this->get_field_id('date_format'); ?>-2"> <?php _e('American', 'ryan') ?></label>
			</p>

			<!-- Consumer Key -->
			<p>
				<label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key:', 'ryan') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $instance['consumer_key']; ?>" type="text" />
			</p>

			<!-- Consumer Secret -->
			<p>
				<label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret:', 'ryan') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $instance['consumer_secret']; ?>" type="text" />
			</p>

			<!-- Access Token -->
			<p>
				<label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token:', 'ryan') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" type="text" />
			</p>

			<!-- Access Token Secret -->
			<p>
				<label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Token Secret:', 'ryan') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" type="text" />
			</p>

			<?php
		}

		/* Assign variable values. */
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title']               = strip_tags($new_instance['title']);
			$instance['username']            = strip_tags($new_instance['username']);
			$instance['visible_tweets']      = strip_tags($new_instance['visible_tweets']);
			$instance['time']                = strip_tags($new_instance['time']);
			$instance['date_format']         = strip_tags($new_instance['date_format']);
			$instance['consumer_key']        = strip_tags($new_instance['consumer_key']);
			$instance['consumer_secret']     = strip_tags($new_instance['consumer_secret']);
			$instance['access_token']        = strip_tags($new_instance['access_token']);
			$instance['access_token_secret'] = strip_tags($new_instance['access_token_secret']);
			return $instance;
		}

		/* Output widget to front-end. */
		function widget($args, $instance) {
			extract($args);

			/* Our variables from the widget settings */
			$title               = apply_filters('widget_title', $instance['title']);
			$username            = $instance['username'];
			$visible_tweets      = $instance['visible_tweets'];
			$time                = $instance['time'];
			$date_format         = $instance['date_format'];
			$consumer_key        = $instance['consumer_key'];
			$consumer_secret     = $instance['consumer_secret'];
			$access_token        = $instance['access_token'];
			$access_token_secret = $instance['access_token_secret'];

			/* Before widget (defined by theme functions file) */
			echo $before_widget;
			if ($title)
				echo $before_title . $title . $after_title;

			/* generate random ID */
			$twitter_id = rand(1, 100);

			/* current instance id */
			$current_instance_id = substr($this->id, strrpos($this->id, '-') + 1);

			/* Display Latest Tweets */
			?>
			<div id="tweets-list-id-<?php echo $twitter_id ?>" class="tweets-list-container aside" data-instance-id="<?php echo $current_instance_id ?>"></div>

			<?php
			$time ? $timevar = 'true' : $timevar = 'false';
			?>
			<script>
				jQuery(function($){
					jQuery('#tweets-list-id-<?php echo $twitter_id ?>').tweetscroll({
						username: '<?php echo $username ?>', 
						time: <?php echo $timevar ?>, 
						date_format: '<?php echo $date_format ?>',
						visible_tweets: <?php echo $visible_tweets ?>
					});
				});
																												
			</script>
		   <?php

			echo $after_widget;
		}

	}
	add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_widget_tweet_scroll");') );


	/* Enqueue scripts */
	function thinkup_widget_tweet_enqueue_scripts() {
		wp_register_script('tweetscroll', TS_PLUGIN_URL . '/twitterfeed/js/jquery.tweetscroll.js', array('jquery'), '' );
		wp_enqueue_script('tweetscroll');

		/* declare object for URL */
		wp_localize_script('tweetscroll', 'PiTweetScroll', array('ajaxrequests' => admin_url('admin-ajax.php')));
	}
	add_action('wp_enqueue_scripts', 'thinkup_widget_tweet_enqueue_scripts', 11 );


	if (!function_exists('thinkup_widget_tweetscroll_ajax')) {

		function thinkup_widget_tweetscroll_ajax() {
			session_start();

			require_once( TS_PLUGIN_DIR . "/twitterfeed/functions/twitteroauth.php" ); //Path to twitteroauth library

			$current_instance_id = $_GET['instance_id'];
			$instances_options = get_option('widget_thinkup_widget_tweet_scroll');
			$widget_options = $instances_options[$current_instance_id];

			$twitteruser = $_GET['username'];
			$notweets = $widget_options['visible_tweets'];
			$consumerkey = $widget_options['consumer_key'];
			$consumersecret = $widget_options['consumer_secret'];
			$accesstoken = $widget_options['access_token'];
			$accesstokensecret = $widget_options['access_token_secret'];

			function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
				$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
				return $connection;
			}

			$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
			$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $twitteruser . "&count=" . $notweets );

			echo json_encode($tweets);
			exit;
		}

	}
	add_action('wp_ajax_nopriv_thinkup_widget_tweetscroll_ajax', 'thinkup_widget_tweetscroll_ajax');
	add_action('wp_ajax_thinkup_widget_tweetscroll_ajax', 'thinkup_widget_tweetscroll_ajax');
}