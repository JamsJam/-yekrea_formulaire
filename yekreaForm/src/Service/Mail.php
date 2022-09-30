<?php

use Mailjet\Client;
use Mailjet\Resources;

NameSpace App\Service;





class Mail
{
    private $api_key = '3d4755f5c29f3ee64e1b8fc81327f75f';
    private $api_key_secret = 'fc7a1bc2eec6b2967a1e9e0547ff0250';


    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new \Mailjet\Client($this->api_key, $this->api_key_secret,true,["version" => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "jamsjam971@hotmail.com",
                        'Name' => "Jam"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4244794,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
        $response->success() ;
    }
}