<?php

class Tlgm extends CApplicationComponent {

    public $token;
    public $chat_id;

    public function init() {
        $this->chat_id = 123456789;
        parent::init();
    }

    public function send($message) {
        if (empty($this->chat_id)) {
            return;
        }        
        $msg = strip_tags(nl2br(trim($message)));
        $req = "https://api.telegram.org/bot" . $this->token;
        $req.= "/sendMessage?chat_id=" . $this->chat_id;
        $req.= "&text=" . urlencode($msg);
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $req);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, "TelegramBot");
        $json = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $json;
    }

}
