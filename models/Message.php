<?php

namespace app\models;

use app\helpers\FacebookAPIHelper;
use gechet\app\App;

/**
 * Description of Message
 *
 * @author original
 */
class Message extends Model
{
    public $attachments;
    public $sender;
    public $recipient;
    public $timestamp;
    public $message;
    
    public function answer()
    {
        if ($this->message && $this->message['text']) {
            switch ($this->message['text']) {
                case 'test':
                    $answer = 'Иди тестируй в свой двор';
                    break;
                default :
                    $answer = $this->message['text'];
                    break;
            }
            App::log(FacebookAPIHelper::call('me/messages', [
                'recipient' => $this->sender['id'],
                'message' => [
                    'text' => $this->$answer
                ],
            ]));
        }
    }
}
