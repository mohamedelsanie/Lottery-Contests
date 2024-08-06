<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuLinks;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Contest;
use App\Models\ContestTypes;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:menu-edit,admin', ['only' => ['index','store','create','store','addCatToMenu','addPostToMenu','addCustomLink','edit','updateMenu','updateMenuItem','deleteMenuItem','edit','updateMenu','updateMenuItem','deleteMenuItem','destroy']]);
    }
    public function index(){
        $the_id = isset($_GET['id']) ? $_GET['id'] : '';
        $menuitems = '';
        $desiredMenu = '';
        if(isset($_GET['id']) && $_GET['id'] != 'new'){
            $id = $_GET['id'];
            $desiredMenu = Menu::where('id',$id)->first();
            if($desiredMenu->content != ''){
                $menuitems = json_decode($desiredMenu->content);
                $menuitems = $menuitems[0];
                foreach($menuitems as $menu){
                    $menu->title = MenuLinks::find(['id',$menu->id])->value('title');
                    $menu->name = MenuLinks::find(['id',$menu->id])->value('name');
                    $menu->slug = MenuLinks::find(['id',$menu->id])->value('slug');
                    $menu->target = MenuLinks::find(['id',$menu->id])->value('target');
                    $menu->type = MenuLinks::find(['id',$menu->id])->value('type');
                    if(!empty($menu->children[0])){
                        foreach ($menu->children[0] as $child) {
                            $child->title = MenuLinks::find(['id',$child->id])->value('title');
                            $child->name = MenuLinks::find(['id',$child->id])->value('name');
                            $child->slug = MenuLinks::find(['id',$child->id])->value('slug');
                            $child->target = MenuLinks::find(['id',$child->id])->value('target');
                            $child->type = MenuLinks::find(['id',$child->id])->value('type');
                        }
                    }
                }

                //dd($menuitems);
            }else{
                $menuitems = MenuLinks::where('menu_id',$desiredMenu->id)->get();
            }
        }else{
            $desiredMenu = Menu::orderby('id','DESC')->first();
            if($desiredMenu){
                if($desiredMenu->content != ''){
                    $menuitems = json_decode($desiredMenu->content);
                    $menuitems = $menuitems[0];
                    foreach($menuitems as $menu){
                        $menu->title = MenuLinks::find(['id',$menu->id])->value('title');
                        $menu->name = MenuLinks::find(['id',$menu->id])->value('name');
                        $menu->slug = MenuLinks::find(['id',$menu->id])->value('slug');
                        $menu->target = MenuLinks::find(['id',$menu->id])->value('target');
                        $menu->type = MenuLinks::find(['id',$menu->id])->value('type');
                        if(!empty($menu->children[0])){
                            foreach ($menu->children[0] as $child) {
                                $child->title = MenuLinks::find(['id',$child->id])->value('title');
                                $child->name = MenuLinks::find(['id',$child->id])->value('name');
                                $child->slug = MenuLinks::find(['id',$child->id])->value('slug');
                                $child->target = MenuLinks::find(['id',$child->id])->value('target');
                                $child->type = MenuLinks::find(['id',$child->id])->value('type');
                            }
                        }
                    }
                }else{
                    $menuitems = MenuLinks::where('menu_id',$desiredMenu->id)->get();
                }
            }
        }
        return view ('admin.menus.index',['categories'=>NewsCategory::all(),'tour_categories'=>ContestTypes::all(),'posts'=>News::where(['status' => 'publish'])->orderBy('id','DESC')->get(),'tours'=>Contest::where(['status' => 'publish'])->orderBy('id','DESC')->get(),'menus'=>Menu::all(),'desiredMenu'=>$desiredMenu,'menuitems'=>$menuitems,'the_id'=>$the_id]);
    }

    public function store(Request $request){
//        dd('ss');
        $data = $request->all();
        if(Menu::create($data)){
            $newdata = Menu::orderby('id','DESC')->first();

            return redirect()->route('admin.menus.index')->with([
                'message' => trans('admin/menu.messages.created'),
                'alert_type' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
                'message' => trans('admin/menu.messages.created'),
                'alert_type' => 'danger'
            ]);
        }
    }

    public function addCatToMenu(Request $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::find($menuid);
        if($menu->content == ''){
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = NewsCategory::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = NewsCategory::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = NewsCategory::find(['id',$id])->value('slug');
                }
                $data['type'] = 'category';
                $data['target'] = '';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
        }else{
            $olddata = json_decode($menu->content,true);
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = NewsCategory::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = NewsCategory::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = NewsCategory::find(['id',$id])->value('slug');
                }
                $data['type'] = 'category';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = NewsCategory::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = NewsCategory::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = NewsCategory::find(['id',$id])->value('slug');
                }
                $array['name'] = NULL;
                $array['type'] = 'category';
                $array['target'] = NULL;
                $array['id'] = MenuLinks::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->value('id');
                $array['children'] = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $menu->update(['content'=>$olddata]);
            }
        }
    }

    public function addToursCatToMenu(Request $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::find($menuid);
        if($menu->content == ''){
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = ContestTypes::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = ContestTypes::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = ContestTypes::find(['id',$id])->value('slug');
                }
                $data['type'] = 'tour_category';
                $data['target'] = '';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
        }else{
            $olddata = json_decode($menu->content,true);
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = ContestTypes::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = ContestTypes::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = ContestTypes::find(['id',$id])->value('slug');
                }
                $data['type'] = 'tour_category';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = ContestTypes::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = ContestTypes::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = ContestTypes::find(['id',$id])->value('slug');
                }
                $array['name'] = NULL;
                $array['type'] = 'tour_category';
                $array['target'] = NULL;
                $array['id'] = MenuLinks::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->value('id');
                $array['children'] = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $menu->update(['content'=>$olddata]);
            }
        }
    }

    public function addTourToMenu(Request $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::find($menuid);
        if($menu->content == ''){
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = Contest::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = Contest::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = Contest::find(['id',$id])->value('slug');
                }
                $data['type'] = 'contest';
                $data['target'] = '';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
        }else{
            $olddata = json_decode($menu->content,true);
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = Contest::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = Contest::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = Contest::find(['id',$id])->value('slug');
                }
                $data['type'] = 'contest';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = Contest::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = Contest::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = Contest::find(['id',$id])->value('slug');
                }
                $array['name'] = NULL;
                $array['type'] = 'contest';
                $array['target'] = NULL;
                $array['id'] = MenuLinks::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $menu->update(['content'=>$olddata]);
            }
        }
    }

    public function addPostToMenu(Request $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::find($menuid);
        if($menu->content == ''){
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = News::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = News::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = News::find(['id',$id])->value('slug');
                }
                $data['type'] = 'post';
                $data['target'] = '';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
        }else{
            $olddata = json_decode($menu->content,true);
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = News::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = News::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = News::find(['id',$id])->value('slug');
                }
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                MenuLinks::create($data);
            }
            foreach($ids as $id){
                foreach (config('translatable.languages') as $key => $value) {
                    $data[$key]['title'] = News::find(['id',$id])->value('title:'.$key);
                    $data[$key]['name'] = News::find(['id',$id])->value('title:'.$key);
                    $data[$key]['slug'] = News::find(['id',$id])->value('slug');
                }
                $array['name'] = NULL;
                $array['type'] = 'post';
                $array['target'] = NULL;
                $array['id'] = MenuLinks::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $menu->update(['content'=>$olddata]);
            }
        }
    }

    public function addCustomLink(Request $request){

        $data = $request->all();
        $menuid = $request->menuid;
        $menu = Menu::find($menuid);
//        dd($data);
        if($menu != null){
            if($menu->content == ''){
                $data['ar']['title'] = $request->link_ar;
                $data['ar']['slug'] = $request->url_ar;
                $data['en']['title'] = $request->link_en;
                $data['en']['slug'] = $request->url_en;
                $data['type'] = 'custom';
                $data['menu_id'] = $menuid;
                $data['order'] = '0';
                MenuLinks::create($data);
            }else{
                $olddata = json_decode($menu->content,true);
                $data['ar']['title'] = $request->link_ar;
                $data['ar']['slug'] = $request->url_ar;
                $data['en']['title'] = $request->link_en;
                $data['en']['slug'] = $request->url_en;
                $data['type'] = 'custom';
                $data['menu_id'] = $menuid;
                $data['order'] = '0';
                MenuLinks::create($data);
                $array = [];
                $array['ar']['title'] = $request->link_ar;
                $array['ar']['slug'] = $request->url_ar;
                $array['en']['title'] = $request->link_en;
                $array['en']['slug'] = $request->url_en;
                $array['name'] = NULL;
                $array['type'] = 'custom';
                $array['target'] = NULL;
//                dd($array);
                $array['id'] = MenuLinks::where('type',$array['type'])->orderby('id','DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $menu->update(['content'=>$olddata]);
            }
        }
        return redirect()->back()->with([
            'message' => trans('admin/menu.messages.added_item'),
            'alert_type' => 'success'
        ]);

    }

    public function updateMenu(Request $request){
        $newdata = $request->all();
        $menu=Menu::find($request->menuid);
        $content = $request->data;
        $newdata = [];
        foreach (config('translatable.languages') as $key => $value) {
            $newdata[$key]['location'] = $request->location;
            if(LaravelLocalization::getCurrentLocale() == $key){
                $newdata[$key]['content'] = json_encode($content);
            }


        }
        $menu->update($newdata);
//        dd(route('admin.menus.index',['id=' =>$menu->id]));

        return redirect()->route('admin.menus.index',['id=' =>$menu->id])->with([
            'message' => trans('admin/menu.messages.updated'),
            'alert_type' => 'success'
        ]);
    }

    public function updateMenuItem(Request $request){
        $data = $request->all();
        $item = MenuLinks::find($request->id);
        $item->update($data);
        return redirect()->back()->with([
            'message' => trans('admin/menu.messages.updated_item'),
            'alert_type' => 'success'
        ]);
    }

    public function deleteMenuItem($id,$key,$in=''){


        foreach (config('translatable.languages') as $key => $value) {

        }
        $menuitem = MenuLinks::find($id);
        $menu = Menu::where('id',$menuitem->menu_id)->first();
        if($menu->content != ''){
            $data = json_decode($menu->content,true);
            $maindata = $data[0];
            if($in == ''){
                unset($data[0][$key]);
                $newdata = json_encode($data);
                $menu->update(['content'=>$newdata]);
            }else{
                unset($data[0][$key]['children'][0][$in]);
                $newdata = json_encode($data);
                $menu->update(['content'=>$newdata]);
            }
        }
        $menuitem->delete();

        return redirect()->back()->with([
            'message' => trans('admin/menu.messages.deleted_item'),
            'alert_type' => 'success'
        ]);
    }

    public function destroy(Request $request){
        MenuLinks::where('menu_id',$request->id)->delete();
        Menu::find($request->id)->delete();
        return redirect()->route('admin.menus.index')->with([
            'message' => trans('admin/menu.messages.deleted'),
            'alert_type' => 'success'
        ]);
    }
}
