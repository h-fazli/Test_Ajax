<?php


namespace App\Controllers;

use Firebase\JWT\JWT;
use Kernel\Controller;


class ApiController extends Controller
{
    protected function get_ping(){
        return "Pong!";
    }

    protected function get_time(){
        return date("Y-m-d H:i:s.z", time());
    }

    protected function post_login(){
        if($this->checkAuth() === TRUE){

            $payload = [
                'user_id' => 1,
                'key' => "Xoh4ahz5mo",
                'exp_date' => date(time()+"10 Days"),
            ];
            $jwt = JWT::encode($payload, env_get('JWT_SECRET'));

            return json_encode($jwt);
        }
        else return $this->returnReject();
    }

    protected function post_get_list(){
        if($this->checkAuth() === TRUE){
            $list = ['id1'=>'user1','id2'=>'user2'];

            return json_encode($list);
        }
        else return $this->returnReject();

    }

    private function checkAuth(){
        if(isset($this->data['post_data']['token'])){
            try{
                $decoded = JWT::decode($this->data['post_data']['token'], env_get('JWT_SECRET'), array('HS256'));
                return (isset($decoded->key) && $decoded->key == 'Xoh4ahz5mo');
            }
            catch(\Exception $e){
            }
        }
        else return ($this->data['post_data']['username'] == 'admin' && $this->data['post_data']['password'] == '123456');
    }

    private function returnReject(){
        return http_response_code(401);
    }
}