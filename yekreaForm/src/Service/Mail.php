<?php


NameSpace App\Service;

use Mailjet\Client;
use Mailjet\Resources;




class Mail
{


    
    //Clef API compromise nouvel clef dans .env
    private $api_key = '3d4755f5c29f3ee64e1b8fc81327f75f';
    private $api_key_secret = 'fa8c18e7017778da7b69752eb5c34939';


    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new \Mailjet\Client($this->api_key, $this->api_key_secret,true,["version" => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    // Expediteur
                    'From' => [
                        'Email' => "contact@yekrea.com",
                        'Name' => "Contact Yekrea"
                    ],
                    // Destinataire
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    // id du template utiliser sur mailJet
                    'TemplateID' => 4244794,
                    'TemplateLanguage' => true,
                    // L'objet du mail
                    'Subject' => $subject,
                    'Variables' => [
                        // Le contenu
                        'content' => $content,
                    ]
                ]
            ]
                    ];
        $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
        // Pour debug faire un DD de $response
        $response->success() ;
    }
}