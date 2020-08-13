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

    protected function get_login(){
        dd(2);
        if($this->checkAuth() === TRUE){

            $payload = [
                'user_id' => 1,
                'key' => "Xoh4ahz5mo",
                'exp_date' => date(time()+"10 Days"),
            ];
            $jwt = JWT::encode($payload, getenv('JWT_SECRET'));

            dd($jwt);

            return http_response_code(200);
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
        return ($this->data['post_data']['username'] == 'admin' && $this->data['post_data']['password'] == '123456');
    }

    private function returnReject(){
        return http_response_code(401);
    }
}