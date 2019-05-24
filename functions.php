<?php
session_start();

function processWebhook() {

  header('Content-Type: application/json');
  $request = file_get_contents('php://input');
  $req_dump = print_r( $request, true );
  $fp0 = file_put_contents( '__new_raw_request.log', $request.";\n", FILE_APPEND );
  //$data = json_decode($req_dump);
  $req_dump = utf8_decode(urldecode($req_dump));
  $fp = file_put_contents( '__new_request.log', $req_dump.";\n", FILE_APPEND );
  $fp2 = file_put_contents( '__new_chat.log', $req_dump.";\n", FILE_APPEND );

  $someJSON =  utf8_decode(urldecode($req_dump));
  $manipJSON = str_replace('data={','{',$someJSON);
  $someObject = json_decode($manipJSON);

}

function getClientIP() { 

 if (isset ($_SERVER ['HTTP_X_FORWARDED_FOR'])){ 
  $clientIP = $_SERVER ['HTTP_X_FORWARDED_FOR']; 
 } 
 elseif (isset ($_SERVER ['HTTP_X_REAL_IP'])){ 
  $clientIP = $_SERVER ['HTTP_X_REAL_IP']; 
 } 
 else { 
  $clientIP = $_SERVER['REMOTE_ADDR']; 
 } 
 return $clientIP; 
} 

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

function getGroupID($groupName) {
    $group2Assign = $groupName;
    echo "<br />\$group2Assign = ".$group2Assign."<br />";
    
    if($group2Assign=="Spanish") {
      $groupID = 28000025087;
    } else {
      $groupID = 28000025088;
    }  
    return $groupID;
}

function getGroupByID($group_ID) {
    echo "<br />\$group_ID = ".$group_ID."<br />";
    
    if($group_ID=="45d6d9ce54d5ce09e883e575537bba67") {
      $groupID = 28000025087;
    } else {
      $groupID = 28000025088;
    }  
    return $groupID;
}


function getOfflineMsg($groupBody) {

  $array =  explode("\n", $groupBody);
  $getArrayItem = "<ul>";
  foreach ($array as $item) {
      $getArrayItem  .= "<li>$item</li>";
  }
  $getArrayItem .= "</ul>";

  return $getArrayItem;

}

function getOpID($getObj) {
  if( (isset ($getObj)) && ($getObj<>"") ) {
    $showOp = json_encode($getObj);
    $getID = explode(":",$showOp);
    $showID = $getID[0];
    $showID2 = str_replace(array('{','"'),'',$showID);
    return $showID2;
  }
}


function sendEmail($subject, $message) {

  $email_to = "paul@northshorecare.com";
  $email_subject = $subject;
  $email_from = "info@netcentrx.net";
  $id_address = getClientIP();


  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

  $string_exp = "/^[A-Za-z .'-]+$/";


  if(strlen($error_message) > 0) {
    died($error_message);
  }

  $email_message = $message;

  $email_message .= "User IP Address: ".clean_string($id_address)."\n";

   
  // create email headers
  $headers = 'From: '.$email_from."\r\n".
  'Reply-To: '.$email_from."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  @mail($email_to, $email_subject, $email_message, $headers);  
}

function wrapPreTags($callFunction) {
  echo "<pre>";
  $callFunction; 
  echo "</pre>";
}

function showTimeStamp($timestamp,$type="time") {
  if($type=="date") {
    $showIt =  date('Y-m-d', $timestamp);
  } else {
    //$showIt =  date('g:i:sa', $timestamp);
        $showIt =  date('g:i a', $timestamp);
  }
  return $showIt;
}

function getTranscript($some_Object) {
    $someObject = $some_Object;

    if( (isset ($someObject->kind)) && ($someObject->kind=="Conversation") ) {

        /**** Start New Ticket ****/
        $userEmail = $someObject->visitor->emailAddress;
        $userName = $someObject->visitor->fullName;
        $theDate = showTimeStamp($someObject->items[0]->timestamp,"date");
        $theTranscript = "<div style='width:500px;font-family:open sans, sans-serif;font-size:14px;'><strong>New Chat Transcript</strong>: $theDate <strong><a href=\"mailto:$userEmail\">$userName</a></strong> <br />";
        $theTranscript .= "<hr />";
         
        if( count($someObject->items)  > 0) {
            foreach($someObject->items as $item) {
                $message = $item->body;
                $getTime = showTimeStamp($item->timestamp);
                $msgType =  $item->kind;
                if($msgType == 'MessageToOperator') { 
                  $msgFrom = "<span style='display:inline-block;width:80px;'>$getTime</span><span style='color:#dd6500;font-weight:bold;'>".$item->visitor_nickname.":</span> $message";

                } else {
                  $msgFrom =  $item->nickname;  
                  $msgFrom = "<span style='display:inline-block;width:80px;'>$getTime</span><span style='color:#0063b7;font-weight:bold;'>".$item->nickname.":</span> $message";
                }
                if($msgFrom)
                $theTranscript .= "$msgFrom<br />"; 
            }

              $theTranscript .= "</div><br /><br />";
         } else {
            $theTranscript = "";
         }
        //$saveContents = $theTranscript;
        return $theTranscript;
      }   
}


function lookupTicket($getEmail, $getOlarkID) {

  if( $getEmail !='' ) {

    require_once('api.php');
    $customer_email = $getEmail;

    if( $getOlarkID !='' ) {
      $olark_id = $getOlarkID;
    } else {
      echo "No Chat ID. Ticket Lookup Aborted.";
      exit();
    }  

    echo "<pre>";

    $ticket_data = json_encode(array(
      "status" => 5,
      "priority" => 4
    ));


    $url = 'https://'.$yourdomain.'.freshdesk.com/api/v2/tickets?email='.$customer_email;

    $ch = curl_init($url);

    $header[] = "Content-type: application/json";
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
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



    if($info['http_code'] == 200) {
      echo "Ticket Lookup successful, the response is given below \n";
      echo "Response Headers are \n";
      echo $headers."\n";
      echo "Response Body \n";
      echo $response."\n";


      // Convert JSON string to Object
      $someObject = json_decode($response);
    //  print_r($someObject);      // Dump all data of the Object
      if($someObject[0]->id) {
          echo "<br />";
          echo "\$someObject[0]->id = " . $someObject[0]->id; // Access Object data
          echo "<br />";
          echo "\$someObject[0]->custom_fields->cf_olark_id = " . $someObject[0]->custom_fields->cf_olark_id; // Access Object data
          echo "<br />";
          $ticketToClose = $someObject[0]->id;
          echo "<br />";

          if ($olark_id == $someObject[0]->custom_fields->cf_olark_id) {
            echo "IDs match! Ticket to update: <strong>".$ticketToClose."</strong><br />";
            //return $ticketToClose;
            $_SESSION["ticketID"] = $ticketToClose;

          } else {
            echo "No matching ID found...";
          }
      }
    echo "<hr />";

      
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

    echo "<br />".$url;
    echo "</pre>";
  } else {
    echo "No Email Address to look up. Ticket Lookup Aborted.";
  }

}

function updateTicket($ticketID, $note) {

  if($ticketID == '') { echo "\$ticketID = $ticketID<br />Exiting, Stage Left..."; exit(); }
  if($note == '') { echo "\$note = $note<br />Exiting, Stage Left..."; exit(); }
  require('api.php');


  $ticket_data = json_encode(array(

    "body" => "$note",
    "private" => false
    
  ));

  // Id of the ticket to be updated
  $ticket_id = $ticketID;

  $url = "https://$yourdomain.freshdesk.com/api/v2/tickets/$ticket_id/notes";
 
  $ch = curl_init($url);

  $header[] = "Content-type: application/json";
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
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


  if($info['http_code'] == 200) {
    echo "Ticket updated successfully, the response is given below \n";
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

}


function getAgentID($olarkID) {
  require('api.php');
  $url = 'https://northshorecare.freshdesk.com/api/v2/agents?mobile='.$olarkID;

  if($url!='') {

      $ch = curl_init($url);

      $header[] = "Content-type: application/json";
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
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



      if($info['http_code'] == 200) {
        $httpCode = "Ticket Lookup successful, the response is given below \n";
        $httpCode .= "Response Headers are \n";
        $httpCode .= $headers."\n";
        $httpCode .= "Response Body\n";
        $httpCode .= $response = str_replace("\n","",$response);
        $httpCode .= "End Response Body\n";

        // Convert JSON string to Object
        $someObject = json_decode($response);
        if($someObject[0]->id) {
            $agentID = $someObject[0]->id;
        } else {
          $httpCode .= "No matching ID found...";
        }
        
      } else {
        if($info['http_code'] == 404) {
          $httpCode = "Error, Please check the end point \n";
        } else {
          $httpCode = "Error, HTTP Status Code : " . $info['http_code'] . "\n";
          $httpCode .= "Headers are ".$headers;
          $httpCode .= "Response are ".$response;
        }
      }
      echo $httpCode;

      curl_close($ch);

    } else {
      echo "No Agent ID to look up. Agent Lookup Aborted.";
      $agentID = "";
    }
    return $agentID;
}

function updateAgent($ticketID, $respID) {

  if($ticketID == '') { echo "\$ticketID = $ticketID<br />Exiting, Stage Left..."; exit(); }
  require('api.php');


  $ticket_data = json_encode(array(
    "responder_id" => $respID
  ));

  // Id of the ticket to be updated
  $ticket_id = $ticketID;

//  $url = "https://$yourdomain.freshdesk.com/api/v2/tickets/$ticket_id/notes";
  $url = "https://$yourdomain.freshdesk.com/api/v2/tickets/$ticket_id";

  $ch = curl_init($url);

  $header[] = "Content-type: application/json";
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
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


  if($info['http_code'] == 200) {
    echo "Ticket updated successfully, the response is given below \n";
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

}
