<?php 
//session_name('CyCalLogin');

//session_start(); 
?>

<div class="tb" id="topContainer">
	<div class="chromestyle" id="chromemenu">
		<div class="tb" id="topLogo"></div>
		<ul>
			<li><a href="help.php">Help</a></li>
			<li><a href="#" rel="dropmenu1">Hello, <?php echo $_SESSION['usr']; ?></a></li>
		</ul>
	</div>
</div>

<!--1st drop down menu -->                                                   
<span id="dropmenu1" class="dropmenudiv">
	<a href="#">Add ISU Feed</a>
	<a href="#">Add Other Feed</a>
	<a href="#">Account Settings</a>
	<a href="#">Log Out</a>
</span>

<script type="text/javascript">

	cssdropdown.startchrome("chromemenu")

</script>