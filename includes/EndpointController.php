<?php

class EndpointController extends WP_REST_Controller{
    public $namespace = '';
    public $path      = '';
    public $api       = '';

    function __construct(){
        $this->namespace = 'demo';
        $this->path      = 'endpoint';
        $this->api       = new JsonApi;
    }

    public function activate_register_routes() {
    register_rest_route( $this->namespace, '/' . $this->path, [
      array(
        'methods'             => 'GET',
        'callback'            => array( $this, 'get_endpoint_data' ),
        'permission_callback' => array( $this, 'endpoint_permission' )
            ),

        ]);     
    }

    public function endpoint_permission($request) {
        return true;
    }

    public function get_endpoint_data($request) {
        $users = $this->api->get_users();
        if(!$users) :
            echo "Sorry technical problem occured please contact us";
        else : 
            $this->view('table',$users);
        endif;
    }

    public function view($pagename,$data){
        header('Content-Type: text/html');
        include_once path_demo.'views/frontend/'.$pagename.'.php';
        exit();
    }

}