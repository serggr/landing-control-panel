<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Service;
use App\Portfolio;
use App\People;
use DB;
use Mail;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {
        
        if($request->isMethod('post')) {
            
            $messages = [
              'required' => 'Поля :attribute обязательно к заполнению',
              'email' =>'Поле :attribute должно соответствовать email адресу'
            ];
            
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ], $messages);
           
            $data = $request->all();
            
            //mail
           /* $result =Mail::send('site.email',['data'=>$data], function($message) use ($data) {
            
               $mail_admin = env('MAIL_ADMIN');
               $message->from($data['email'],$data['name']);
               $message->from($mail_admin)->subject('Question');
            });
            
                $name = $data['name'];  
                $email = $data['email'];
                $text = $data['text'];
                $mail_admin = env('MAIL_ADMIN');


                $address  = 'sergrib@mail.ru';
                $mes = "Тема: Заказ!\nИмя: $name\nПочта: $email\nСообщения:$text";   
                $sub='Заказ'; 
    
                $send = mail ($address,$sub,$mes,"Content-type:html/plain; charset = utf-8\r\nFrom:$mail_admin");
            
            
            
            if ($send){
                return redirect()->route('home')->with('status','Email is sent');
            }*/
            
        }
        
        $pages = Page::all();
        $portfolios = Portfolio::get(array('name','filter','images'));
        $services = Service::where('id','<',20)->get();
        $peoples = People::take(3)->get();
        
        $tags = DB::table('portfolios')->distinct()->pluck('filter');
                
        $menu = array();
        foreach($pages as $page){
            $item = array('title'=>$page->name,'alias'=>$page->alias);
            array_push($menu,$item);
        }
        
        $item = array('title'=>'Services','alias'=>'service');
        array_push($menu,$item);
        
        $item = array('title'=>'Portfolio','alias'=>'Portfolio');
        array_push($menu,$item); 
        
        $item = array('title'=>'Team','alias'=>'team');
        array_push($menu,$item); 
        
        $item = array('title'=>'Contact','alias'=>'contact');
        array_push($menu,$item);  
                
        return view('site.index', array(
            'menu'=>$menu,
            'pages'=>$pages,
            'services'=>$services,
            'portfolios'=>$portfolios,
            'peoples'=>$peoples,
            'tags'=>$tags,    
                ));
        
    }
}




































