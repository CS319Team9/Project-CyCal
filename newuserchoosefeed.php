<?php
$TO_ROOT = "";
require "includes/membersOnly.php";

if (!$_GET['new'])
{
	$userid = mysql_real_escape_string($_SESSION['id']);
	$getRSS = mysql_query("SELECT * FROM panel WHERE userid='$userid'");
	$num_rows = mysql_num_rows($getRSS);
	if($num_rows != 0) {
		header("Location: canvas.php");
		exit;
	}
}

if (isset($_POST['chooseFeeds'])) {
	$arr = array();
    if (isset($_POST['featuredEvents'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?featured=1";
	}
    if (isset($_POST['academicCalendar'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=14";
	}	
    if (isset($_POST['arts'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=3";
	}
    if (isset($_POST['athletics'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=8";
	}
    if (isset($_POST['conferences'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=2";
	}
    if (isset($_POST['diversity'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=7";
	}
	
    if (isset($_POST['lectures'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=4";
	}
    if (isset($_POST['liveGreen'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=18";
	}
    if (isset($_POST['meetings'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=15";
	}
    if (isset($_POST['specialEvents'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=16";
	}
    if (isset($_POST['studentActivites'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=9";
	}
    if (isset($_POST['training'])) {
    	$arr[] = "http://www.event.iastate.edu/rssgen.php?category=17";
	}
	//for ($i = 0; $i < 12; $i++) {
	// Now delete every item, but leave the array itself intact:
		foreach ($arr as $i => $value) {
		//if($arr[$i] != 12 && $arr[$i] != NULL) {
			echo $arr[$i] . ", ";
		//}
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >

<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
<link href="js/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<style type="text/css">
	#Check_Container {
		width:100%;
	}
	#Check_List {
		float:left;
		text-align:left;
		width:50%;
		/*height:100px;*/
		width:450px;
	}

	#welcome {
		width:43%;
		margin-left:auto;
		margin-right:auto;
	}
</style>

	<?php
		//Must be included inside the Header (at bottom)
		include 'includes/topbar_header.php';
	?>
<script type="text/javascript">
var feeds = new Array();

function submitAjax() {
	feeds.length = 0;
	for (var i = 0; i < document.forms[0].elements.length; i++ ) {
		if (document.forms[0].elements[i].type == 'checkbox') {
			if (document.forms[0].elements[i].checked == true) {
				feeds.push(document.forms[0].elements[i].value);
			}
		}
	}
	var myJsonString = JSON.stringify(feeds);
	$.ajax({
		type: 'POST',	
		url: "./util/postdata.php",
		statusCode: {
			404: function() {
				alert('Page not found');
			},
			409: function(jqXHR, textStatus, errorThrown) {
				alert('Error: ' + errorThrown);
			},
			200: function(data, textStatus, jqXHR) {
				window.location = './canvas.php';
				//alert('200 - ' + data);
			}
		},
		data: {
			//key1: "value1",
			action : 'add',
			rss : myJsonString
		},
		complete: function(jqXHR, textStatus) {
		}
	});
}
</script>
</head>
<body>
	<?php
		//Must be included at the top of the <body> tag
		include 'includes/topbar.php';
	?>
	<div id="welcome">
 	<h1><strong> Welcome, <?php echo $_SESSION['usr']; ?></strong></h1>

 	<br> 
 	<p>Here are some popular Iowa State University RSS feeds you can choose to start viewing right away.</p>
	</div>
 	
  		<div id="Container_Normal">
 	<form id="newuser" method="" action="" style="width:500px">
 				<table>
 				<?php
 					$arrA = array('featuredEvents', 'academicCalendar', 'arts', 'athletics', 'conferences', 'diversity', 
 					'lectures', 'liveGreen', 'meetings', 'specialEvents', 'studentActivites', 'training');
 					$arrB = array('Featured Events', 'Academic Calendar', 'Arts, performances', 'Athletics', 'Conferences', 'Diversity', 
 					'Lectures', 'Live Green', 'Meetings, receptions', 'Special Events', 'Student activites', 'Training, development');
					$arrUrl = array('http://www.event.iastate.edu/rssgen.php?featured=1', 'http://www.event.iastate.edu/rssgen.php?category=14', 'http://www.event.iastate.edu/rssgen.php?category=3', 'http://www.event.iastate.edu/rssgen.php?category=8', 'http://www.event.iastate.edu/rssgen.php?category=2', 'http://www.event.iastate.edu/rssgen.php?category=7', 'http://www.event.iastate.edu/rssgen.php?category=4', 'http://www.event.iastate.edu/rssgen.php?category=18', 'http://www.event.iastate.edu/rssgen.php?category=15', 'http://www.event.iastate.edu/rssgen.php?category=16', 'http://www.event.iastate.edu/rssgen.php?category=9', 'http://www.event.iastate.edu/rssgen.php?category=17');

	$userid = mysql_real_escape_string($_SESSION['id']);
	$getRSS = mysql_query("SELECT * FROM panel WHERE userid='$userid'");
	$num_rows = mysql_num_rows($getRSS);

	$taken = array();
	$takenIndexes = array();
	while ($chosen = mysql_fetch_assoc($getRSS)) {
		$taken[] = urldecode($chosen['rss']);
	}
		//spit our each
		foreach ($taken as $i => $value) {
				for($j = 0; $j < 12; $j++) {
					if(strcmp($taken[$i], $arrUrl[$j]) == 0) {
						$takenIndexes[] = $j;
					}
				}
		}

					for ($i = 0; $i < 6; $i++) {
						echo '<tr>';
 					   	echo '<td>';

						$match = false;
						//check against each value
						foreach ($takenIndexes as $k => $value) {
							if($i == $takenIndexes[$k]) {
								$match = true;
							}
						}
						//If we have a match - disable
						if($match == true) {
							echo '<input type="checkbox" disabled="disabled" class="checkbox" name="' . $arrA[$i] . '" value="' . $arrUrl[$i] . '" />';
						} 
						//Otherwise - print normal for people to select
						else {
							echo '<input type="checkbox"  class="checkbox" name="' . $arrA[$i] . '" value="' . $arrUrl[$i] . '" />';
						}

 					   	echo $arrB[$i];
 					   	echo '</td>';
 					   	echo '<td>';
						$match = false;
						//check against each value
						foreach ($takenIndexes as $k => $value) {
							if(($i+6) == $takenIndexes[$k]) {
								$match = 'true';
							}
						}
						//If we have a match - disable
						if($match == true) {
							echo '<input type="checkbox" disabled="disabled" class="checkbox" name="' . $arrA[$i+6] . '" value="' . $arrUrl[$i + 6] . '" />';
						} 
						//Otherwise - print normal for people to select
						else {
 					   		echo '<input type="checkbox" class="checkbox" name="' . $arrA[$i+6] . '" value="' . $arrUrl[$i + 6] . '" />';
						}
 					   	echo $arrB[$i+6];
 					   	echo '</td>'; 					   	
 					   	echo '</tr>';
					}
				?>
				</table>
 			<br style="clear:left;">
 		<input type="button" name="chooseFeeds" onclick="submitAjax()" value = "Submit">
	</form>
<!--	
 	<form method="post" action="">
 		<div id="Check_Container">
 			<div id="Check_List">
 				 	<input type="checkbox" name="featuredEvents" value="" /> Featured Events	
 				 	<br>
 					<input type="checkbox" name="academicCalendar" value="" /> Academic Calendar 
 					<br>
 					<input type="checkbox" name="arts" value="" /> Arts, performances 
 					<br>
 					<input type="checkbox" name="athletics" value="" /> Athletics 
 					<br>
 					<input type="checkbox" name="conferences" value="" /> Conferences 
 					<br>
 					<input type="checkbox" name="diversity" value="" /> Diversity
 			</div>
 			<div id="Check_List">
 				 	<input type="checkbox" name="lectures" value="" /> Lectures		
 				 	<br>
 					<input type="checkbox" name="liveGreen" value="" /> Live Green 
 				 	<br>
 					<input type="checkbox" name="meetings" value="" /> Meetings, receptions		
 				 	<br>
 					<input type="checkbox" name="specialEvents" value="" /> Special Events 
 				 	<br>
 					<input type="checkbox" name="studentActivites" value="" /> Student activites 
 				 	<br>
 					<input type="checkbox" name="training" value="" /> Training, development 
 			</div>
 			<br style="clear:left;">
 		</div>
 		<input type="submit" name="chooseFeeds" value = "Submit"/>
	</form>
-->
</div>
</body>
</html>
 
 
 
 
