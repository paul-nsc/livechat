<?php
    echo "<pre>"; // REMOVE WHEN WORKING!
    echo "New Offline Message<br />";
    echo $someObject->visitor->fullName . "<br />";
    echo $someObject->visitor->emailAddress . "<br />";
    echo $someObject->visitor->id . "<br />";
        require('api.php');
        
        $custom_fields = array("cf_olark_id" => $someObject->id );

        // $getGroup_ID = getGroupID($someObject->groups[0]->name);
        $getGroup_ID = getGroupByID($someObject->groups[0]->id);
        $getOffline_Msg = getOfflineMsg($someObject->items[0]->body);


        $ticket_data = json_encode(array(
          //"description" => $getOffline_Msg,
          "subject" => "NorthShore Care Supply: New Offline Message (from ".$someObject->visitor->fullName.")",
          "email" => $someObject->visitor->emailAddress,
          "group_id" => $getGroup_ID,
          "priority" => 1,
          "status" => 2,
          "source" => 7,
          "type" => "Question",
          "tags" => array("offline-message", "olark"),
          "cc_emails" => array("paul@northshorecare.com", "paul.leech.webdev@gmail.com"),
          "custom_fields" => $custom_fields
        ));

        $url = "https://$yourdomain.freshdesk.com/api/v2/tickets";

        $ch = curl_init($url);

        $header[] = "Content-type: application/json";
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$password");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $ticket_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        $info = curl_getinfo($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($server_output, 0, $header_size);
        $response = substr($server_output, $header_size);

        if($info['http_code'] == 201) {
          echo "Ticket created successfully, the response is given below \n";
          echo "Response Headers are \n";
          echo $headers."\n";
          echo "Response Body \n";
          echo "$response \n";
        } else {
          if($info['http_code'] == 404) {
            echo "Error, Please check the end point \n";
          } else {
            echo "Error, HTTP Status Code : " . $info['http_code'] . "\n";
            echo "Headers are ".$headers;
            echo "Response are ".$response;
          }
        }

        curl_close($ch);
        echo "</pre>"; // REMOVE WHEN WORKING!
