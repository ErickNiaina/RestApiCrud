<?php 

	$test = include "mysqli_connect.php";


	header('content-type:application/json');
	 
	$actionName = $_POST["actionName"];
	$actionNam = $_GET['actionName'];

	 //select post api
	if($actionNam == "selectPost"){

		$seachKey = isset($_POST["seachKey"]) ? $_POST["seachKey"] : '';
	 
		if(!empty($seachKey))
			$query = "SELECT * FROM li_ajax_post_load where post_title like '%$seachKey%' ORDER BY post_id DESC";
		else
			$query = "SELECT * FROM li_ajax_post_load ORDER BY post_id DESC";

		$result = mysqli_query($con, $query);
	 
		$rowCount = mysqli_num_rows($result);
	 
		if($rowCount > 0){
			$postData = array();
		    while($row = mysqli_fetch_assoc($result)){
		    	$postData[] = $row;
		    }
		    $resultData = array('status' => true, 'postData' => $postData);
	    }else{
	    	$resultData = array('status' => false, 'message' => 'No Post(s) Found...');
	    }
	 
	    echo json_encode($resultData);
	}



//insert post api
	if($actionName == "insertPost"){
	 	//$postId = isset($_POST["postId"]) ? $_POST["postId"] : '';
		$postName = isset($_POST["postName"]) ? $_POST["postName"] : '';
		$postDesc = isset($_POST["postDesc"]) ? $_POST["postDesc"] : '';
		
		
	 
		if(!empty($postName) && !empty($postDesc)){
			$query = "INSERT INTO li_ajax_post_load(post_id,post_title, post_desc, status) VALUES(3,'$postName', '$postDesc', 0)";
			$result = mysqli_query($con, $query);
			if($result){
			    $resultData = array('status' => true, 'message' => 'New Post Inserted Successfully...');
		    }else{
		    	$resultData = array('status' => false, 'message' => 'Can\'t able to insert new post...');
		    }
		}
		else{
	    	$resultData = array('status' => false, 'message' => 'Please enter post details...');
	    }
	 
	    echo json_encode($resultData);
	}



	//update post api 
	if($actionName == "updatePost"){
	 
		$postId   = isset($_POST["postId"]) ? $_POST["postId"] : '';
		$postName = isset($_POST["postName"]) ? $_POST["postName"] : '';
		$postDesc = isset($_POST["postDesc"]) ? $_POST["postDesc"] : '';
		
		
	 
		if(!empty($postId) && !empty($postName) && !empty($postDesc)){
			$query = "UPDATE li_ajax_post_load SET post_title='$postName', post_desc='$postDesc' WHERE post_id=$postId";
			$result = mysqli_query($con, $query);
			if($result){
			    $resultData = array('status' => true, 'message' => 'Post Updated Successfully...');
		    }else{
		    	$resultData = array('status' => false, 'message' => 'Can\'t able to update a post details...');
		    }
		}
		else{
	    	$resultData = array('status' => false, 'message' => 'Please enter post details...');
	    }
	 
	    echo json_encode($resultData);
	}



	//delete post api
	if($actionName == "deletePost"){
	 
		$postId   = isset($_POST["postId"]) ? $_POST["postId"] : '';
		
		
	 
		if(!empty($postId)){
			$query = "DELETE FROM li_ajax_post_load WHERE post_id=$postId";
			$result = mysqli_query($con, $query);
			if($result){
			    $resultData = array('status' => true, 'message' => 'Post Deleted Successfully...');
		    }else{
		    	$resultData = array('status' => false, 'message' => 'Can\'t able to delete a post details...');
		    }
		}
		else{
	    	$resultData = array('status' => false, 'message' => 'Please enter post details...');
	    }
	 
	    echo json_encode($resultData);
	}
	 



 ?>