<?php
require_once "assets/Mobile_Detect.php";
$detect = new Mobile_Detect;
?>

<!DOCTYPE HTML>
<head>
	<title>Addenbrooke's Pantomime: Wizard of Obs</title>
	<style>
		div.error {
			display: block;
			background-color: #FF0000;
			border-radius: 5px;
			padding: 10px;
			text-align: center;
			margin-bottom: 5px;
		}
	</style>
	<script src="http://www.addies-panto.co.uk/admin/assets/ckeditor/ckeditor.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>

<body>
	<div style="max-width:960px; margin-left:auto; margin-right:auto; display:block;">
		<?php echo validation_errors(); ?>
		<form action='http://www.addies-panto.co.uk/admin/email/preview' method='POST'>

		<h2>Step one</h2>
		<p>From who?<p>
			<select name='from'>
				<option value='<?php echo $_SERVER['REMOTE_USER'] ?>@cam.ac.uk' <?php echo set_select('from', $_SERVER['REMOTE_USER']."@cam.ac.uk") ?>><?php echo $_SERVER['REMOTE_USER'] ?>@cam.ac.uk</option>
				<?php
					switch($_SERVER['REMOTE_USER']) {
						case "sj402":
							echo "<option value='stagemanager@addies-panto.co.uk' ".set_select('from', 'stagemanager@addies-panto.co.uk').">stagemanager@addies-panto.co.uk</option>";
							break;

                        case "ylw23":
                        case "rs646":
						 	echo "<option value='producer@addies-panto.co.uk' ".set_select('from', 'producer@addies-panto.co.uk').">producer@addies-panto.co.uk</option>";
						 	break;
						case "tjh71":
						case "ajcb4":
							echo "<option value='director@addies-panto.co.uk' ".set_select('from', 'director@addies-panto.co.uk').">director@addies-panto.co.uk</option>";
						 	break;
						case "cem73":
							echo "<option value='musical-director@addies-panto.co.uk' ".set_select('from', 'musical-director@addies-panto.co.uk').">musical-director@addies-panto.co.uk</option>";
						 	break;
						case "":
						case "":
						case "":
						case "":
						case "":
							echo "<option value='choreographers@addies-panto.co.uk' ".set_select('from', 'choreographers@addies-panto.co.uk').">choreographers@addies-panto.co.uk</option>";
						 	break;
						case "slz23":
							echo "<option value='makeup@addies-panto.co.uk' ".set_select('from', 'makeup@addies-panto.co.uk').">makeup@addies-panto.co.uk</option>";
						 	break;
						case "kch30":
						case "c":
						case "":
							echo "<option value='props@addies-panto.co.uk' ".set_select('from', 'props@addies-panto.co.uk').">props@addies-panto.co.uk</option>";
						 	break;
						case "":
							echo "<option value='art@addies-panto.co.uk' ".set_select('from', 'art@addies-panto.co.uk').">art@addies-panto.co.uk</option>";
							break;
						case "":
							echo "<option value='social@addies-panto.co.uk' ".set_select('from', 'social@addies-panto.co.uk').">social@addies-panto.co.uk</option>";
							break;
					}
				?>
			</select>

		<hr />

		<h2>Step two</h2>
		<p>To who?</p>
		<p>(N.B. The producers are always copied in!)</p>
		<div style="width:50%;float:left;">
			<h3>People who signed up via the website:</h3>
			<input type="checkbox" id="acting" name="signup[acting]" value="1" <?php echo set_checkbox('signup[acting]', '1'); ?> /> - Acting<br />
		    <input type="checkbox" id="singing" name="signup[singing]" value="1" <?php echo set_checkbox('signup[singing]', '1'); ?> /> - Singing<br />
		    <input type="checkbox" id="dancing" name="signup[dancing]" value="1" <?php echo set_checkbox('signup[dancing]', '1'); ?> /> - Dance Troupe<br />
		    <input type="checkbox" id="orchestra" name="signup[orchestra]" value="1" <?php echo set_checkbox('signup[orchestra]', '1'); ?> /> - Orchestra<br />
		    <input type="checkbox" id="chorus" name="signup[chorus]" value="1" <?php echo set_checkbox('signup[chorus]', '1'); ?> /> - Chorus<br />
		    <input type="checkbox" id="tech" name="signup[tech]" value="1" <?php echo set_checkbox('signup[tech]', '1'); ?> /> - Backstage and Technology<br />
		    <input type="checkbox" id="makeup" name="signup[makeup]" value="1"<?php echo set_checkbox('signup[makeup]', '1'); ?> /> - Make-up, Costume and Props<br /><br />
		    <input type="checkbox" id="other_checkbox" name="other_checkbox" value="1" <?php echo set_checkbox('other_checkbox', '1'); ?>/> - Other:<br />
		    <textarea name='other_textarea' id='other_textarea' style='width:100%;height:200px;' placeholder="Type in a list of email addresses, separated by commas."><?php echo set_value('other_textarea'); ?></textarea>
		</div>

		<div style="width:50%;float:left;">
			<h3>Custom lists:</h3>
			<?php
			if($email_lists) {
				foreach ($email_lists as $key => $list) {
					echo '<input type="checkbox" id="custom_'.$list['list_id'].'" name="custom['.$list['list_id'].']" value="1" '.set_checkbox("custom['".$list['list_id']."']", '1').' /> - '.$list['list_name'].' (<a href="http://www.addies-panto.co.uk/admin/email/edit_list/'.$list['list_id'].'">Edit this list</a>)<br />';
				}
			}
			?>
			<br /><br />
			<p><a href="http://www.addies-panto.co.uk/admin/email/add_list/">Add a new custom list</a></p>
		</div>

		<div style="clear:both;"></div>

		<hr />

		<h2>Step three</h2>
		<p>Email subject?</p>
		<input type="text" id="email_subject" name="email_subject" value="<?php echo set_value('email_subject'); ?>" style="width:80%;" />

		<hr />

		<h2>Step four</h2>
		<p>Attachments</p>
		<input type="checkbox" id="attach_file" name="attach_file" value="1" <?php echo set_checkbox('attach_file', '1'); ?>/> - Tick here if you want to attach files to this email<br />

		<hr />

		<h2>Step five</h2>
		<p>Email contents?</p>
		<textarea name='body' id='body' style='height:600px;width:80%'><?php echo set_value('body'); ?></textarea><br />

		<input type='submit' name='submit' value='Preview' style='display:block;margin-left:auto;margin-right:auto;width:100px;height:30px;' />

		</form>

	</div>
	<script>
    <?php
    	if(!$detect->isMobile()) {
		    echo "CKEDITOR.replace( 'body' );";
	    }
	?>
    </script>
</body>
</html>
