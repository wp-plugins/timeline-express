<?php
	// getting our variables to pass into
	// our donation link
	$current_user_object = wp_get_current_user();
	$current_user_name = $current_user_object->user_firstname;
	$current_user_name .= ' ' . $current_user_object->user_lastname;
?>
<script type="text/javascript">
jQuery(document).ready(function ($) {

	// ajax save the WordPress Plugin Options Page
	// Form Options Page
    $('#timeline-express-form').submit(function (e) {	        
		tinyMCE.triggerSave();
            $('#timeline-express-status').slideUp('fast');
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'timeline_express_settings_form',
						form_action: 'update_options',
						form_data: $('#timeline-express-form').serialize()
					},
					dataType: 'json',
					success: function (RESPONSE) {
						if (RESPONSE == '1') {	
							$('#timeline-express-status').html('<div class=updated><p><?php _e('The options were saved successfully!', 'plugin-boilerplate'); ?></p></div>');
							$('#timeline-express-status').slideDown('fast');
						} else {
							$('#timeline-express-status').html("<div class=error><p><?php _e("The options could not be saved (or you did not change them).", "plugin-boilerplate"); ?></p></div>");
							$('#timeline-express-status').slideDown('fast');
							console.log(RESPONSE);
						}
					},
					error : function(RESPONSE) {
						console.log(RESPONSE.responseText);
					}
				});
       e.preventDefault();
    });
		
	
	// Reset Plugin Ajax Request
	$('#timeline-express-reset-plugin-settings').click(function(e) {
		$("<div id='timeline_express_reset_plugin_settings'><div class='dashicons dashicons-dismiss'></div><p><?php _e("Are you sure you want to revert 'Timeline Express' settings? This cannot be undone.", "plugin-boilerplate" ); ?></p></div>").dialog({
		 title : "Revert Settings?",
		 buttons : {
			"Yes" : function() {
				 $.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'timeline_express_settings_form',
						form_action: 'timeline_express_reset_plugin_settings'
					},
					dataType: 'json',
					success: function () {
						$( "#timeline_express_reset_plugin_settings" ).html('<p><?php _e("Timeline Express settings have successfully been reset", "plugin-boilerplate" ); ?></p><span class="timeline-express-reset-plugin-settings-preloader-container"><img class="timeline-express-reset-plugin-settings-preloader" src="<?php echo plugin_dir_url(__FILE__).'../images/preloader.gif'; ?>" alt="preloader" /></span>');
						$( "#timeline_express_reset_plugin_settings" ).next().hide();
						$( "#timeline_express_reset_plugin_settings" ).prev().text("Success!");
						setTimeout(function() {	
							location.reload();
						}, 2000);
					},
					error: function() {
						alert('Error resetting plugin settings. If the error persists, uninstall and reinstall the plugin to reset your options.');
					}
				});
			},
			"Cancel" : function() {
			  $(this).dialog("close");
			}
		  },
		  modal: true,
		  resizable: false
		});
		e.preventDefault();
	});
		
});


function changeRandomTrimLengthCheckbox() {
	var newOptinValue = jQuery('input[name="excerpt-random-length"]').prop('checked');
	if ( newOptinValue == '1' ) {	
		jQuery('input[name="excerpt-trim-length"]').fadeOut('fast',function() {
			jQuery('input[name="excerpt-random-length"]').css('margin-left','0em');
		});
		jQuery('#random-lenth-text-container').removeClass('random-length-text');
	} else {
		jQuery('input[name="excerpt-random-length"]').css('margin-left','.5em');
		jQuery('input[name="excerpt-trim-length"]').fadeIn('fast');
		jQuery('#random-lenth-text-container').addClass('random-length-text');
	}
}
// toggle delete post checkbox text
function toggleDeleteCheckClass() {
	var deletePostsCheckboxValue = jQuery('input[name="delete-announcement-posts-on-uninstallation"]').prop('checked');
	if ( deletePostsCheckboxValue == true ) {	
		jQuery('.delete-no').addClass('delete-yes');
		jQuery('.delete-yes').removeClass('delete-no');
	} else {
		jQuery('.delete-yes').addClass('delete-no');
		jQuery('.delete-no').removeClass('delete-yes');
	}
}

function toggle_delete_checkbox() {
	var deletePostsCheckboxValue = jQuery('input[name="delete-announcement-posts-on-uninstallation"]').prop('checked');
	if ( deletePostsCheckboxValue == false ) {	
		jQuery('.delete-no').addClass('delete-yes');
		jQuery('.delete-yes').removeClass('delete-no');
		jQuery('input[name="delete-announcement-posts-on-uninstallation"]').attr('checked',true);
	} else {
		jQuery('.delete-yes').addClass('delete-no');
		jQuery('.delete-no').removeClass('delete-yes');
		jQuery('input[name="delete-announcement-posts-on-uninstallation"]').attr('checked',false);
	}
}
</script>

<!-- get and store our api key option -->
<?php	
	// set up the options for our WYSIWYG editors
	// for the optin messages	
	$no_event_messages_parameters = array(
		'teeny' => true,
		'textarea_rows' => 15,
		'tabindex' => 1,
		'textarea_name' => 'no-events-message',
		'drag_drop_upload' => true
	);
	
	// used to dictate the active tab
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings';
?>
<div class="wrap">

<!-- evan herman logo on all settings pages -->
<div id="timeline_express_review_this_plugin_container">
	<a href="http://www.evan-herman.com/contact/?contact-name=<?php echo $current_user_name; ?>&contact-reason=I want to make a donation for all your hard work" target="_blank" title="Cosnider Making a Donation For Continued Support">
		<span class="timeline_express_need_support">
			<strong>
				<?php _e( 'Please Consider', 'plugin-boilerplate' ); ?> <br />
				<?php _e( 'Making a Donation', 'plugin-boilerplate' ); ?> <br />
				<div class="fa fa-paypal"></div>
			</strong>
		</span>
	</a>
	<a href="https://wordpress.org/support/plugin/timeline-express" target="_blank" title="Timeline Express Support">
		<span class="timeline_express_need_support">
			<strong>
				<?php _e( 'Need Help?', 'plugin-boilerplate' ); ?> <br />
				<?php _e( 'Get Support Now!', 'plugin-boilerplate' ); ?> <br />
				<div class="dashicons dashicons-plus-alt"></div>
			</strong>
		</span>
	</a>
	<a href="http://wordpress.org/support/view/plugin-reviews/timeline-express" target="_blank" title="Review Timeline Express">
		<span class="timeline_express_leave_us_a_review">
			<strong>
				<?php _e( 'Loving the plugin?', 'plugin-boilerplate' ); ?> <br />
				<?php _e( 'Leave us a nice review', 'plugin-boilerplate' ); ?> <br />
				<div class="dashicons dashicons-star-filled"></div><div class="dashicons dashicons-star-filled"></div><div class="dashicons dashicons-star-filled"></div><div class="dashicons dashicons-star-filled"></div><div class="dashicons dashicons-star-filled"></div>
			</strong>
		</span>
	</a>
	<a href="http://www.Evan-Herman.com" target="_blank" class="timeline_express_header_logo" style="margin-top:10px;">
		<img src="<?php echo TIMELINE_EXPRESS_URL . 'images/evan_herman_logo.png'; ?>" alt="Evan Herman" width=65 title="Evan Herman" />
	</a>
</div>

<!-- tabs -->
<h2 class="nav-tab-wrapper">
    <a href="?post_type=te_announcements&page=timeline-express-settings&tab=settings" class="nav-tab <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Timeline Express','plugin-boilerplate'); ?></a>
</h2>

	<h2 id="timeline-express-page-header">
		<div id="timeline-express-icon" class="icon32"></div><?php _e('Timeline Express Settings','plugin-boilerplate'); ?>
	</h2>
	
	<div class="timeline-express-status" id="timeline-express-status"></div>
	
<?php if ( $active_tab == 'settings' ) { ?>
	
	
	<form method="post" name="timeline-express-form" id="timeline-express-form">
		<table class="form-table timeline-express-form">
			<tbody>
				
				<!-- Timeline Express Title -->
				<tr valign="top">
					<th scope="row"><label for="timeline-title"><?php _e('Timeline Title','plugin-boilerplate'); ?></label></th>
					<td>
						<input name="timeline-title" type="text" id="timeline-title" value="<?php echo stripslashes( $this->timeline_express_optionVal['timeline-title'] ); ?>" class="regular-text" />
						<select name="timeline-title-alignment" id="timeline-title-alignment" class="regular-text" style="height:27px; margin-top:-3px;"  />
							<option value="left"<?php echo ($this->timeline_express_optionVal['timeline-title-alignment'] === 'left' ? ' selected' : ''); ?>><?php _e('Left','plugin-boilerplate'); ?></option>
							<option value="center"<?php echo ($this->timeline_express_optionVal['timeline-title-alignment'] === 'center' ? ' selected' : ''); ?>><?php _e('Center','plugin-boilerplate'); ?></option>
							<option value="right"<?php echo ($this->timeline_express_optionVal['timeline-title-alignment'] === 'right' ? ' selected' : ''); ?>><?php _e('Right','plugin-boilerplate'); ?></option>
						</select>
						<select name="timeline-title-size" id="timeline-title-size" class="regular-text" style="height:27px; margin-top:-3px;" />
							<option value="h1"<?php echo ($this->timeline_express_optionVal['timeline-title-size'] === 'h1' ? ' selected' : ''); ?>><?php _e('H1','plugin-boilerplate'); ?></option>
							<option value="h2"<?php echo ($this->timeline_express_optionVal['timeline-title-size'] === 'h2' ? ' selected' : ''); ?>><?php _e('H2','plugin-boilerplate'); ?></option>
							<option value="h3"<?php echo ($this->timeline_express_optionVal['timeline-title-size'] === 'h3' ? ' selected' : ''); ?>><?php _e('H3','plugin-boilerplate'); ?></option>
							<option value="h4"<?php echo ($this->timeline_express_optionVal['timeline-title-size'] === 'h4' ? ' selected' : ''); ?>><?php _e('H4','plugin-boilerplate'); ?></option>
						</select>
					</td>
				</tr>
				<!-- Timeline Express Title -->
				<tr>
					<td></td>
					<td class="timeline-express-settings-description">
						<?php _e('Enter the title for the time line // Select the alignment // Select the font size','plugin-boilerplate'); ?><br />
					</td>
				</tr>
				<!-- Preferred Form Layout (table or div) -->
				<tr valign="top">
					<th scope="row"><label for="announcement-time-frame"><?php _e('Time Frame','plugin-boilerplate'); ?></label></th>
					<td>
						<select name="announcement-time-frame" id="announcement-time-frame" class="regular-text" />
							<option value="0"<?php echo ($this->timeline_express_optionVal['announcement-time-frame'] === '0' ? ' selected' : ''); ?>><?php _e('Future Events','plugin-boilerplate'); ?></option>
							<option value="1"<?php echo ($this->timeline_express_optionVal['announcement-time-frame'] === '1' ? ' selected' : ''); ?>><?php _e('All Events (past+future)','plugin-boilerplate'); ?></option>
							<option value="2"<?php echo ($this->timeline_express_optionVal['announcement-time-frame'] === '2' ? ' selected' : ''); ?>><?php _e('Past Events','plugin-boilerplate'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Query Time Description -->
					<td class="timeline-express-settings-description">
						<?php _e('Select the time frame to query events from.','plugin-boilerplate'); ?>
					</td>
				</tr>	
				<!-- Excerpt Trim Length -->
				<tr valign="top">
					<th scope="row"><label for="excerpt-trim-length"><?php _e('Announcement Exceprt Length','plugin-boilerplate'); ?></label></th>
					<td>
						<input <?php if( $this->timeline_express_optionVal['excerpt-random-length'] == '1' ) { ?> style="display:none;" <?php } ?> type="number" name="excerpt-trim-length" min="25" max="200" value="<?php echo $this->timeline_express_optionVal['excerpt-trim-length']; ?>"><label for="excerpt-random-length"><input type="checkbox" id="excerpt-random-length" name="excerpt-random-length" onclick="changeRandomTrimLengthCheckbox();" value="1" <?php checked( $this->timeline_express_optionVal['excerpt-random-length'] , '1' ); ?> <?php if( $this->timeline_express_optionVal['excerpt-random-length'] == '0' ) { ?> style="margin-left:.5em;" <?php } ?>><span id="random-lenth-text-container"<?php if( $this->timeline_express_optionVal['excerpt-random-length'] == '0' ) { ?> class="random-length-text" <?php } ?>>random length</label></span>
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Excerpt Trim Length Description -->
					<td class="timeline-express-settings-description">
						<?php _e('set the length of the excerpt for each announcement. ( min=25;max=200 eg: 50 = 50 characters )','plugin-boilerplate'); ?>
					</td>
				</tr>
				<!-- Toggle Date Visibility -->
				<tr valign="top">
					<th scope="row"><label for="date-visibility"><?php _e('Date Visibility','plugin-boilerplate'); ?></label></th>
					<td>
						<select name="date-visibility" id="date-visibility" class="regular-text" />
							<option value="1"<?php echo ($this->timeline_express_optionVal['date-visibility'] === '1' ? ' selected' : ''); ?>><?php _e('Visible','plugin-boilerplate'); ?></option>
							<option value="0"<?php echo ($this->timeline_express_optionVal['date-visibility'] === '0' ? ' selected' : ''); ?>><?php _e('Hidden','plugin-boilerplate'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Toggle Date Visibility Description -->
					<td class="timeline-express-settings-description">
						<?php _e('toggle the visibility of the date next to the icon.','plugin-boilerplate'); ?>
					</td>
				</tr>	
				<!-- Toggle Read Visibility More -->
				<tr valign="top">
					<th scope="row"><label for="read-more-visibility"><?php _e('Read More Visibility','plugin-boilerplate'); ?></label></th>
					<td>
						<select name="read-more-visibility" id="read-more-visibility" class="regular-text" />
							<option value="1" <?php selected( $this->timeline_express_optionVal['read-more-visibility'] , '1' ); ?>><?php _e('Visible','plugin-boilerplate'); ?></option>
							<option value="0" <?php selected( $this->timeline_express_optionVal['read-more-visibility'] , '0' ); ?>><?php _e('Hidden','plugin-boilerplate'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Toggle Read More Visibility Description -->
					<td class="timeline-express-settings-description">
						<?php _e('toggle the visibility of the read more button. hide to prevent users from viewing the full announcement.','plugin-boilerplate'); ?>
					</td>
				</tr>
				<tr valign="top">
				<!-- Default Announcement Icon -->
					<th scope="row"><label for="default-announcement-icon"><?php _e('Default Icon','plugin-boilerplate'); ?></label></th>
					<td>
						<input name="default-announcement-icon" type="text" id="default-announcement-icon" value="<?php echo $this->timeline_express_optionVal['default-announcement-icon']; ?>" class="regular-text" />
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Default Announcement Icon Description -->
					<td class="timeline-express-settings-description">
						<?php _e('Enter the font-awesome class name that you would like to use a default icon for new events. ie: fa-clock-alt','plugin-boilerplate'); ?> <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank" style="font-size:12px;font-style:em;">cheat sheet</a>
					</td>
				</tr>
				<tr valign="top">
				<!-- Default Announcement Color -->
					<th scope="row"><label for="default-announcement-color"><?php _e('Default Announcement Color','plugin-boilerplate'); ?></label></th>
					<td>
						<input name="default-announcement-color" type="text" id="default-announcement-color" value="<?php echo $this->timeline_express_optionVal['default-announcement-color']; ?>" class="regular-text color-picker-field" />
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Default Announcement Color -->
					<td class="timeline-express-settings-description">
						<?php _e('Select the default color for all new events. Note : this setting can be overwritten','plugin-boilerplate'); ?>
					</td>
				</tr>
				<tr valign="top">
					<!-- Single Announcement Container Background -->
					<th scope="row"><label for="announcement-bg-color"><?php _e('Announcement Container Background','plugin-boilerplate'); ?></label></th>
					<td>
						<input type="text" name="announcement-bg-color" class="color-picker-field" value="<?php echo $this->timeline_express_optionVal['announcement-bg-color']; ?>" />
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Custom Interest Group Label Description -->
					<td class="timeline-express-settings-description">
						<?php _e('Select the background color of the announcement container.','plugin-boilerplate'); ?>
					</td>
				</tr>
				<tr valign="top">
					<!-- Single Announcement Box Shadow Color -->
					<th scope="row"><label for="announcement-box-shadow-color"><?php _e('Announcement Shadow Color','plugin-boilerplate'); ?></label></th>
					<td>
						<input type="text" name="announcement-box-shadow-color" class="color-picker-field" value="<?php echo $this->timeline_express_optionVal['announcement-box-shadow-color']; ?>" />
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Custom Interest Group Label Description -->
					<td class="timeline-express-settings-description">
						<?php _e('Select the shadow color for the announcement container.','plugin-boilerplate'); ?>
					</td>
				</tr>
				<tr valign="top">
					<!-- Background Line Color -->
					<th scope="row"><label for="announcement-background-line-color"><?php _e('Background Line Color','plugin-boilerplate'); ?></label></th>
					<td>
						<input type="text" name="announcement-background-line-color" class="color-picker-field" value="<?php echo $this->timeline_express_optionVal['announcement-background-line-color']; ?>" />
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Background Line Color Description -->
					<td class="timeline-express-settings-description">
						<?php _e('Select the color of the line in the background of the timeline.','plugin-boilerplate'); ?>
					</td>
				</tr>
				<tr valign="top">
					<!-- No Events Message -->
					<th scope="row"><label for="no-events-message"><?php _e('No Events Message','plugin-boilerplate'); ?></label></th>
					<td>
						<?php wp_editor( stripslashes( $this->timeline_express_optionVal['no-events-message'] ) , 'no-events-message', $no_event_messages_parameters); ?>				
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- No Events Message Description -->
					<td class="timeline-express-settings-description">
						<em><?php _e('This is the message that will display when no announcements are found.','plugin-boilerplate'); ?></em>
					</td>
				</tr>
				<tr valign="top">
					<!-- Background Line Color -->
					<th scope="row"><label for="delete-announcement-posts-on-uninstallation"><?php _e('Delete Announcements On Uninstall?','plugin-boilerplate'); ?></label></th>
					<td>
						<input type="checkbox" name="delete-announcement-posts-on-uninstallation" onclick="toggleDeleteCheckClass();" <?php checked( $this->timeline_express_optionVal['delete-announcement-posts-on-uninstallation'] , '1' ); ?> value="1" /><span class="<?php if( $this->timeline_express_optionVal['delete-announcement-posts-on-uninstallation'] == '0' ) { ?> delete-no <?php } else { ?> delete-yes <?php } ?>" onclick="toggle_delete_checkbox();"></span>
					</td>
				</tr>
				<tr>
					<td></td>
					<!-- Background Line Color Description -->
					<td class="timeline-express-settings-description">
						<?php _e('select this to delete all announcement posts from the data base on plugin uninstallation. this can not be undone, once they are deleted they are gone forever. If you want to keep them, export your announcements before uninstalling.','plugin-boilerplate'); ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e( 'Save Settings' , 'plugin-boilerplate' ); ?>"><input type="submit" name="timeline-express-reset-plugin-settings" id="timeline-express-reset-plugin-settings" class="button timeline-express-red-button" value="<?php _e( 'Reset Plugin Settings' , 'plugin-boilerplate' ); ?>"></td>
				</tr>	
			
			</tbody>
		</table>
	</form>

	<?php } ?>
	
</div>
<!-- end Timeline Express settings page -->