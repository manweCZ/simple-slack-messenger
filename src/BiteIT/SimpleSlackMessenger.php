<?php
namespace BiteIT;

class SimpleSlackMessenger{
    protected $webhookUrl;

    public function __construct($webhookUrl){
        $this->webhookUrl = $webhookUrl;
    }

    public function sendSimpleMessage(SimpleSlackMessage $message){
        $message = array(
            'payload' => json_encode($message->getPayload())
        );


        try {
            if (ini_get('allow_url_fopen')) {
                $result = $this->sendByFileGetContents($message);
            } else {
                $result = $this->sendByCurl($message);
            }

            if(!$result)
                throw new SimpleSlackException("Unable to send message. Unknown error.");
        }
        catch (\Exception $e){
            throw new SimpleSlackException('Unable to use either file_get_conents nor cUrl to send message');
        }
    }


    protected function sendByCurl($message){
        $c = curl_init($this->webhookUrl);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $message);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($c);
        curl_close($c);

        return $result;
    }

    protected function sendByFileGetContents($message){
        $postdata = http_build_query(
            $message
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents($this->webhookUrl, false, $context);
        return $result;
    }

}