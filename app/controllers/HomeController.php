<?php


namespace App\Controllers;

use Kernel\Controller;

class HomeController extends Controller
{
    protected function get_index(){
        return view("home.index");
    }
    protected function get_register(){
        return view("home.register");
    }
    protected function post_register(){
        return json_encode($this->data['post_data']);
    }
    protected function get_register2(){
        $data = $this->data['get_data'];
        if($data['username'] == 'test') return redirect('/home/register',502);
        return view('home.welcome');
        //
    }
}