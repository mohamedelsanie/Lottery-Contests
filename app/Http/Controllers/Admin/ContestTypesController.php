<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContestTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContestTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:contestcategory-list|contestcategory-create|contestcategory-edit|contestcategory-delete|contestcategory-forcedelete,admin', ['only' => ['index','store']]);
        $this->middleware('permission:contestcategory-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:contestcategory-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:contestcategory-delete,admin', ['only' => ['destroy','destroy_all']]);
        $this->middleware('permission:contestcategory-forcedelete,admin', ['only' => ['archive','restore','restore_all']]);
    }

    public function index()
    {
        //
        $categories = ContestTypes::orderBy('id','DESC')->paginate(admin_paginate());
        $cats = ContestTypes::tree($categories);
        return view('admin.contest_categories.index',['categories'=>$categories,'cats'=>$cats]);
    }

    public function archive()
    {
        //
        $categories = ContestTypes::onlyTrashed()->orderBy('id','DESC')->paginate(admin_paginate());
        return view('admin.contest_categories.archive',['categories'=>$categories]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if(!empty($search)){
            $categories = ContestTypes::orderBy('id','DESC')
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('descraption', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->paginate(100);
            return view('admin.contest_categories.index',['categories'=>$categories]);
        }else{
            return redirect()->route('admin.contest.categories.index')->with([
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
        return view('admin.contest_categories.create',['categories'=>$categories]);
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
            'slug'    => 'required|unique:contest_types,slug',
            'parent'    => 'required',
            'img'    => 'nullable',
            'status'    => 'required',
        ];

        foreach (config('translatable.languages') as $key => $value) {
            $valid_data[$key.'*.title'] = 'required|max:255|min:3|required';
            $valid_data[$key.'*.descraption'] =  'nullable';
        }

        $validator = Validator::make($request->all(), $valid_data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach (config('translatable.languages') as $key => $value) {
            $data[$key]['title'] = $request->$key['title'];
            $data[$key]['descraption'] = $request->$key['descraption'];
        }

        $data['slug'] = $request->slug;
        $data['parent'] = $request->parent;
        $data['img'] = $request->img;
        $data['status'] = $request->status;
        ContestTypes::Create($data);

        return redirect()->route('admin.contest.categories.index')->with([
            'message' => trans('admin/tour_category.messages.created'),
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
        $category = ContestTypes::find($id);
        return view('admin.contest_categories.show',['category' => $category]);
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
        $categories = ContestTypes::all();
        $category = ContestTypes::find($id);
        return view('admin.contest_categories.edit',['category' => $category,'categories'=>$categories]);
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
            'slug'    => 'required|unique:contest_types,slug,'.$id.'id',
            'parent'    => 'required',
            'img'    => 'nullable',
            'status'    => 'required',
        ];

        foreach (config('translatable.languages') as $key => $value) {
            $valid_data[$key.'*.title'] = 'required|max:255|min:3|required';
            $valid_data[$key.'*.descraption'] =  'nullable';
        }
        $validator = Validator::make($request->all(), $valid_data);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
//        dd($request->all());
        $category = ContestTypes::find($id);
        foreach (config('translatable.languages') as $key => $value) {
            $category->translate($key)->title = $request->$key['title'];
            $category->translate($key)->descraption = $request->$key['descraption'];
        }
        $category->slug = $request->slug;
        $category->parent = $request->parent;
        $category->img = $request->img;
        $category->status = $request->status;

        $category->save();

        return redirect()->route('admin.contest.categories.index')->with([
            'message' => trans('admin/tour_category.messages.edited',['category' => $category->title]),
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
        $cats = ContestTypes::all();
        $item = ContestTypes::withTrashed()->find($id);
        if($item->trashed()){
            $item->forceDelete();
            foreach ($cats as $cat){
                ContestTypes::where('parent',$cat->id)->forceDelete();
            }
            return redirect()->route('admin.contest.categories.archive')->with([
                'message' => trans('admin/tour_category.messages.deleted'),
                'alert_type' => 'success'
            ]);
        }else{
            $item->delete();
            foreach ($cats as $cat){
                ContestTypes::where('parent',$cat->id)->delete();
            }
            return redirect()->route('admin.contest.categories.index')->with([
                'message' => trans('admin/tour_category.messages.deleted'),
                'alert_type' => 'success'
            ]);
        }
    }

    public function restore($id)
    {
        //
        ContestTypes::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.contest.categories.archive')->with([
            'message' => trans('admin/tour_category.messages.restored'),
            'alert_type' => 'success'
        ]);
    }


    public function restore_all(Request $request){
        $ids = $request->ids;
        if(empty($ids)){
            return redirect(route('admin.contest.categories.archive'));
        }
        if(is_array($ids)){
            foreach ($ids as $id){
                ContestTypes::onlyTrashed()->where('id', $id)->restore();
            }
        }else{
            //News::onlyTrashed()->find($ids)->restore();
        }
        return redirect()->route('admin.contest.categories.archive')->with([
            'message' => trans('admin/tour_category.messages.restored_selected'),
            'alert_type' => 'success'
        ]);

    }
    public function destroy_all(Request $request)
    {
        //
        $ids = $request->ids;
        if(empty($ids)){
            return redirect()->route('admin.contest.categories.index')->with([
                'message' => trans('admin/tour_category.messages.delete_empty'),
                'alert_type' => 'danger'
            ]);
        }
        if(is_array($ids)){
            ContestTypes::destroy($ids);
        }else{
            ContestTypes::find($ids)->delete();
        }
        return redirect()->route('admin.contest.categories.index')->with([
            'message' => trans('admin/tour_category.messages.deleted_selected'),
            'alert_type' => 'success'
        ]);

    }
}
