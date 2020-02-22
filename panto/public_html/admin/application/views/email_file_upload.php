<?php
require_once "assets/Mobile_Detect.php";
$detect = new Mobile_Detect;
?>

<!DOCTYPE HTML>
<head>
	<title>Addenbrooke's Pantomime: Peter Pancreas</title>
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
		<?php echo validation_errors(); echo $error; ?>
		<?php echo form_open_multipart('email/email_preview/'.$draft_id.'/1');?>

		<h2>Attach files to your email</h2>
		<p>Select which files you would like to attach here:</p><br />

		<input type="file" name="email_attach[]" multiple />
		<input type='hidden' name='draft_id' value='<?php echo $draft_id; ?>' />

		<br /><br />

		<input type="submit" name="file_upload_submit" value="Upload" style='display:block;margin-left:auto;margin-right:auto;width:100px;height:30px;' />

		</form>

	</div>
</body>
</html>
