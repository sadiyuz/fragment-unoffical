<?php

/**
 * Ushbu kod SadiyUZ tomonidan t.me/sadiy_dev kanalida tarqatildi.
 * Manbasiz tarqatishdan oldin o'qib chiqing!
 * @link https://lex.uz/acts/-34642
 */

class Fragment
{
    /**
     * @param string $apiKey You can get api key from fragment-api.com/dashboard
     * @param string $phoneNumber Your telegram number like 998331234567
     * @param array $mnemonics Your Ton wallet backup 24 words like ["noble", "crack", ...]
     */
    public static function auth(string $apiKey, string $phoneNumber, array $mnemonics)
    {
        $url = 'https://api.fragment-api.com/v1/auth/authenticate/';

        $jsonData = array(
            'api_key' => $apiKey,
            'phone_number' => $phoneNumber,
            'mnemonics' => $mnemonics
        );

        $sadiy_dev = curl_init();
        curl_setopt($sadiy_dev, CURLOPT_URL, $url);
        curl_setopt($sadiy_dev, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($sadiy_dev, CURLOPT_POST, 1);
        curl_setopt($sadiy_dev, CURLOPT_POSTFIELDS, json_encode($jsonData));

        curl_setopt($sadiy_dev, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($sadiy_dev, CURLOPT_TIMEOUT, 120);

        curl_setopt($sadiy_dev, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json'
        ]);

        $sadiyuz = curl_exec($sadiy_dev);

        if (curl_errno($sadiy_dev)) {
            curl_close($sadiy_dev);
            return;
        }

        curl_close($sadiy_dev);
        return json_decode($sadiyuz, true);
    }

    public static function walletBalance(string $authToken)
    {
        $url = 'https://api.fragment-api.com/v1/misc/wallet/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: JWT ' . $authToken
        ]);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        return json_decode($result, true);
    }

    public static function buyStars(string $username, int $quantity, string $jwt_token)
    {
        $url = 'https://api.fragment-api.com/v1/order/stars/';

        $payload = json_encode([
            "username" => $username,
            "quantity" => $quantity,
            "show_sender" => false
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: JWT ' . $jwt_token
        ]);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return;
        }

        curl_close($ch);
        return json_decode($result, true);
    }
}
