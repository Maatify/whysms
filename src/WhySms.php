<?php

/**
 * @copyright   ©2023 Maatify.dev
 * @Liberary    WhySms
 * @Project     WhySms
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2023-07-30 12:02 PM
 * @see         https://www.maatify.dev Maatify.com
 * @link        https://github.com/Maatify/whysms  view project on GitHub
 * @link        https://github.com/Maatify/Logger (maatify/logger)
 * @copyright   ©2023 Maatify.dev
 * @note        This Project using for WhySMS Egypt SMS Provider API.
 * @note        This Project extends other libraries maatify/logger.
 *
 * @note        This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\WhySms;

class WhySms extends Request
{
    private static self $instance;

    public static function obj(string $api_key, string $sender_name): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self($api_key, $sender_name);
        }

        return self::$instance;
    }

    public function __construct(string $api_key, string $sender_name)
    {
        $this->sender_id = $sender_name;
        $this->api_token = $api_key;
    }

    private string $url_v3 = 'https://bulk.whysms.com/api/v3/';

    public function CheckBalance(): array
    {
        $this->url = $this->url_v3 . 'balance';
        $response = $this->Curl();
        if(!empty($response['success']) && !empty($response['data'])){
            return [
                'success'        => true,
                'remaining_unit' => $response['data']['remaining_unit'] ?? '',
                'expired_on'     => $response['data']['expired_on'] ?? '',
            ];
        }else{
            return [
                'success' => false,
                'error' => $response['error']
            ];
        }
    }

    public function SendSms(string $phone, string $message): array
    {
        $this->url = $this->url_v3 . 'sms/send';

        $response = $this->Curl(
            [
                'recipient' => $phone,
                'sender_id' => $this->sender_id,
                'type'      => 'plain',
                'message'   => $message,
            ]
        );
        return $this->HandleSmsResponse($response);
    }

    private function HandleSmsResponse(array $response): array
    {
        if(!empty($response['success']) && !empty($response['data'])){
            return [
                'success' => true,
                'details' => $response['message'] ?? '',
                'uid'     => $response['data']['uid'] ?? '',
                'to'      => $response['data']['to'] ?? '',
                'from'    => $response['data']['from'] ?? '',
                'message' => $response['data']['message'] ?? '',
                'status'  => $response['data']['status'] ?? '',
                'cost'    => $response['data']['cost'] ?? '',
            ];
        }else{
            return [
                'success' => false,
                'error' => $response['error']??''
            ];
        }
    }
}