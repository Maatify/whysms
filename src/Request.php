<?php

/**
 * @copyright   ©2023 Maatify.dev
 * @Liberary    WhySms
 * @Project     WhySms
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2023-07-30 11:39 AM
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

use Maatify\Logger\Logger;

abstract class Request
{
    protected string $url;

    protected string $api_token;

    protected string $sender_id;

    protected function Curl(array $params = []){
        if(!empty($this->url)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            if(!empty($params)){
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            }else{
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            }
            /*
            // no need returns from curl
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 100);
            */
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_FAILONERROR, true); // Required for HTTP error codes to be reported via our call to curl_error($ch)
            //        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $this->api_token,
                'Cache-Control: no-cache',
                'Content-Type: application/json',
            ));
                $result = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curl_errno = curl_errno($ch);
                $curl_error = curl_error($ch);
                curl_close($ch);

            if ($curl_errno > 0) {
                $response['success'] = false;
                $response['error'] = "(err-" . __METHOD__ . ") cURL Error ($curl_errno): $curl_error";
            } else {
                if ($resultArray = json_decode($result, true)) {
                    $response = $resultArray;
                    $response['success'] = true;
                } else {
                    $response['success'] = false;
                    $response['error'] = ($httpCode != 200) ? "Error header response " . $httpCode : "There is no response from server (err-" . __METHOD__ . ")";
                    $response['result'] = $result;
                }
            }

            if (empty($response['success']) || $response['status'] == 'error') {
                Logger::RecordLog([
                    $response,
                    $this->url,
                   __METHOD__], 'Debug_' . __FUNCTION__);
            }

            return $response;
        }
        return ['success' => false];
    }

}