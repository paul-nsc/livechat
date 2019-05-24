<?php
require_once("functions.php");

/*==== Uncomment line below to test creating a new chat ticket=====*/
#$req_dump='data={"kind": "Conversation", "tags": [], "eventType": "start", "operators": {}, "visitor": {"city": "Buffalo Grove", "kind": "Visitor", "conversationBeginPage": "https://www.northshorecare.com/header_footer?lng=eng", "countryCode": "US", "referrer": "https://www.northshorecare.com/header_footer", "ip": "50.200.238.138", "region": "IL", "chat_feedback": {}, "operatingSystem": "Windows", "emailAddress": "realto619@gmail.com", "country": "United States", "organization": "Comcast Business", "fullName": "Paul", "id": "Wwcqs2f4AQPIYR2p8D5z70UaB2bFb5rT", "browser": "Chrome 74.0.3729.131"}, "groups": [{"kind": "Group", "id": "b34218c2b3f146687adcf19f36ad7182", "name": "Spanish"}], "items": [], "id": "wGev6kIm8m9tIwyZ8D5z70Ua2FozbDBT", "manuallySubmitted": false}';
#$req_dump='data={"kind": "Conversation", "tags": [], "eventType": "start", "operators": {}, "visitor": {"city": "Buffalo Grove", "kind": "Visitor", "conversationBeginPage": "https://www.northshorecare.com/header_footer", "countryCode": "US", "ip": "50.200.238.138", "region": "IL", "chat_feedback": {}, "operatingSystem": "iOS", "emailAddress": "iphone.safari5@gmail.com", "country": "United States", "organization": "Comcast Business", "fullName": "Iphone Safari 5", "id": "o2CXwSHoyqcNKTWi8D5z70U0Cp1OLFB5", "browser": "Safari 12.1"}, "groups": [{"kind": "Group", "id": "b34218c2b3f146687adcf19f36ad7182", "name": "English"}], "items": [], "id": "G8G2oy1ymohPS6hp8D5z70U0FQOpL5E1", "manuallySubmitted": false}';
/*==== Uncomment line below to test adding the transcript to an existing ticket=====*/
#$req_dump='data={"kind": "Conversation", "tags": [], "items": [{"body": "hi there!", "timestamp": "1558107754.825684", "kind": "MessageToVisitor", "nickname": "Paul", "operatorId": "1029431"}, {"body": "just making sure that everything is still working", "timestamp": "1558107786.341602", "kind": "MessageToOperator", "nickname": "Paul (realto619@gmail.com)", "visitor_nickname": "Paul"}, {"body": "as far as i know!", "timestamp": "1558107803.770102", "kind": "MessageToVisitor", "nickname": "Paul", "operatorId": "1029431"}], "operators": {"1029431": {"username": "paul-northshore", "emailAddress": "paul@northshorecare.com", "kind": "Operator", "nickname": "Paul", "id": "1029431"}}, "groups": [{"kind": "Group", "id": "b34218c2b3f146687adcf19f36ad7182", "name": "Spanish"}], "visitor": {"city": "Buffalo Grove", "kind": "Visitor", "conversationBeginPage": "https://www.northshorecare.com/header_footer?lng=eng", "countryCode": "US", "referrer": "https://www.northshorecare.com/header_footer", "ip": "50.200.238.138", "region": "IL", "chat_feedback": {}, "operatingSystem": "Windows", "emailAddress": "realto619@gmail.com", "country": "United States", "organization": "Comcast Business", "fullName": "Paul", "id": "Wwcqs2f4AQPIYR2p8D5z70UaB2bFb5rT", "browser": "Chrome 74.0.3729.131"}, "id": "wGev6kIm8m9tIwyZ8D5z70Ua2FozbDBT", "manuallySubmitted": false}';
#$req_dump='data={"kind": "Conversation", "tags": [], "items": [{"body": "greetings", "timestamp": "1558484746.452903", "kind": "MessageToVisitor", "nickname": "Paul", "operatorId": "1029431"}, {"body": "Good evening", "timestamp": "1558484758.623977", "kind": "MessageToOperator", "nickname": "Iphone Safari 5 (Iphone.safari5@gmail.com)", "visitor_nickname": "Iphone Safari 5"}, {"body": "yes it is", "timestamp": "1558484779.656826", "kind": "MessageToVisitor", "nickname": "Paul", "operatorId": "1029431"}], "operators": {"1029431": {"username": "paul-northshore", "emailAddress": "paul@northshorecare.com", "kind": "Operator", "nickname": "Paul", "id": "1029431"}}, "groups": [{"kind": "Group", "id": "b34218c2b3f146687adcf19f36ad7182", "name": "English"}], "visitor": {"city": "Buffalo Grove", "kind": "Visitor", "conversationBeginPage": "https://www.northshorecare.com/header_footer", "countryCode": "US", "ip": "50.200.238.138", "region": "IL", "chat_feedback": {}, "operatingSystem": "iOS", "emailAddress": "iphone.safari5@gmail.com", "country": "United States", "organization": "Comcast Business", "fullName": "Iphone Safari 5", "id": "o2CXwSHoyqcNKTWi8D5z70U0Cp1OLFB5", "browser": "Safari 12.1"}, "id": "G8G2oy1ymohPS6hp8D5z70U0FQOpL5E1", "manuallySubmitted": false}';
#New Spanish Chat
#$req_dump='data={"kind": "Conversation", "tags": [], "eventType": "start", "operators": {}, "visitor": {"city": "Buffalo Grove", "kind": "Visitor", "conversationBeginPage": "https://www.northshorecare.com/header_footer?lng=spn", "countryCode": "US", "referrer": "https://www.northshorecare.com/header_footer", "ip": "50.200.238.138", "region": "IL", "chat_feedback": {}, "operatingSystem": "iOS", "emailAddress": "elchupa@gmail.com", "country": "United States", "organization": "Comcast Business", "fullName": "El chupacabra", "id": "pqLA0Mf7WPgZDX6A8D5z70V0AvGZoRE5", "browser": "ChromeiOS 74.0.3729.121"}, "groups": [{"kind": "Group", "id": "45d6d9ce54d5ce09e883e575537bba67", "name": "English"}], "items": [], "id": "qu5HhS2xbfIFE7PI8D5z70U0pCoQ5Bve", "manuallySubmitted": false}';
/*==== Uncomment line below to test creating an Offline Message ticket=====*/
#$req_dump='data={"kind": "Conversation", "tags": [], "items": [{"body": "name: Paul\nemail: realto619@gmail.com\nphone: 602.430.9740\nMessage: Just testing offlne messages", "timestamp": "1558118672.500824", "kind": "OfflineMessage"}], "groups": [{"kind": "Group", "id": "b34218c2b3f146687adcf19f36ad7182", "name": "English"}], "visitor": {"city": "Buffalo Grove", "kind": "Visitor", "organization": "Comcast Business", "conversationBeginPage": "https://www.northshorecare.com/header_footer?lng=eng", "countryCode": "US", "referrer": "https://www.northshorecare.com/header_footer", "ip": "50.200.238.138", "region": "IL", "operatingSystem": "Windows", "emailAddress": "realto619@gmail.com", "country": "United States", "phoneNumber": "602.430.9740", "fullName": "Paul", "id": "Wwcqs2f4AQPIYR2p8D5z70UaB2bFb5rT", "browser": "Chrome 74.0.3729.131"}, "id": "bX484dgUMpjCb6Qy8D5z70UzD2Fe2arT", "manuallySubmitted": false}';
#End Spanish Chat
#$req_dump='data={"kind": "Conversation", "tags": [], "items": [{"body": "hola", "timestamp": "1558545293.272144", "kind": "MessageToVisitor", "nickname": "Paul", "operatorId": "1029431"}, {"body": "hola", "timestamp": "1558545351.857751", "kind": "MessageToVisitor", "nickname": "Paul", "operatorId": "1029431"}, {"body": "Hola", "timestamp": "1558545362.933080", "kind": "MessageToOperator", "nickname": "El chupacabra (Elchupa@gmail.com)", "visitor_nickname": "El chupacabra"}], "operators": {"1029431": {"username": "paul-northshore", "emailAddress": "paul@northshorecare.com", "kind": "Operator", "nickname": "Paul", "id": "1029431"}}, "groups": [{"kind": "Group", "id": "45d6d9ce54d5ce09e883e575537bba67", "name": "English"}], "visitor": {"city": "Buffalo Grove", "kind": "Visitor", "conversationBeginPage": "https://www.northshorecare.com/header_footer?lng=spn", "countryCode": "US", "referrer": "https://www.northshorecare.com/header_footer", "ip": "50.200.238.138", "region": "IL", "chat_feedback": {}, "operatingSystem": "iOS", "emailAddress": "elchupa@gmail.com", "country": "United States", "organization": "Comcast Business", "fullName": "El chupacabra", "id": "pqLA0Mf7WPgZDX6A8D5z70V0AvGZoRE5", "browser": "ChromeiOS 74.0.3729.121"}, "id": "qu5HhS2xbfIFE7PI8D5z70U0pCoQ5Bve", "manuallySubmitted": false}';


if($req_dump=='') {

  header('Content-Type: application/json');
  $request = file_get_contents('php://input');
  $req_dump = print_r( $request, true );
  $fp0 = file_put_contents( '__new_raw_request.log', $request.";\n", FILE_APPEND );
  //$data = json_decode($req_dump);
  $req_dump = utf8_decode(urldecode($req_dump));
  $fp = file_put_contents( '__new_request.log', $req_dump.";\n", FILE_APPEND );
  $fp2 = file_put_contents( '__new_chat.log', $req_dump.";\n", FILE_APPEND );

}  

$someJSON =  utf8_decode(urldecode($req_dump));
$manipJSON = str_replace('data={','{',$someJSON);

$someObject = json_decode($manipJSON);

  // ========= PROCESS NEW CHAT ==============
  if( (isset ($someObject->eventType)) && ($someObject->eventType=="start") ) {

    //echo ('new-chat-ticket called...');
    require_once('new-chat-ticket.php');
    

  } else if( count($someObject->items)  > 0) {

      // ========= NEW OFFLINE TICKET ==============
      if(isset ($someObject->items[0]->kind) && ($someObject->items[0]->kind=="OfflineMessage") ) {

        echo ('new-offline-ticket called...');
        require_once('new-offline-ticket.php');
      
      // ========= ADD TRANSCRIPT TO EXISTING TICKET ==============
      //}  else if(isset ($someObject->items[0]->kind) && ( ($someObject->items[0]->kind=="MessageToVisitor") || ($someObject->items[0]->kind=="MessageToVisitor")  ) ) {
      } else if( ($someObject->items[0]->kind=="MessageToOperator") || ($someObject->items[0]->kind=="MessageToVisitor") ) {

        // echo ('chat-ticket updated...');
        lookupTicket($someObject->visitor->emailAddress, $someObject->id);
        $saveTranscript = getTranscript($someObject);
        echo "\$ticketID = ".$_SESSION["ticketID"]."<br /><textarea style='width:600px;height:50px'>$saveTranscript</textarea><br />";
        echo "call updateTicket()<br />";

        updateTicket($_SESSION["ticketID"], $saveTranscript);

        $getOpID = getOpID($someObject->operators);
        $getAgentID = getAgentID($getOpID);
        updateAgent($_SESSION["ticketID"], $getAgentID); 
      }  

  } else if( (isset ($someObject->isLead)) && ($someObject->isLead=="true") ) {

        //echo('last "else if"');
        $chatUserEmailAddress = $someObject->visitor->emailAddress;
        $chatOlarkID = $someObject->visitor->id;
        //echo '<iframe style="width:90%;height:300px;" frameborder="0" src="lookup-ticket.php?email='.$chatUserEmailAddress.'&olark_id='.$chatOlarkID.'">Your browser doesn\'t support Iframes. Really?</iframe>';

  } else {
    echo "nothing to process...";
  }

//  echo "</pre>";
?>
