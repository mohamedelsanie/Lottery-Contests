<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

if(! function_exists('AdminName')){
    function AdminName(){
        return Auth::guard('admin')->user()->name;
    }
}

if(! function_exists('UserName')){
    function UserName(){
        return Auth::user()->name;
    }
}

if(! function_exists('AdminCan')){
    function AdminCan($permission){
        return auth()->guard('admin')->user()->can($permission);
    }
}

if(! function_exists('AdminId')){
    function AdminId(){
        return Auth::guard('admin')->user()->id;
    }
}

if(! function_exists('admin_paginate')){
    function admin_paginate(){
        $settings = Setting::checkSetting();
        return $settings->admin_paginate;
    }
}

if(! function_exists('getPrice')){
    function getPrice($price){
        return $price.' '.getSetting('currency');
    }
}

if(! function_exists('getSetting')){
    function getSetting($val){
        $settings = Setting::checkSetting();
        return $settings->$val;
    }
}

if(! function_exists('getMenu')){
    function getMenu($id){
        $menu = \App\Models\Menu::where('id',$id)->first();
        $menu_links = \App\Models\MenuLinks::where('menu_id',$id)->get();
        return $menu_links;
    }
}

if(! function_exists('getCatLink')){
    function getCatLink($slug){
        $category = \App\Models\NewsCategory::where('slug',$slug)->first();
        return route('category',$category->slug);
    }
}

if(! function_exists('getTagLink')){
    function getTagLink($id){
        $tag = \App\Models\Tags::where('id',$id)->first();
        return route('tag',$tag->id);
    }
}

if(! function_exists('getPageLink')){
    function getPageLink($id){
        $page = \App\Models\Page::where('id',$id)->first();
        return route('page',$page->slug);
    }
}

if(! function_exists('getNewsLink')){
    function getNewsLink($slug){
        $post = \App\Models\News::where('slug',$slug)->first();
        return route('post',$post->slug);
    }
}

if(! function_exists('getImageLink')){
    function getImageLink($slug){
        $post = \App\Models\Image::where('slug',$slug)->first();
        return route('photo',$post->slug);
    }
}

if(! function_exists('getVideoLink')){
    function getVideoLink($slug){
        $post = \App\Models\Video::where('slug',$slug)->first();
        return route('video',$post->slug);
    }
}

if(! function_exists('getTourLink')){
    function getTourLink($slug){
        $post = \App\Models\Contest::where('slug',$slug)->first();
        return route('tour',$post->slug);
    }
}

if(! function_exists('getTourCatLink')){
    function getTourCatLink($slug){
        $category = \App\Models\ContestTypes::where('slug',$slug)->first();
        return route('tours.category',$category->slug);
    }
}

if(! function_exists('activeMenu')){
    function activeMenu($uri = '',$uri_en = '') {
        $active = '';
        if (Request::is(Request::segment(1) . '/' .Request::segment(2) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' .Request::segment(2) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }elseif (Request::is(Request::segment(1) . '/' .Request::segment(2) . '/' . $uri_en . '/*') || Request::is(Request::segment(1) . '/' .Request::segment(2) . '/' . $uri_en) || Request::is($uri_en)){
            $active = 'active';
        }
        return $active;
    }
}

if(! function_exists('getCookie')){
    function getCookie($value){
        $var = Request::cookie($value);
        return $var;
    }
}

if(! function_exists('recentNews')){
    function recentNews($limit){
        $posts = \App\Models\News::where(['status' => 'publish'])->orderBy('id','DESC')->offset(0)->take($limit)->get();
        return $posts;
    }
}

if(! function_exists('recentNewsCats')){
    function recentNewsCats($limit){
        $posts = \App\Models\NewsCategory::orderBy('id','DESC')->offset(0)->take($limit)->get();
        return $posts;
    }
}

if(! function_exists('recenttags')){
    function recenttags($limit){
        $tags = \App\Models\Tags::orderBy('id','DESC')->offset(0)->take($limit)->get();
        return $tags;
    }
}


if(! function_exists('latestnews')){
    function latestnews(){
        $news = \App\Models\News::where(['status' => 'publish'])->orderBy('id','DESC')->offset(0)->take(getSetting('footer_blog_count'))->get();
        return $news;
    }
}

if(! function_exists('contest_status')){
    function contest_status($end_date){
        if ($end_date > strtotime(date('d-m-Y',time()))) { 
           return true;
        }else{
        return false;
            
        }
    }
}
/*
if(! function_exists('contest_status')){
    function contest_status($date){
        if ($date < date('d/m/Y')) { 
           return false;
        }
        return true;
    }
}
*/

if(! function_exists('numOfSubs')){
    function numOfSubs($contest){
        $contest = \App\Models\Contest::find($contest);
        if(!empty($contest)){
            if(!empty($contest->num_of)){
                return $contest->num_of;
            }
            $orders = \App\Models\Order::where(['contest_id' => $contest->id])->get()->all();
            return count($orders);
        }
        return '0';
    }
}


if(! function_exists('winner')){
    function winner($contest){
        $contest = \App\Models\Contest::find($contest);
        $order = \App\Models\Order::where(['contest_id' => $contest->id,'win_type' => 'winner','status' => 'payed'])->first();
        if(!empty($order)){
            return $order->user_name;
        }
        return 'غير محدد';
    }
}

