<!DOCTYPE HTML>
<head>
	<title>Addenbrooke's Pantomime: Wizard of Obs</title>
	<style>
		div.error {
			display: block;
			background-color: #FF0000;
			border-radius: 5px;
		}
	</style>
</head>

<body>
	<div style="max-width:960px; margin-left:auto; margin-right:auto; display:block;">
		<?php echo validation_errors(); ?>
		<form action='http://www.addies-panto.co.uk/admin/email/send' method='POST'>

		From: <input type="text" id="from" name="from" value="<?php echo $from; ?>" style="width:80%;" readonly='readonly' /><br />
		To: <input type="text" id="to" name="to" value="<?php echo $to; ?>" style="width:80%;" readonly='readonly' /><br />
		Bcc: <textarea readonly='readonly' name='bcc' style='height:300px;width:80%'><?php echo $bcc; ?></textarea><br />
		Subject: <input type="text" id="subject" name="subject" value="<?php echo $subject; ?>" style="width:80%;" readonly='readonly' /><br />
		<?php
		if($attachments!="") {
			echo "Attachment(s):<br />";
			foreach (explode("%$%sep$%$", $attachments) as $value) {
				echo "<span style='font-style:italic;'>".str_replace("/societies/panto/public_html/admin/assets/attachments/", "", $value)."</span><br />";
			}
			echo "<br />";
		}
		?>
		Content:<br />
		<iframe style="width:100%; height: 500px;" src="http://www.addies-panto.co.uk/admin/email/template/<?php echo $draft_id; ?>"></iframe><br />
		
		<input type='hidden' name='draft_id' value='<?php echo $draft_id; ?>' />
		<input type='submit' name='submit' value='Send' style='display:block;margin-left:auto;margin-right:auto;width:100px;height:30px;' />

		</form>

	</div>
</body>
</html>
