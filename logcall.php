<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Police Emergency Service System</title>
</head>

<body>
	<style>
		body {background-color: grey;
		background-image: url('bg.png');}
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

input + span {
  padding-right: 30px;
}

input:invalid+span:after {
  position: absolute; content: '✖';
  padding-left: 5px;
  color: red;
}

input:valid+span:after {
  position: absolute;
  content: '✓';
  padding-left: 5px;
  color: greenyellow;
}
</style>
<script>
	function hope()
	{
	var x=document.forms["frmLogCall"]
	["callerName"].value;
	if (x==null || x=="")
	{
	alert("Caller Name is required.");
	return false;
	}
</script>
	<?php require_once 'nav.php';
	?>
	<?php require_once 'db.php';
	
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM incidenttype";
	
	$result = $conn-> query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result-> fetch_assoc()) {
			$incidentType[$row['incidentTypeId']] =
				$row['incidentTypeDesc'];
		}
	}
	$conn->close();
	?>
	<fieldset>
	<legend style="color: #FFFFFF; font-size: 18px;">Log Call</legend>
	<form name="frmLogCall" method="post" action="dispatch.php" onSubmit="return hope();">
		<table  width="45%" border="2" align="center" cellpadding="5" cellspacing="5">
		<tr>
			<td width="20%" align="center" style="color: #FFFFFF; font-size: 18px;">Name of Caller:</td>
		<td width="50%"><input type="text" name="callerName" id="callerName" pattern="[a-zA-Z][a-zA-Z\s]*" required>
			<span class="validity"></span>
		<br>
			<small style="color: #FFFFFF">*Letters required</small>
		</td>
		</tr>
		<tr>
			<td width="20" align="center" style="color: #FFFFFF; font-size: 18px;">Contact Number:</td>
		  <td width="50"><input type="tel" name="contactNo" id="contactNo" pattern="[6,8,9]{1}[0-9]{7}" maxlength="8" required> 
			<span class="validity"></span>
		<br>
			 <small style="color: #FFFFFF">*Numbers must start with 6/8/9</small>
		</td>
		</tr>
		<tr >
			<td width="50%" align="center" style="color: #FFFFFF; font-size: 18px;">Location:
		</td>
			<td width="50%"><input type="text" name="location" id="location" pattern="[a-zA-Z0-9\s]*" required>
				<span class="validity"></span>
		<br>
			<small style="color: #FFFFFF"> *Location required</small>
			</td>
		</tr>
		<tr>
			<td width="50%" align="center" style="color: #FFFFFF; font-size: 18px;">Incident Type:
		</td>
			<td width="50%"><select name="incidentType" id="incidenType">
			
			<?php foreach($incidentType as $key=> $value) {?>
			<option value="<?php echo $key ?> " >
			<?php echo $value ?>
		</option>
			<?php } ?>
		</select>
		</td>
		</tr>
		<tr>
		<td width="50%"
			align="center" style="color: #FFFFFF; font-size: 18px;">Description:
		</td>
		<td width="50%">
		<textarea name="incidentDesc" id="incidentDesc" cols="45" rows="5"></textarea>
		</td>
		</tr>
		<tr>
		<table width="40%" border="0" align="center" cellpadding="5" cellspacing="5">
		<td align="center"><input type="reset" name="cencelProcess" id="cancelProcess" value="Reset"
		</td>
		<td align="center">
		<input type='submit' name="btnProcessCall" id="btnProcessCall" value="Process Call"
		</td>
		</tr>
		</table>
		</table>
		</form>
		</fieldset>
		</body>
		</html>