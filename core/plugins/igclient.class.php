<?php
class IgClient {

    private $username;
    private $password;

    private $proxy;
    private $proxy_auth;

    private $uuid;
    private $device_id;
    private $uid;
    private $cookies;
    private $csrf;
    private $rank_token;
    private $waterfall_id;
    private $phone_id;
    private $advertiser_id;
    private $anon_id;
    private $useragent;

    public function init($login, $password) {
      $this->username = $login;
      $this->password = $password;

      $this->uuid = $this->generateUUID(true);
      $this->device_id = $this->generateUUID(true);
      $this->waterfall_id = $this->generateUUID(true);
      $this->phone_id = $this->generateUUID(true);
      $this->advertiser_id = $this->generateUUID(true);
      $this->useragent = "Instagram 85.0.0.21.100 (iPhone8,1; iPhone OS 9_3_1; en_US; en-US; scale=2.00; 750x1334; 146536611)";
    }

    public function login() {
      $fetch = $this->request('https://i.instagram.com/api/v1/si/fetch_headers/?challenge_type=signup&guid='.str_replace('-', '', $this->uuid), null, true);
      $this->csrf = $this->get_string_between($fetch[0], 'csrftoken=', ';');
      $data = [
      'phone_id'            => $this->phone_id,
      '_csrftoken'          => $this->csrf,
      'username'            => $this->username,
      'adid'                => $this->advertiser_id,
      'guid'                => $this->uuid,
      'device_id'           => $this->device_id,
      'password'            => $this->password,
      'login_attempt_count' => '0',
     ];
      $login = $this->request('https://i.instagram.com/api/v1/accounts/login/', $this->generateSignature(json_encode($data)), true);
      echo $login;
    }

    public function generateUUID($type) {
      $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0x0fff) | 0x4000,
      mt_rand(0, 0x3fff) | 0x8000,
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
      );
      return $type ? $uuid : strtoupper(str_replace('-', '', $uuid) ) ;
    }

    public function generateSignature($data) {
        $hash = hash_hmac('sha256', $data, 'e0767f8a7ae9f6c1f9d3674be35d96117f0589960bf3dbd2921f020b33ca4b9f');
        return 'signed_body='.$hash.'.'.urlencode($data).'&ig_sig_key_version=5';
    }

    public function request($endpoint, $post = null, $login = false) {
      if ($endpoint == 'https://i.instagram.com/api/v1/qe/sync/' || $endpoint == 'https://i.instagram.com/api/v1/fb/show_continue_as/' ) {
          $headers = [
          		'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
          		'Accept: */*',
          		'Accept-Encoding: gzip, deflate',
          		'Connection: keep-alive',
          		'Proxy-Connection: keep-alive',
          		'X-IG-Capabilities: 36oH',
          		'Accept-Language: en-US;q=1',
          		'X-IG-Connection-Type: WiFi-Fallback',
          		'Cookie2: $Version=1',
          ];
      } else {
         $headers = [
              'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
              'Accept: */*',
              'Accept-Encoding: gzip, deflate',
              'Connection: keep-alive',
              'Proxy-Connection: keep-alive',
              'X-IG-Capabilities: 36oH',
              'Accept-Language: en-US;q=1',
              'X-IG-Connection-Type: WiFi',
              'Cookie2: $Version=1',
          ];
      }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->UA);  // 9 5
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        if ( $this->proxy != null) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy );
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxy_auth_credentials);
        }
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $resp = curl_exec($ch);
        $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($resp, 0, $header_len);
        $body = substr($resp, $header_len);
        curl_close($ch);
        if (true) {
            echo "REQUEST: $endpoint\n";
            if (!is_null($post)) {
                if (!is_array($post)) {
                    echo 'DATA: '.urldecode($post)."\n";
                }
            }
            echo "RESPONSE: $body\n\n";
        }
        return [$header, json_decode($body, true)];
    }

    public function get_string_between($string, $start, $end){
      $string = ' ' . $string;
      $ini = strpos($string, $start);
      if ($ini == 0) return '';
      $ini += strlen($start);
      $len = strpos($string, $end, $ini) - $ini;
      return substr($string, $ini, $len);
    }

}
?>
