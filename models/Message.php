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
                    $answer = $this->formatPlainText('Yeah, i\'m online');
                    break;
                case 'show menu':
                    $answer = $this->formatAttachment([
                        [
                            'title' => 'OMG! This is THE MENU',
                            'subtitle' => 'And it\'s awesome subtitle',
                            'image_url' => 'http://antagosoft.com/img/antago_logo-1.png',
                            'buttons' => [
                                [
                                    'type' => 'web_url',
                                    'url' => 'http://antagosoft.com/',
                                    'title' => 'Yeah, this guys'
                                ],
                                [
                                    'type' => 'postback',
                                    'payload' => 'some data',
                                    'title' => 'Call Postback'
                                ],
                            ],
                        ],                        
                    ]);
                    break;
                default :
                    $answer = $this->formatPlainText('I guess you said something wrong. Try again!');
                    break;
            }
            App::log(FacebookAPIHelper::call('me/messages', [
                'recipient' => ['id' => $this->sender['id']],
                'message' => $answer,
            ]));
        }
    }
    
    public function formatPlainText($message)
    {
        return [
            'text' => $message
        ];
    }
    
    public function formatAttachment($elements)
    {
        return [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => $elements,
                ],
            ]
        ];
    }
}
