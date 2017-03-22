<?php

namespace app\models;

use app\helpers\FacebookAPIHelper;

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
            FacebookAPIHelper::call('me/messages', [
                'recipient' => $this->recipient['id'],
                'message' => [
                    'text' => $this->$answer
                ],
            ]);
        }
    }
}
