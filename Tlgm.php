<?php

/**
 * @author kas-cor
 * @link https://github.com/kas-cor/Yii11ExtensionTelegram
 */

class Tlgm extends CApplicationComponent {

    /**
     * @var string Token API Telegram
     */
    public $token;
    
    /**
     * @var int Chat ID 
     */
    public $chat_id;

    public function init() {
        $this->chat_id = 123456789;
        parent::init();
    }

    /**
     * Sending message
     * @param string $message Text message
     * @return string JSON response
     */
    public function send($message) {
        if (empty($this->chat_id)) {
            return;
        }        
        $msg = strip_tags(nl2br(trim($this->convertToUtf8($message))));
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

    /**
     * Convert to utf-8, if win-1251
     * @param type $text
     * @return type
     */
    private function convertToUtf8($text) {
        if (!preg_match("//u", $text)) {
            return iconv("windows-1251", "utf-8", $text);
        } else {
            return $text;
        }
    }
    
}
