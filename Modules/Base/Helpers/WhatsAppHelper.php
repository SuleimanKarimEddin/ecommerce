<?php

namespace Modules\Base\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WhatsAppHelper
{
    public function generateWhatsAppCode($code_length = null): string
    {

        $code_length = $code_length ?? config('base.code_length');

        return Str::random($code_length);
    }

    public function SendWhatsAppMessage(string $number, string $code): bool
    {

        $token = config('base.token');
        $params = [
            'token' => $token,
            'to' => $number,
            'body' => config('base.message_body').' '.$code,
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
                ->get(config('base.base_url'), $params);

            $body = json_decode($response->body(), true);

            if (isset($body['error'])) {
                throw new Exception($body['error'][0]['to']);
            }

            return true;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
