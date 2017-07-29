<?php 
/*
Plugin Name: Funny ChatBot
Plugin URI: https://huykira.net/share-code/share-plugin-funny-chatbot.html
Description: Funny Chat Bot by Huy Kira
Author: Huy Kira
Version: 1.0
Author URI: https://www.huykira.net
*/
if ( !function_exists( 'add_action' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

define('FCB_PLUGIN_URL', plugin_dir_url(__FILE__));
define('FCB_PLUGIN_RIR', plugin_dir_path(__FILE__));
require_once(FCB_PLUGIN_RIR . 'includes/shortcode.php');

add_action('admin_menu', 'fcb_add_menu');
function fcb_add_menu() {
	add_menu_page( 
    	__( 'Funny Chat Bot', 'textdomain' ),
        'Funny Chat Bot',
        'manage_options',
        'fcb_seting',
        'fcb_page',
        'dashicons-smiley'
	);
	add_action( 'admin_init', 'fcb_my_setting' );
};
function fcb_my_setting() {
	register_setting( 'chat_bot', 'fcb_options' );
	register_setting( 'chat_bot', 'some_other_option' );
  	register_setting( 'chat_bot', 'option_etc' ); 
}

function fcb_setting_script() { ?>
<?php
	$options = get_option('fcb_options');
	$message = array();
	$message_options = trim(preg_replace('/\s\s+/', ' ', $options['message']));
	$message = explode('|', $message_options);
	$count = count($message);
?>
<script type="text/javascript">
  	var fcb_message = new Array(<?php foreach ($message as $value) { ?>'<?php echo $value; ?>',<?php } ?>);
	var fcb_img_load = '<?php echo FCB_PLUGIN_URL . "images/load.gif"; ?>';
	var fcb_count = <?php echo $count; ?>;
</script>
<?php }
add_action( 'wp_footer', 'fcb_setting_script' );
add_action( 'admin_footer', 'fcb_setting_script' );

function fcb_styles()  
{ 
    wp_enqueue_style( 'fcb_style', FCB_PLUGIN_URL . 'css/fcb_style.css' );
    wp_enqueue_style( 'fcb_font_icon', FCB_PLUGIN_URL . 'css/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_script( 'fcb_script', FCB_PLUGIN_URL . 'js/fcb_script.js', true, 1.1, true );
}
add_action('wp_enqueue_scripts', 'fcb_styles');

function fcb_styles_admin()  
{ 
    wp_enqueue_style( 'fcb_style', FCB_PLUGIN_URL . 'css/fcb_style_admin.css' );
    wp_enqueue_style( 'fcb_font_icon', FCB_PLUGIN_URL . 'css/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_script( 'fcb_script', FCB_PLUGIN_URL . 'js/fcb_script.js', true, 1.1, true );
}
add_action('admin_enqueue_scripts', 'fcb_styles_admin');

function fcb_page(){ ?>
	<?php $options = get_option('fcb_options'); ?>
	<div class="wrap tp-app">
		<h2>FUNNY CHAT BOT</h2>
		<div id="col-container" class="wp-clearfix">
			<div id="col-left" style="float: left;">
				<div class="col-wrap">
					<div class="form-wrap">
						<h2> Setting chat bot</h2>
						<form id="addtag" method="post" action="options.php" class="validate">
				    		<?php settings_fields( 'chat_bot' ); ?>
				    		<?php do_settings_sections( 'chat_bot' ); ?>
				    		<div class="form-field form-required fcb_options_name-wrap">
								<label for="fcb_options_name">Name</label>
								<input type="text" size="100" aria-required="true" id="fcb_options_name" name="fcb_options[name]" value="<?php if($options['name']) { echo $options['name']; } else { echo 'Mai Anh'; } ?>" />
							</div>

							<div class="form-field form-required fcb_options_color-wrap">
								<label for="fcb_options_color">Color</label>
								<input style="width: 120px; height: 50px;" type="color" size="100" aria-required="true" id="fcb_options_color" name="fcb_options[color]" value="<?php if($options['color']){ echo $options['color']; } else { echo '#ec7ebd'; } ?>" />
							</div>

				    		<div class="form-field form-required fcb_options_avatar-wrap">
								<label for="fcb_options_avatar">Url images Avatar</label>
								<input type="url" size="100" aria-required="true" id="fcb_options_avatar" name="fcb_options[avatar]" value="<?php if($options['avatar']){ echo $options['avatar']; } else { echo FCB_PLUGIN_URL . 'images/avt.jpg'; } ?>" />
								<p>Recommended size: 100x100</p>
							</div>

							<div class="form-field fcb_options_start-wrap">
								<label for="fcb_options_start">Start message</label>
								<textarea name="fcb_options[start]" id="fcb_options_start" rows="5" cols="40"><?php echo $options['start']; ?></textarea>
								<p>Separate message with "|"</p>
							</div>

							<div class="form-field fcb_options_message-wrap">
								<label for="fcb_options_message">Random message</label>
								<textarea name="fcb_options[message]" id="fcb_options_message" rows="10" cols="40"><?php echo $options['message']; ?></textarea>
								<p>Separate message with "|"</p>
							</div>

							<div class="form-field fcb_options_contact-wrap">
								<label for="fcb_options_contact">Contact link</label>
								<input type="text" size="100" aria-required="true" id="fcb_options_contact" name="fcb_options[contact]" value="<?php if($options['contact']){ echo $options['contact']; } else { echo '#'; } ?>" />
							</div>

							<div class="form-field fcb_options_placeholder-wrap">
								<label for="fcb_options_placeholder">Placeholder</label>
								<input type="text" size="100" aria-required="true" id="fcb_options_placeholder" name="fcb_options[placeholder]" value="<?php if($options['placeholder']) { echo $options['placeholder']; } else { echo 'Trả lời tại đây...';} ?>" />
							</div>
							<?php submit_button(); ?>
				    	</form>
				    </div>
				</div>
			</div>
			<div id="col-right">
				<div class="col-wrap">
					<div class="form-wrap media-toolbar wp-filter" style="background: #fff; padding-bottom: 15px; padding-left: 15px;">
						<h2>Show chatbot the front end</h2>
						<p>Use the insert code shortcode in the &lt;body&gt; tag</p>
						<code>
					    	&lt;?php echo do_shortcode( '[funny_chat_bot]' ); ?&gt; 
					    </code>
					    <h2>Demo</h2>
					    <?php echo do_shortcode( '[funny_chat_bot]' ); ?>
					</div>
				</div>
			</div>
    	</div>
	</div>
<?php }