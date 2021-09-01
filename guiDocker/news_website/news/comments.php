<?php include('config.php'); ?>
<?php include('dbconfig.php'); ?>
<?php 
	  if (isset($_GET['newsid'])){
		$id=$_GET['newsid'];
	  }


	if (isset($_POST["id"])) {
		
		global $conn;
		// grab the comment that was submitted through Ajax call
		$comment_text = $_POST['comment_text'];
		$comment_name = $_POST['comment_name'];
		$id=$_POST['id'];

		$time = date('Y-d-m H:i:s');	
		// insert comment into database
		$sql="INSERT INTO $comments_table (cid,name,ccontent,cDate,nid) VALUES ('0','$comment_name','$comment_text','$time','$id')";

		$result = $conn->multi_query($sql);

		// Query same comment from database to send back to be displayed
		$inserted_id = $conn->insert_id;
		$sql = "SELECT name,ccontent, cDate FROM $comments_table WHERE cid=$inserted_id ";
		$inserted_comment = $conn->query($sql);
		$inserted_comment = $inserted_comment->fetch_array();
		
		// if insert was successful, get that same comment from the database and return it
		if ($result) {
			$date = $inserted_comment['cDate'];
			$name   =  $inserted_comment['name'] ;
			$content= $inserted_comment['ccontent'];
			$comment_info = array(
				'date' => $date,
				'name' => $name,
				'content' => $content,
	
			);
			echo json_encode($comment_info);
			exit();
		} else {
		
			exit();
		}
	}
	