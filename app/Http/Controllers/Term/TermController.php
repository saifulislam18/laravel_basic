<?php

namespace App\Http\Controllers\Term;

use App\Term\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view='admin.term.index';
        return view($view,compact('view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view='admin.term.create';
        return view($view,compact('view'));
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
        $validatedData = $request->validate([
            'type' => 'required',
            'name' => 'required|max:255',
        ]);
        $validateData['type']=$request->type;
        $validateData['name']=$request->name;
        $recordExist=Term::withTrashed()->where($validateData)->first();

        if ($recordExist){
            Session::flash('f_msg',"Terms already exists");
            return redirect()->back();
        }

        $data=$request->all();
        $data['user_id']=$user_id;
        if (Term::create($data)){
            Session::flash('s_msg',"Terms created succefully");
            return redirect()->back();
        }else{
            Session::flash('f_msg',"Terms not created");
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
        $view='admin.term.view';
        $term=Term::withTrashed()
            ->where('id', $id)
            ->get()
            ->first();
        return view($view,compact('view','term'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin_id=Auth::guard('admin')->id();
        $role=Auth::guard('admin')->user()->role_id;
        $term=Term::withTrashed()
            ->where('id', $id)
            ->get()
            ->first();

        if (1==$role || $term->user_id == $admin_id){
            $view='admin.term.edit';
            return view($view,compact('view','term'));
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

        $term=Term::findOrFail($id);

        if (1==$role || $term->user_id == $admin_id){
            $data = $request->all();

            if ($term->update($data)) {
                Session::flash('s_msg', "Term Updated");
            } else {
                Session::flash('f_msg', "Term Not Updated");
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
        $view='admin.term.trash';
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
        $term=Term::withTrashed()
            ->where('id', $id)
            ->get()
            ->first();

        if (1==$role || $term->user_id == $admin_id){

            if ($action=='trash'){
                if ($term->delete()){
                    Session::flash('s_msg',"$term->name trashed success");
                }else{
                    Session::flash('f_msg',"$term->name trashed failed");
                }
            }else{
                if ($term->forceDelete()){
                    Session::flash('s_msg',"$term->name deleted success");
                }else{
                    Session::flash('f_msg',"$term->name deleted failed");
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
            Term::withTrashed()->whereIn('id',$ids)->get()->each->forceDelete();
            Session::flash('s_msg',"multiple term permanatly deleted successfully");
        }
        return redirect()->back();
    }


    public function trashMultiple()
    {
        $role=Auth::guard('admin')->user()->role_id;
        if (1==$role){
            $ids= request()->get('multiple');
            Term::destroy($ids);
            Session::flash('s_msg',"multiple term trashed success");
        }
        return redirect()->back();
    }

    public function recoverMultiple()
    {
        $role=Auth::guard('admin')->user()->role_id;
        if (1==$role){
            $ids= request()->get('multiple');
            Term::withTrashed()->whereIn('id',$ids)->get()->each->restore();
            Session::flash('s_msg',"multiple term recoverd success");
        }
        return redirect()->back();
    }

    /**
     * @return return all listing of the resource with json api.
     */

    public function termDataListApi($status=null){

        DB::statement(DB::raw('set @rownum=0'));

        if ($status=='trash'){
            $terms = Term::with('user')->onlyTrashed()->get([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'terms.*']);
        }else{
            $terms = Term::with('user')->get([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'terms.*']);
        }


        return datatables()->of($terms)
            ->addColumn('multiple', '<input name="multiple[]" type="checkbox" class="checkbox" value="{{$id}}" />')
            ->addColumn('user', function (Term $term){
                return $term->user->name??'';
            })
            ->addColumn('action', function (Term $term){

                $admin_id=Auth::guard('admin')->id();
                $role=Auth::guard('admin')->user()->role_id;

                if ($admin_id==$term->user_id || 1==$role){
                    $edit='<div class="action-separate">
                                <a title="Edit" href="'.route('term.edit',$term->id).'" class="btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>Edit
                                </a>
                           </div>';

                    if ($term->deleted_at){
                        $delete = '<div class="action-separate">
                                <form action="'.route('term.destroy',$term->id).'" method="post" style="display: inline">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="_method" value="DELETE">    
                                    <button title="Delete" type="submit" class="btn btn-sm btn-danger delete_permanently">
                                        <i class="fa fa-trash"></i>Delete
                                    </button>
                                </form>
                           </div>';
                    }else{
                        $delete = '<div class="action-separate">
                                <form action="'.route('term.destroy',$term->id).'" method="post" style="display: inline">
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
                               <a title="View" href="'.route('term.show',$term->id).'" class="btn btn-sm btn-info">
                                  <i class="fa fa-eye"></i>View
                               </a>
                        </div>
                '.$edit.$delete;
            })
            ->rawColumns(['multiple','action'])
            ->make(true);

    }
}
