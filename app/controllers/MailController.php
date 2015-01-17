<?php

class MailController extends BaseController {


public function email(){
	Mail::send('emails.auth.test', array('name' => 'Alex'), function($message)
		{$message->to('pohjun.ng@gmail.com', 'poh jun') -> subject('test email');});

}


}
