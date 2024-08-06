<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Contest;
use App\Models\Order;
use App\Models\ContestTypes;
use App\Models\ContestComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Psr\Log\error;

class ToursController extends Controller
{
    //
    public function index()
    {
        $page_title = 'المسابقات';
        $posts = Contest::where(['status' => 'publish'])->orderBy('id','DESC')->paginate(getSetting('posts_per_page'));
        return view('front.tours.index',['posts'=>$posts,'page_title' => $page_title]);
    }

    public function search(Request $request)
    {
//        dd($request->all());
        $amount = explode('-', $request->amount);

        $page_title = 'Search';
        $from_date = $request->from_date;
        $from_place = $request->from_place;
        $to_date = $request->to_date;
        $to_place = $request->to_place;
        $min_price = $amount[0];
        $max_price = $amount[1];
        if(!empty($request->amount)){
            $posts = Tour::orderBy('id','DESC')
                ->WhereTranslationLike('to_place', $to_place)
                ->WhereTranslationLike('from_place', $from_place)
                ->WhereBetween('price', [$min_price, $max_price])
                ->orWhereBetween('from_date', [$from_date, $to_date])
                ->orWhereBetween('to_date', [$from_date, $to_date])
                ->paginate(getSetting('posts_per_page'));
            return view('front.tours.index',['posts'=>$posts,'page_title' => $page_title]);
        }else{
            return redirect()->route('tours')->with([
                'message' => 'برجاء ضبط إعدادات البحث',
                'alert_type' => 'danger'
            ]);
        }
    }
    public function post($slug)
    {
        $post = Contest::where(['slug' => $slug])->first();
        if(!empty($post)){
            $comments = ContestComment::orderBy('id','DESC')->where(['contest_id' => $post->id,'parent' =>0,'status' => 'publish'])->with('children')->get();
            
            
            $user_name = 'EGY-';
            $user_name .= substr(uniqid(mt_rand(0,10), false),0);
            $orders = Order::pluck('user_name')->all();
            if(in_array($user_name, $orders)) {
                $user_name = $user_name.'d';
            }
            $last_one = Order::orderBy('id', 'desc')->first();
            //
            $invoice = '#';
            $invoice .= $last_one->id+1;
            
            return view('front.tours.show',['post'=>$post,'comments' => $comments,'user_name' => $user_name,'invoice' => $invoice]);
        }else{
            return abort(404);
        }
    }

    public function category($slug)
    {
        $category = ContestTypes::where(['slug' => $slug])->first();
        if(!empty($category)){
            $posts = Contest::where(['contest_type_id' => $category->id,'status' => 'publish'])->orderBy('id','DESC')->paginate(getSetting('posts_per_page'));
            return view('front.tours.category',['category'=>$category,'posts' => $posts]);
        }else{
            return abort(404);
        }
    }

    

    public function subscribe(Request $request)
    {
        if(!empty($request->contest)){
            
            $last_one = Order::orderBy('id', 'desc')->first();
            //
            $invoice = '#';
            $invoice .= $last_one->id+1;
            $contest = Contest::find($request->contest);

            $request->merge([
                "title"    => 'إشتراك رقم '.$invoice,
                "invoice_id"    => $invoice,
                'status'        => 'not_payed',
                'win_type'        => 'loser',
                'fin_price'        => $contest->price,
                'user_id'        => 1,
            ]);
            $validator = Validator::make($request->all(), [
                'name'      => 'required|max:255|min:3',
                'adress'    => 'required',
                'phone'     => 'required',
                'user_name' => 'required',
                'contest'   => 'required',
                'img'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //dd($request->all());
            

            $imageName = time().'.'.$request->img->extension();  
     
            $request->img->move(public_path('images'), $imageName);

            $data['title']      = $request->title;
            $data['name']      = $request->name;
            $data['adress']    = $request->adress;
            $data['phone']     = $request->phone;
            $data['user_name'] = $request->user_name;
            $data['contest_id']   = $request->contest;
            $data['img']       = 'images/'.$imageName;
            $data['invoice_id']   = $request->invoice_id;
            $data['user_id']   = $request->user_id;
            $data['fin_price']   = $request->fin_price;
            $data['win_type']   = $request->win_type;
            $data['status']   = $request->status;
            $new_order = Order::Create($data);
            return redirect(route('tours.finish',$new_order->id))->with([
                'message' => 'تم تسجيل الإشتراك بنجاح',
                'alert_type' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
                'message' => 'برجاء التأكد من إدخال البيانات المطلوبة',
                'alert_type' => 'danger'
            ]);
        }
    }
    public function finish($id)
    {
        if(!empty($id)){
            $order = Order::find($id);
            $contest = Contest::find($order->contest_id);
            if(!empty($order)){
                return view('front.tours.finish',['order'=>$order,'contest' => $contest]);
            }
        }
    }


    public function check()
    {
        $contests = Contest::where(['status' => 'publish'])->orderBy('id','DESC')->get()->all();
        return view('front.tours.check',['contests' => $contests]);
    }
    
    public function details(Request $request)
    {
        
        $order = Order::where(['user_name' => $request->user_name])->get()->first();
        if(!empty($order)){
            $contest = Contest::where(['id' => $order->contest_id])->get()->first();
            return view('front.tours.details',['order' => $order,'contest' => $contest]);

        }else{
            return abort(404);
        }
    }
    public function add_comment(Request $request)
    {
        if(!empty($request->tour_id)){
        if(empty($request->parent)){
            $request->merge(["parent" => 0]);
        }
        if(empty($request->user_id)){
            $request->merge(["user_id" => 1]);
        }
        $validator = Validator::make($request->all(), [
            'name'     => 'nullable|max:255|min:3',
            'email'    => 'required',
            'comment'    => 'required',
            'tour_id'    => 'required',
            'comment_stars'    => 'nullable',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['comment'] = $request->comment;
        $data['tour_id'] = $request->tour_id;
        $data['status'] = getSetting('user_comment_status');
        $data['parent'] = $request->parent;
        $data['user_id'] = $request->user_id;
        $data['comment_stars'] = $request->comment_stars;
        ContestComment::Create($data);
        return redirect()->back()->with([
            'message' => 'تم اضافة التعليق بنجاح إذا لم يظهر تلقائياً يعنى أنه بحتاج إذن الأدارة فلا تقلق!',
            'alert_type' => 'success'
        ]);
        }else{
            return abort(404);
        }

    }
}