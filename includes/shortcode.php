<?php 
function fcb_shortcode($args){ ?>
	<?php $options = get_option('fcb_options'); ?>
	<style>
		<?php if($options['avatar']) { ?>
		.fcb_chat-box .content-chat .chat-content ul.start-chat li:last-child:after {
		    background: #e00 url(<?php echo $options['avatar']; ?>) center center no-repeat;
		    background-size: 100%;
		}
		<?php } if($options['color']) { ?>
		.fcb_chat-box .content-chat h3,
		.fcb_chat-box .content-chat .chat-content ul.cus-chat li p {
		    background: <?php echo $options['color']; ?>;
		}
		.fcb_chat-box .content-chat .chat-content ul.start-chat li .fa{
			color: <?php echo $options['color']; ?>;
		}
		<?php } ?>
	</style>
	<?php
		$start = array();
		$start_options = $options['start'];
		$start = explode('|', $start_options);
	?>
	<div class="fcb_chat-box">
		<div class="content-chat">
			<h3>
				<span class="name"><?php if($options['name']){ echo $options['name'];} else { echo 'Mai Anh'; } ?></span>
				<span class="icon">
					<a href="<?php if($options['contact']) { echo $options['contact']; } else { echo '#'; } ?>" class="phone" target="_blank"><i class="fa fa-phone"></i></a>
					<a class="chat-del" style="cursor: pointer;"><i class="fa fa-times"></i></a>
				</span>
				<div class="clear"></div>
			</h3>
			<div class="chat-content">
				<ul class="start-chat">
					<?php foreach ($start as $value) { ?>
						<?php if($value !='') { ?>
						<li class="user-chat"><p><?php echo $value; ?></p></li>
						<?php } ?>
					<?php } ?>
					<li class="user-chat"><i class="fa fa-heart"></i></li>
				</ul>
			</div>
			<form class="form-chat">
				<input type="text" class="form-control" id="content-txt" placeholder="<?php if($options['placeholder'] != '') { echo $options['placeholder']; } else { echo 'Trả lời tại đây...'; }?>" autocomplete="off" required="required">
			</form>
			<div class="bottom-icon">
				<i class="fa fa-picture-o"></i>
				<i class="fa fa-thumbs-up"></i>
				<i class="fa fa-thumbs-down"></i>
				<i class="fa fa-heart"></i>
			</div>
		</div>
	</div>
	<div class="tab-name" style="display: none">
		<?php if($options['name']){ echo $options['name'];} else { echo 'Mai Anh'; } ?>
	</div>
<?php } 
add_shortcode( 'funny_chat_bot', 'fcb_shortcode' );