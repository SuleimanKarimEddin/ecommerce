<?php

$instance_id = 'instance86756';

return [
    'name' => 'Base',
    'firebase_url' => 'https://fcm.googleapis.com/fcm/send',
    'fcm_server_key' => env('FCM_SERVER_KEY'),
    'languages' => ['en', 'ar'],
    'firebase_images' => false,
    'code_length' => 6,
    'token' => 'wgf1q5gk2h8mv4pq',
    'instance_id' => $instance_id,
    'base_url' => 'https://api.ultramsg.com/'.$instance_id.'/messages/chat',
    'message_body' => 'Your Verification Code is ',
];
