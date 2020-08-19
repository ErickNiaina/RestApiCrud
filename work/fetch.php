<?php 

	$api_url = "http://openflex.dependancei/mysqli_api/?actionName=selectPost";


	$client = curl_init($api_url);


	curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($client);


	$result = json_decode($response);

	

	$output = "";

	if(count($result) > 0){
		 foreach ($result->postData as $row) {var_dump($result->postData);die;
			// "<tr>
			// 	<td>".$row->post_title."</td>
			// 	<td>".$row->post_desc."</td>
			// 	<td><button type='button' name='edit' class='btn btn-warning btn-xs edit' id='".$row->post_id"'>Edit</button></td>
			// 	<td><button type='button' name='delete' class='btn btn-danger btn-xs delete' id='".$row->post_id"'>Delete</button></td>
			// </tr>
			// ";
		 }
	}else{
		$output .= "
		<tr>
			<td colspan='4' align='center'>No Data Found</td>
		</tr>
		";
	}

	echo $output;


 ?>