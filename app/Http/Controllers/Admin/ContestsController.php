<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Contest;
use App\Models\ContestTypes;
use App\Models\TourOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:contest-list|contest-create|contest-edit|contest-delete|contest-forcedelete,admin', ['only' => ['index','store']]);
        $this->middleware('permission:contest-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:contest-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:contest-delete,admin', ['only' => ['destroy','destroy_all']]);
        $this->middleware('permission:contest-forcedelete,admin', ['only' => ['archive','restore','restore_all']]);
    }

    public function index()
    {
        //
        $pages = Contest::orderBy('id','DESC')->paginate(admin_paginate());
        return view('admin.contests.index',['pages'=>$pages]);
    }

    public function archive()
    {
        //
        $pages = Contest::onlyTrashed()->orderBy('id','DESC')->paginate(admin_paginate());
        return view('admin.contests.archive',['pages'=>$pages]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if(!empty($search)){
            $pages = Contest::orderBy('id','DESC')
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->paginate(100);
            return view('admin.contests.index',['pages'=>$pages]);
        }else{
            return redirect()->route('admin.contests.index')->with([
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
        $categories = ContestTypes::all();
        return view('admin.contests.create',['categories' => $categories]);
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
        $request->merge(["admin_id" => auth()->guard('admin')->user()->id]);
        $valid_data = [
            'slug'    => 'required|unique:contests,slug',
            'image'    => 'nullable',
            'from_date'    => 'nullable',
            'to_date'    => 'nullable',
            'label_color'    => 'nullable',
            'price'    => 'required',
            'status'    => 'required',
            'contest_id'    => 'required',
            //'comments_status'    => 'nullable',
            'num_of'    => 'nullable',
            'admin_id'    => 'required',
        ];

        foreach (config('translatable.languages') as $key => $value) {
            $valid_data[$key.'*.title'] = 'required|max:255|min:3|required';
            $valid_data[$key.'*.content'] =  'nullable';
            $valid_data[$key.'*.description'] =  'nullable';
            $valid_data[$key.'*.label_text'] =  'nullable';
        }

        $validator = Validator::make($request->all(), $valid_data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach (config('translatable.languages') as $key => $value) {
            $data[$key]['title'] = $request->$key['title'];
            $data[$key]['content'] = $request->$key['content'];
            $data[$key]['description'] = $request->$key['description'];
            $data[$key]['label_text'] = $request->$key['label_text'];
        }


        $data['slug'] = $request->slug;
        $data['image'] = $request->image;
        $data['from_date'] = $request->from_date;
        $data['to_date'] = $request->to_date;
        $data['price'] = $request->price;
        $data['label_color'] = $request->label_color;
        $data['status'] = $request->status;
        $data['contest_type_id'] = $request->contest_id;
        $data['num_of'] = $request->num_of;
        $data['admin_id'] = $request->admin_id;

        $post = Contest::Create($data);

        return redirect()->route('admin.contests.index')->with([
            'message' => trans('admin/tour.messages.created'),
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
        $page = Contest::find($id);
        return view('admin.contests.show',['page' => $page]);
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
        $tour = Contest::find($id);
        $categories = ContestTypes::all();
        return view('admin.contests.edit',['tour' => $tour,'categories' => $categories]);
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
        $valid_data = [
            'slug'    => 'required|unique:contests,slug,'.$id.'id',
            'image'    => 'nullable',
            'from_date'    => 'nullable',
            'to_date'    => 'nullable',
            'price'    => 'required',
            'label_color'    => 'nullable',
            'status'    => 'required',
            'contest_id'    => 'required',
            'num_of'    => 'nullable',
        ];

        foreach (config('translatable.languages') as $key => $value) {
            $valid_data[$key.'*.title'] = 'required|max:255|min:3|required';
            $valid_data[$key.'*.content'] =  'nullable';
            $valid_data[$key.'*.description'] =  'nullable';
            $valid_data[$key.'*.label_text'] =  'nullable';
        }

        $validator = Validator::make($request->all(), $valid_data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
//        dd($request->all());
        $page = Contest::find($id);

        foreach (config('translatable.languages') as $key => $value) {
            $page->translate($key)->title = $request->$key['title'];
            $page->translate($key)->content = $request->$key['content'];
            $page->translate($key)->description = $request->$key['description'];
            $page->translate($key)->label_text = $request->$key['label_text'];
        }

        $page->slug = $request->slug;
        $page->image = $request->image;
        $page->from_date = $request->from_date;
        $page->to_date = $request->to_date;
        $page->price = $request->price;
        $page->label_color = $request->label_color;
        $page->status = $request->status;
        $page->contest_type_id = $request->contest_id;
        $page->num_of = $request->num_of;
        $page->admin_id = $page->admin_id;
//        dd($data);

        $page->save();

        return redirect()->route('admin.contests.index')->with([
            'message' => trans('admin/tour.messages.edited',['page' => $page->title]),
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
        $item = Contest::withTrashed()->find($id);
        if($item->trashed()){
            $item->forceDelete();
            return redirect()->route('admin.contests.archive')->with([
                'message' => trans('admin/tour.messages.deleted'),
                'alert_type' => 'success'
            ]);
        }else{
            $item->delete();
            return redirect()->route('admin.contests.index')->with([
                'message' => trans('admin/tour.messages.deleted'),
                'alert_type' => 'success'
            ]);
        }
    }

    public function restore($id)
    {
        //
        Contest::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.contests.archive')->with([
            'message' => trans('admin/tour.messages.restored'),
            'alert_type' => 'success'
        ]);
    }


    public function restore_all(Request $request){
        $ids = $request->ids;
        if(empty($ids)){
            return redirect(route('admin.contests.archive'));
        }
        if(is_array($ids)){
            foreach ($ids as $id){
                Contest::onlyTrashed()->where('id', $id)->restore();
            }
        }else{
            //News::onlyTrashed()->find($ids)->restore();
        }
        return redirect()->route('admin.contests.archive')->with([
            'message' => trans('admin/tour.messages.restored_selected'),
            'alert_type' => 'success'
        ]);

    }
    public function destroy_all(Request $request)
    {
        //
        $ids = $request->ids;
        if(empty($ids)){
            return redirect()->route('admin.contests.index')->with([
                'message' => trans('admin/tour.messages.delete_empty'),
                'alert_type' => 'danger'
            ]);
        }
        if(is_array($ids)){
            Contest::destroy($ids);
        }else{
            Contest::find($ids)->delete();
        }
        return redirect()->route('admin.contests.index')->with([
            'message' => trans('admin/tour.messages.deleted_selected'),
            'alert_type' => 'success'
        ]);

    }
}
