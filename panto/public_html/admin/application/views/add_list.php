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
		<h1>Add/Edit a New Email List</h1>
		<?php echo validation_errors(); ?>
		<?php
			if(isset($list_id)) echo "<form action='http://www.addies-panto.co.uk/admin/email/edit_list/".$list_id."' method='POST'>";
			else echo "<form action='http://www.addies-panto.co.uk/admin/email/add_list' method='POST'>";
		?>

		<p>What is the name of this new list?</p>
		<input type="text" id="list_name" name="list_name" value="<?php if(isset($list_name)) echo $list_name; ?>" style="width:80%;" />

		<hr />

		<p>Which email addresses are in this list?</p>
		<textarea name='emails' id='emails' style='width:100%;height:200px;' placeholder="Type in a list of email addresses, separated by commas."><?php if(isset($emails)) echo $emails; ?></textarea>

		<input type='submit' name='submit' value='Save List' />

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