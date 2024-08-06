<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Contest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:order-list|order-create|order-edit|order-delete|order-forcedelete,admin', ['only' => ['index','store']]);
        $this->middleware('permission:order-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:order-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:order-delete,admin', ['only' => ['destroy','destroy_all']]);
        $this->middleware('permission:order-forcedelete,admin', ['only' => ['archive','restore','restore_all']]);
    }

    public function index()
    {
        //
        $pages = Order::orderBy('id','DESC')->paginate(admin_paginate());
        return view('admin.orders.index',['pages'=>$pages]);
    }
    
    public function contests()
    {
        //
        $pages = Contest::orderBy('id','DESC')->paginate(admin_paginate());
        return view('admin.orders.contests',['pages'=>$pages]);
    }
    
    
    public function contests_orders($id)
    {
        //
        $pages = Order::orderBy('id','DESC')->where(['contest_id' => $id])->paginate(admin_paginate());
        $contest_id = $id;
        return view('admin.orders.contests_orders',['pages'=>$pages,'contest_id' => $contest_id]);
    }

    public function archive()
    {
        //
        $pages = Order::onlyTrashed()->orderBy('id','DESC')->paginate(admin_paginate());
        return view('admin.orders.archive',['pages'=>$pages]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if(!empty($search)){
            $pages = Order::orderBy('id','DESC')
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->paginate(100);
            return view('admin.orders.index',['pages'=>$pages]);
        }else{
            return redirect()->route('admin.orders.index')->with([
                'message' => trans('admin/common.messages.search_error'),
                'alert_type' => 'danger'
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $tours = Contest::all();
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
        return view('admin.orders.create',['users' => $users,'tours' => $tours,'user_name' => $user_name,'invoice' => $invoice]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->merge(["user_id" => 1]);
        $validator = Validator::make($request->all(), [
            'title'     => 'required|max:255|min:3|required',
            'name'    => 'required',
            'phone'    => 'nullable',
            'adress'    => 'nullable',
            'contest_id'    => 'nullable',
            'user_name'    => 'required',
            'img'    => 'nullable',
            'invoice_id'    => 'nullable',
            'win_type'    => 'nullable',
            'user_id '    => 'nullable',
            'status'    => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(!empty($request->contest_id)){
            $tour_obj = Contest::find($request->contest_id);
            $price = $tour_obj->price;
            $total = $price;
        }

        $data['title'] = $request->title;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['adress'] = $request->adress;
        $data['contest_id'] = $request->contest_id;
        $data['user_name'] = $request->user_name;
        $data['img'] = $request->img;
        $data['invoice_id'] = $request->invoice_id;
        $data['win_type'] = $request->win_type;
        $data['status'] = $request->status;
        $data['fin_price'] = $total;
        $data['user_id'] = $request->user_id;

        $all_winners = Order::where(['contest_id' => $request->contest_id,'win_type' => 'winner'])->pluck('id')->all();
        
        if(!empty($all_winners)){
            if(count($all_winners) >= 1 and $request->win_type == 'winner'){
                return redirect()->back()->with([
                    'message' => trans('admin/order.messages.win_error'),
                    'alert_type' => 'danger'
                ]);
            }
        }
        Order::Create($data);

        return redirect()->route('admin.orders.index')->with([
            'message' => trans('admin/order.messages.created'),
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $page = Order::find($id);
        return view('admin.orders.show',['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $page = Order::find($id);
        $tours = Contest::all();
        $user_name = 'EGY-';
        $user_name .= substr(uniqid(mt_rand(0,10), false),0);
        $orders = Order::pluck('user_name')->all();
        if(in_array($user_name, $orders)) {
            $user_name = $user_name.'d';
        }
        if(empty($page->invoice_id)){
            $page->invoice_id = "#".$id;
        }
        return view('admin.orders.edit',['page' => $page,'tours' => $tours,'user_name' => $user_name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $validator = Validator::make($request->all(), [
            'title'     => 'required|max:255|min:3|required',
            'name'    => 'required',
            'phone'    => 'nullable',
            'adress'    => 'nullable',
            'contest_id'    => 'nullable',
            'user_name'    => 'required',
            'img'    => 'nullable',
            'invoice_id'    => 'nullable',
            'win_type'    => 'nullable',
            'user_id '    => 'nullable',
            'status'    => 'required',
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
//        dd($request->all());
        $page = Order::find($id);
        $total = 0;
        
        if(!empty($request->contest_id)){
            $tour_obj = Contest::find($request->contest_id);
            $price = $tour_obj->price;
            $total = $price;
        }

        
        $page->title = $request->title;
        $page->name = $request->name;
        $page->phone = $request->phone;
        $page->adress = $request->adress;
        $page->contest_id = $request->contest_id;
        $page->user_name = $request->user_name;
        $page->img = $request->img;
        $page->invoice_id = $request->invoice_id;
        $page->win_type = $request->win_type;
        $page->fin_price = $total;
        //$page->user_id = $request->user_id;
        $page->status = $request->status;
//        dd($data);

        $all_winners = Order::where(['contest_id' => $page->contest_id,'win_type' => 'winner'])->pluck('id')->all();
        //dd($all_winners);
        if(!empty($all_winners)){
            if(count($all_winners) >= 1 and $page->win_type == 'winner'){
                return redirect()->back()->with([
                    'message' => trans('admin/order.messages.win_error'),
                    'alert_type' => 'danger'
                ]);
            }
        }
        $page->save();

        return redirect()->route('admin.orders.index')->with([
            'message' => trans('admin/order.messages.edited',['page' => $page->title]),
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
        $item = Order::withTrashed()->find($id);
        if($item->trashed()){
            $item->forceDelete();
            return redirect()->route('admin.orders.archive')->with([
                'message' => trans('admin/order.messages.deleted'),
                'alert_type' => 'success'
            ]);
        }else{
            $item->delete();
            return redirect()->route('admin.orders.index')->with([
                'message' => trans('admin/order.messages.deleted'),
                'alert_type' => 'success'
            ]);
        }
    }

    public function restore($id)
    {
        //
        Order::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.orders.archive')->with([
            'message' => trans('admin/order.messages.restored'),
            'alert_type' => 'success'
        ]);
    }


    public function restore_all(Request $request){
        $ids = $request->ids;
        if(empty($ids)){
            return redirect(route('admin.orders.archive'));
        }
        if(is_array($ids)){
            foreach ($ids as $id){
                Order::onlyTrashed()->where('id', $id)->restore();
            }
        }else{
            //News::onlyTrashed()->find($ids)->restore();
        }
        return redirect()->route('admin.orders.archive')->with([
            'message' => trans('admin/order.messages.restored_selected'),
            'alert_type' => 'success'
        ]);

    }
    public function destroy_all(Request $request)
    {
        //
        $ids = $request->ids;
        if(empty($ids)){
            return redirect()->route('admin.orders.index')->with([
                'message' => trans('admin/order.messages.delete_empty'),
                'alert_type' => 'danger'
            ]);
        }
        if(is_array($ids)){
            Order::destroy($ids);
        }else{
            Order::find($ids)->delete();
        }
        return redirect()->route('admin.orders.index')->with([
            'message' => trans('admin/order.messages.deleted_selected'),
            'alert_type' => 'success'
        ]);

    }
    public function approve($id)
    {
        //
        $page = Order::find($id);
        $page->status = 'payed';
        $page->save();
        return redirect()->back()->with([
            'message' => trans('admin/order.messages.edited',['page' => $page->title]),
            'alert_type' => 'success'
        ]);
    }
    
    public function winner($id)
    {
        //
        $page = Order::find($id);
        $all_winners = Order::where(['contest_id' => $page->contest_id,'win_type' => 'winner'])->pluck('id')->all();
        
        if(!empty($all_winners)){
            if(count($all_winners) >= 1 and $page->win_type == 'winner'){
                return redirect()->back()->with([
                    'message' => trans('admin/order.messages.win_error'),
                    'alert_type' => 'danger'
                ]);
            }
        }
        $page->win_type = 'winner';
        $page->save();
        return redirect()->back()->with([
            'message' => trans('admin/order.messages.edited',['page' => $page->title]),
            'alert_type' => 'success'
        ]);
    }
    
    public function export()
    {
        $data = Order::orderBy('id','DESC')->select('user_name','name', 'phone','adress','contest_id','fin_price','win_type','status')->get()->all();
        //$data = json_decode(json_encode(Order::orderBy('id','DESC')->select('user_name','name', 'phone','adress','contest_id','fin_price','win_type','status')->get()), True);
        function cleanData(&$str)
        {
            if ($str == 't') $str = 'TRUE';
            if ($str == 'f') $str = 'FALSE';
            if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str) || preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$str)) {
                $str = " $str";
            }
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        // filename for download
        $filename = "Orders_" . date('Y_m_d') . ".csv";

        //dd($data);

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: text/csv");

        $out = fopen("php://output", 'w');
        fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

        $flag = false;
        foreach ($data as $row) {
            //dd($row);
            if (!$flag) { 
                // display field/column names as first row 
                //fputcsv($out, ['User Name','Name','Phone','Adress','Contest ID','Fee','Win Type','Status']);
                fputcsv($out, ['إسم المستخدم','إسم العميل','رقم الهاتف','العنوان','اسم المسابقة','رسم الإشتراك','حالة الفوز','حالة الدفع'], ';', ' ');
                $flag = true;
            }
            //array_walk($row, __NAMESPACE__ . '\cleanData');
            fputcsv($out, [$row->user_name,$row->name,$row->phone,$row->adress,$row->contest->title,$row->fin_price,$row->Win(),$row->St()], ';', ' ');
            //fputcsv($out, array_values($row));
            //fputcsv($out, array($row->user_name,$row->name,$row->phone,$row->adress,$row->contest_id,$row->fin_price,$row->win_type,$row->status));
        }

        fclose($out);
        /*
        return redirect()->back()->with([
            'message' => trans('admin/order.messages.downloaded'),
            'alert_type' => 'success'
        ]);
        */
        
    }
    
    public function contest_export($id)
    {
        
        $data = Order::orderBy('id','DESC')->select('user_name','name', 'phone','adress','contest_id','fin_price','win_type','status')->where(['contest_id' => $id])->get()->all();
        //$data = json_decode(json_encode(Order::orderBy('id','DESC')->select('user_name','name', 'phone','adress','contest_id','fin_price','win_type','status')->get()), True);
        function cleanData(&$str)
        {
            if ($str == 't') $str = 'TRUE';
            if ($str == 'f') $str = 'FALSE';
            if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str) || preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$str)) {
                $str = " $str";
            }
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        // filename for download
        $filename = "Orders_" . date('Y_m_d') . ".csv";

        //dd($data);

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: text/csv");

        $out = fopen("php://output", 'w');
        fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

        $flag = false;
        foreach ($data as $row) {
            //dd($row);
            if (!$flag) { 
                // display field/column names as first row 
                //fputcsv($out, ['User Name','Name','Phone','Adress','Contest ID','Fee','Win Type','Status']);
                fputcsv($out, ['إسم المستخدم','إسم العميل','رقم الهاتف','العنوان','اسم المسابقة','رسم الإشتراك','حالة الفوز','حالة الدفع'], ';', ' ');
                $flag = true;
            }
            //array_walk($row, __NAMESPACE__ . '\cleanData');
            fputcsv($out, [$row->user_name,$row->name,$row->phone,$row->adress,$row->contest->title,$row->fin_price,$row->Win(),$row->St()], ';', ' ');
            //fputcsv($out, array_values($row));
            //fputcsv($out, array($row->user_name,$row->name,$row->phone,$row->adress,$row->contest_id,$row->fin_price,$row->win_type,$row->status));
        }

        fclose($out);
        /*
        return redirect()->back()->with([
            'message' => trans('admin/order.messages.downloaded'),
            'alert_type' => 'success'
        ]);
        */
    }
}
