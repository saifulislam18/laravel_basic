<?php

namespace App\Http\Controllers\Post;

use App\Admin;
use App\Model\File;
use App\Model\Post;
use App\Model\Seo;
use App\Term\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view='admin.post.index';
        return view($view,compact('view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Term::where(['type'=>'category'])->get();
        $tags=Term::where(['type'=>'tag'])->get();
        $view='admin.post.create';
        return view($view,compact('view','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id=Auth::guard('admin')->id();

        $user=Admin::findOrFail($user_id);


        $data= $request->all();

        unset($data['path']);
        unset($data['meta_description']);
        unset($data['meta_keywords']);
        unset($data['seo_title']);

        $data['user_id']=$user_id;

        if ($request->get('category')){
            $data['category']=implode(',',$data['category']);
        }
        if ($request->get('tag')){
            $data['tag']=implode(',',$data['tag']);
        }



        $id=$user->posts()->save(new Post($data))->id;

        $post=Post::findOrFail($id);

        $seoData['description']=$request->get('meta_description')??strip_tags(substr($data['content'],0,120));
        $seoData['keywords']=$request->get('meta_keywords')??'';
        $seoData['title']=$request->get('seo_title')??$data['title'];

        $post->seos()->save(new Seo($seoData));

        if ($request->get('path')){
            $fileData['type']='thumbnail';
            $fileData['path']=$request->get('path');
            $post->files()->save(new File($fileData));
        }

        if ($id){
            Session::flash('s_msg',"Posts created succefully");
            return redirect()->back();
        }else{
            Session::flash('f_msg',"Posts not created");
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view='admin.post.view';
        $post=Post::withTrashed()
            ->where('id', $id)
            ->get()
            ->first();
        return view($view,compact('view','post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories=Term::where(['type'=>'category'])->get();
        $tags=Term::where(['type'=>'tag'])->get();

        $admin_id=Auth::guard('admin')->id();
        $role=Auth::guard('admin')->user()->role_id;
        $post=Post::withTrashed()
            ->where('id', $id)
            ->get()
            ->first();

        if (1==$role || $post->user_id == $admin_id){
            $view='admin.post.edit';
            return view($view,compact('view','post','categories','tags'));
        }
        return redirect()->back();
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
        $admin_id=Auth::guard('admin')->id();
        $role=Auth::guard('admin')->user()->role_id;

        $post=Post::findOrFail($id);

        if (1==$role || $post->user_id == $admin_id){
            $data= $request->all();

            $data['featured']=$data['featured']??0;

            unset($data['path']);
            unset($data['meta_description']);
            unset($data['meta_keywords']);
            unset($data['seo_title']);

            if ($request->get('category')){
                $data['category']=implode(',',$data['category']);
            }
            if ($request->get('tag')){
                $data['tag']=implode(',',$data['tag']);
            }

            if ($post->update($data)) {

                $seoData['description']=$request->get('meta_description')??strip_tags(substr($data['content'],0,120));
                $seoData['keywords']=$request->get('meta_keywords')??'';
                $seoData['title']=$request->get('seo_title')??$data['title'];

                $post->seos()->whereId($id)->update($seoData);

                if ($request->get('path')){
                    $fileData['type']='thumbnail';
                    $fileData['path']=$request->get('path');

                    $post->files()->whereId($id)->update($fileData);
                }


                Session::flash('s_msg', "Post Updated");
            } else {
                Session::flash('f_msg', "Post Not Updated");
            }
            return redirect()->back();

        }
        return redirect()->back();
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function trash(){
        $view='admin.post.trash';
        return view($view,compact('view'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $action=request()->get('action');

        $admin_id=Auth::guard('admin')->id();
        $role=Auth::guard('admin')->user()->role_id;
        $post=Post::withTrashed()
            ->where('id', $id)
            ->get()
            ->first();

        if (1==$role || $post->user_id == $admin_id){

            if ($action=='trash'){
                if ($post->delete()){
                    Session::flash('s_msg',"$post->name trashed success");
                }else{
                    Session::flash('f_msg',"$post->name trashed failed");
                }
            }else{
                if ($post->forceDelete()){
                    Session::flash('s_msg',"$post->name deleted success");
                }else{
                    Session::flash('f_msg',"$post->name deleted failed");
                }
            }
            return redirect()->back();
        }
        return redirect()->back();
    }


    public function destroyMultiple()
    {
        $role=Auth::guard('admin')->user()->role_id;
        if (1==$role){
            $ids= request()->get('multiple');
            Post::withTrashed()->whereIn('id',$ids)->get()->each->forceDelete();
            Session::flash('s_msg',"multiple post permanatly deleted successfully");
        }
        return redirect()->back();
    }


    public function trashMultiple()
    {
        $role=Auth::guard('admin')->user()->role_id;
        if (1==$role){
            $ids= request()->get('multiple');
            Post::destroy($ids);
            Session::flash('s_msg',"multiple post trashed success");
        }
        return redirect()->back();
    }

    public function recoverMultiple()
    {
        $role=Auth::guard('admin')->user()->role_id;
        if (1==$role){
            $ids= request()->get('multiple');
            Post::withTrashed()->whereIn('id',$ids)->get()->each->restore();
            Session::flash('s_msg',"multiple post recoverd success");
        }
        return redirect()->back();
    }

    /**
     * @return return all listing of the resource with json api.
     */

    public function postDataListApi($status=null){

        DB::statement(DB::raw('set @rownum=0'));

        if ($status=='trash'){
            $posts = Post::with('user')->onlyTrashed()->get([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'posts.*']);
        }else{
            $posts = Post::with('user')->get([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'posts.*']);
        }

        return datatables()->of($posts)
            ->addColumn('multiple', '<input name="multiple[]" type="checkbox" class="checkbox" value="{{$id}}" />')
            ->addColumn('user', function (Post $post){
                return $post->user->name??'';
            })
            ->addColumn('content', function (Post $post){
                return substr($post->content,0,50)."...";
            })
            ->addColumn('category', function (Post $post){
                $category=$post->category;
                $ids=explode(',',$category);
                if ($ids){
                    $terms=Term::select('name')->find($ids);
                    $termName='';
                    foreach ($terms as $term){
                        $termName.="$term->name<br>";
                    }
                    return $termName;
                }else{
                    return $category;
                }
            })
            ->addColumn('thumbnail', function (Post $post){
                $files=$post->files;

                foreach ($files as $thumbnail){
                    $img="<img src='$thumbnail->path' height='100' width='100'/>";
                }
                return $img??null;
            })
            ->addColumn('action', function (Post $post){

                $admin_id=Auth::guard('admin')->id();
                $role=Auth::guard('admin')->user()->role_id;

                if ($admin_id==$post->user_id || 1==$role){
                    $edit='<div class="action-separate">
                                <a title="Edit" href="'.route('post.edit',$post->id).'" class="btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>Edit
                                </a>
                           </div>';

                    if ($post->deleted_at){
                        $delete = '<div class="action-separate">
                                <form action="'.route('post.destroy',$post->id).'" method="post" style="display: inline">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="_method" value="DELETE">    
                                    <button title="Delete" type="submit" class="btn btn-sm btn-danger delete_permanently">
                                        <i class="fa fa-trash"></i>Delete
                                    </button>
                                </form>
                           </div>';
                    }else{
                        $delete = '<div class="action-separate">
                                <form action="'.route('post.destroy',$post->id).'" method="post" style="display: inline">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="action" value="trash">
                                    <button title="Delete" type="submit" class="btn btn-sm btn-danger delete">
                                        <i class="fa fa-trash"></i>Trash
                                    </button>
                                </form>
                           </div>';
                    }


                }
                $edit=$edit??false;
                $delete=$delete??false;



                return '
                        <div class="action-separate">
                               <a title="View" href="'.route('post.show',$post->id).'" class="btn btn-sm btn-info">
                                  <i class="fa fa-eye"></i>View
                               </a>
                        </div>
                '.$edit.$delete;
            })
            ->rawColumns(['multiple','action','content','category','thumbnail'])
            ->make(true);

    }
}