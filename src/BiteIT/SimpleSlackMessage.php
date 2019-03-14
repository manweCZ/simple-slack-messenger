<?php
namespace BiteIT;

class SimpleSlackMessage{
    protected $payload;

    public function __construct(){
        $this->payload = [];
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name){
        $this->payload['username'] = $name;
        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setIconUrl($url){
        $this->payload['icon_url'] = $url;
        return $this;
    }

    /**
     * @param $emoji
     * @return $this
     */
    public function setIconEmoji($emoji){
        if(substr($emoji, 0, 1) !== ':')
            $emoji = ':'.$emoji;

        if(substr($emoji, -1) !== ':')
            $emoji .= ':';

        $this->payload['icon_emoji'] = $emoji;
        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setText($text){
        $this->payload['text'] = $text;
        return $this;
    }

    public function getPayload(){
        return $this->payload;
    }

}