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
    
    const FORMAT_TEXT = 'plainText';
    const FORMAT_ATTACHMENT = 'attachment';
    const FORMAT_LOGIN = 'login';
    
    public function answer()
    {
        if ($this->message && $this->message['text']) {
            switch ($this->message['text']) {
                case 'test':
                    $answer = $this->formatAnswer('Yeah, i\'m online', self::FORMAT_TEXT);
                    break;
                case 'show menu':
                    $answer = $this->formatAnswer([
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
                    ], self::FORMAT_ATTACHMENT);
                    break;
                default :
                    $answer = $this->formatAnswer('I guess you said something wrong. Try again!', self::FORMAT_TEXT);
                    break;
            }
            App::log(FacebookAPIHelper::call('me/messages', [
                'recipient' => ['id' => $this->sender['id']],
                'message' => $answer,
            ]));
        }
    }
    
    public function formatAnswer($data, $type)
    {
        if (!in_array($type, [self::FORMAT_ATTACHMENT, self::FORMAT_LOGIN, self::FORMAT_TEXT])) {
            throw new \Exception();
        }
        $loged = false;
        if (!$loged) {
            return $this->formatConnect();
        }
        switch ($type) {
            case self::FORMAT_TEXT:
                return $this->formatPlainText($data);
            case self::FORMAT_ATTACHMENT:
                return $this->formatAttachment($data);
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
    
    public function formatConnect()
    {
        $this->formatAttachment([
            'title' => 'Login',
            'subtitle' => 'If you want access to your personal functions, you should login in system',
            'image_url' => 'http://antagosoft.com/img/antago_logo-1.png',
            'buttons' => [
                [                
                    'type' => 'account_link',
                    'url' => 'https://fbbot.antagosoft.com/auth.php',
                ]
        ]]);
    }
}
