<?php
function add_new_constant_contact_item_to_contact_list($email, $fname='', $lname=''){

	$apiKey = "";
	$token = "";
	$listId = "";
	$url = "https://api.constantcontact.com/v2/contacts?email=$email&status=ALL&limit=50&api_key=$apiKey";

	$header[] = "Authorization: Bearer $token";
	$header[] = 'Content-Type: application/json';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = json_decode(curl_exec($ch));
	curl_close($ch);
	//if(curl_error($ch)) echo 'error:' . curl_error($ch);

	if(!$response->results){
		$url = "https://api.constantcontact.com/v2/contacts?action_by=ACTION_BY_VISITOR&api_key=$apiKey";
		$body = '{
		"lists": [
				{
					"id": "'.$listId.'"
				}
			],
			"confirmed": false,
			"email_addresses": [
				{
					"email_address": "'.$email.'"
				}
			],
			"first_name": "'.$fname.'",
			"last_name": "'.$lname.'"
		}';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		//if(curl_error($ch)) echo 'error:' . curl_error($ch);
		//var_dump($response);
	}

}
?>
