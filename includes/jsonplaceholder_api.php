<?php

class JsonApi
{
    private $baseurl        = 'https://jsonplaceholder.typicode.com/';
    private $error_endpoint = 'https://jsonplaceholder.typicode.com/error/';
    private $endpoint       = '';

    function __construct()
    {

    }

    public function get_users(){
        $this->endpoint = 'users';
        $response = $this->get_request($this->baseurl.$this->endpoint);
        if ( is_wp_error( $response ) ) :
           // return new WP_Error( 'error', 'Oops error' );
           return false;
        else :
            return $parse = json_decode($response['body'],true);
        endif;
    }

    public function get_headers($type = null){
        if('json' == $type){
            return array('Content-Type' => 'application/json; charset=utf-8');
        }else{
            return array('Content-Type' => 'Content-Type: text/html');
        }
    }

    public function post_request(){
        return wp_remote_post( $url, ["headers" => $this->get_headers('json'),"method"  => "POST"] );
    }

    public function get_request($url){
        return wp_remote_get( $url, ["headers" => $this->get_headers('json'),"method"  => "GET"] );
    }

    public function check_error($httpcode){
        http_response_code($httpcode);
        exit;
    }
}