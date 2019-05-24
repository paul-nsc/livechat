# livechat
Olark LiveChat tickets for FreshDesk
The files in this repo represent the work I've done off and on since last December (2018) trying to add Olark chat to our company's website.
######################################
Here is a brief description of the current process at the time this repo was created
This process currently resides primarily in the `incoming-process.php` file
#––––––––––––––––––––––––––––––
->INCOMING WEBHOOK
#== when a new chat is started, a webhook containing the event type "start" and a unique ID
--->IF $someObject->eventType == "start"
----->open 'new-chat-ticket.php'
#== when no one is logged into Olark to accept chats and someone tries to use the website chat,
#==> a different type of webhook is created:"OfflineMessage"
--->ELSE IF Items > 0
----->IF $someObject->items[0]->kind == OfflineMessage
------->require_once('new-offline-ticket.php');
#== other webhooks occur during an existing chat and they all contain "items" 
#==> if not an OfflineMessage, then the webhook contains the transcript of the chat
----->ELSE IF $someObject->items[0]->kind == MessageToOperator OR MessageToVisitor"
------->lookupTicket($someObject->visitor->emailAddress, $someObject->id);
------->$saveTranscript = getTranscript($someObject);
------->updateTicket($_SESSION["ticketID"], $saveTranscript);
------->lookupRespID($olarkID)
------->updateAgent($ticketID,$agentID)
