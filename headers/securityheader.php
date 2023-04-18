<?php 
	if (!isset($_SESSION['id'])) {
		echo '<script type="text/javascript">',
		'document.getElementById("main").innerHTML = "You do not have permission to view this page. You may need to refresh or login again.";',
		'</script>';
	}
	else if($_SESSION['id'] != session_id()) {
		echo '<script type="text/javascript">',
		'document.getElementById("main").innerHTML = "You do not have permission to view this page. You may need to refresh or login again.";',
		'</script>';
	}
?>