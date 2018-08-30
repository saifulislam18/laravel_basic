<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        if (count(Role::all())==0){
            $roleName=['adminstrator','editor','author','subscriber'];
            foreach ($roleName as $value){
                $role['role_name']=$value;
                Role::create($role);
            }
        }
        if (count(Admin::all())==0){
            $admin['name']='Msi';
            $admin['username']=strtolower('msisaiful');
            $admin['role_id']=1;
            $admin['email']='msisaifulsaif@gmail.com';
            $admin['password']=Hash::make('123456');
            $admin['status']='active';
            Admin::create($admin);
        }

        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
    public function create()
    {
        $view='admin.user.create';
        $roles=Role::pluck('role_name','id')->all();

        return view($view,compact('roles','view'));
    }
    public function adminCreate(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:admins|max:255',
            'email' => 'required|unique:admins|max:255',
            'password' => 'required|min:6',
        ]);

        $is_inserted=Admin::create([
            'name' => $request['name'],
            'username'=>$request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role_id'=>$request['role_id'],
            'status'=>'active'
        ]);

        if ($is_inserted){
            Session::flash('s_msg',"Admins created succefully");
            return redirect()->back();
        }else{
            Session::flash('f_msg',"Admins not created");
            return redirect()->back();
        }
    }
    public function adminList()
    {
        $view='admin.user.index';
        return view($view,compact('view'));
    }
    public function adminView($id){
        $view='admin.user.view';
        $admin=Admin::findOrFail($id);
        return view($view,compact('view','admin'));
    }
    public function adminEdit($id){

        $admin_id=Auth::guard('admin')->id();
        if ($admin_id == $id){
            $view='admin.user.edit';
            $admin=Admin::findOrFail($id);
            $roles=Role::pluck('role_name','id')->all();
            return view($view,compact('view','admin','roles'));
        }
        return redirect()->back();
    }
    public function adminUpdate(Request $request,$id){
        $admin_id=Auth::guard('admin')->id();
        if ($admin_id == $id){
            $admin=Admin::findOrFail($id);

            $data=$request->all();
            if ($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $fileName=time()."@title".$file->getClientOriginalName();
                $destinationPath = 'avatar';
                $file->move($destinationPath,$fileName);
                $data['avatar']=$fileName;
            }

            if ($admin->update($data)){
                Session::flash('s_msg',"Profile Updated");
            }else{
                Session::flash('f_msg',"Profile Not Updated");
            }
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function adminDisable($id){
        if (Auth::guard('admin')->user()->role_id==1){
            $admin=Admin::findOrFail($id);
            $admin->status='disable';

            if ($admin->save()){
                Session::flash('s_msg',"$admin->name disabled success");
            }else{
                Session::flash('f_msg',"$admin->name disabled failed");
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function adminMultiDisable(Request $request){
        if (Auth::guard('admin')->user()->role_id==1){

            $ids= $request->multiple;
            foreach ($ids as $id){
                $admin=Admin::findOrFail($id);
                $admin->status='disable';
                $isDisable=$admin->save();
            }

            if ($isDisable){
                Session::flash('s_msg',"multiple user disabled success");
            }else{
                Session::flash('f_msg',"multiple user disabled failed");
            }
            return redirect()->back();
        }
        return redirect()->back();

    }

    public function adminEnable($id){
        if (Auth::guard('admin')->user()->role_id==1){
            $admin=Admin::findOrFail($id);
            $admin->status='active';

            if ($admin->save()){
                Session::flash('s_msg',"$admin->name enabled success");
            }else{
                Session::flash('f_msg',"$admin->name enabled failed");
            }

            return redirect()->back();
        }
        return redirect()->back();
    }
    public function adminMultiEnable(Request $request){
        if (Auth::guard('admin')->user()->role_id==1){

            $ids= $request->multiple;

            foreach ($ids as $id){
                $admin=Admin::findOrFail($id);
                $admin->status='active';
                $isEnable=$admin->save();
            }

            if ($isEnable){
                Session::flash('s_msg',"multiple user enabled success");
            }else{
                Session::flash('f_msg',"multiple user enabled failed");
            }
            return redirect()->back();
        }
        return redirect()->back();

    }


    public function adminDelete($id){



        if (Auth::guard('admin')->user()->role_id==1){
            $admin=Admin::findOrFail($id);

            if ($admin->delete()){
                Session::flash('s_msg',"$admin->name deleted success");
            }else{
                Session::flash('f_msg',"$admin->name deleted failed");
            }

            return redirect()->back();
        }
        return redirect()->back();
    }

    public function adminMultiDelete(Request $request){
        if (Auth::guard('admin')->user()->role_id==1){

            $ids= $request->multiple;

            foreach ($ids as $id){
                $admin=Admin::findOrFail($id);
                $isDeleted=$admin->delete();
            }

            if ($isDeleted){
                Session::flash('s_msg',"multiple user deleted success");
            }else{
                Session::flash('f_msg',"multiple user deleted failed");
            }
            return redirect()->back();
        }
        return redirect()->back();
    }



    public function adminDataListApi(){

        DB::statement(DB::raw('set @rownum=0'));
        $admins = Admin::with('role')->get([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'admins.*']);



        return datatables()->of($admins)
            ->addColumn('multiple', '<input name="multiple[]" type="checkbox" class="checkbox" value="{{$id}}" />')
            ->addColumn('role', function (Admin $admin){
                return $admin->role->role_name;
            })
            ->addColumn('action', function (Admin $admin){
                if ($admin->status=='active'){
                    $status=
                        '<a title="Disable" href="'.route('admin.disable',$admin->id).'"  class="btn btn-sm btn-warning disable">
                                <i class="fa fa-ban"></i>Disable
                        </a>'
                    ;
                }else{
                    $status= '<a title="Enable" href="'.route('admin.enable',$admin->id).'" class="btn btn-sm btn-success enable">
                                <i class="fa fa-align-right"></i>Enable
                        </a>';
                }
                $status.= '<a title="Delete" href="'.route('admin.delete',$admin->id).'" class="btn btn-sm btn-danger delete">
                                <i class="fa fa-trash"></i>Delete
                        </a>';

                $admin_id=Auth::guard('admin')->id();


                if ($admin->id==$admin_id){
                    $edit= '<a title="Edit" href="'.route('admin.edit',$admin->id).'" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>Edit
                        </a>';
                }else{
                    $edit=false;
                }

                if (Auth::guard('admin')->user()->role_id!=1){
                    $status=false;
                }



                return $edit.'
                        <a title="View" href="'.route('admin.view',$admin->id).'" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i>View
                        </a><div style="margin: 5px"></div>'.
                            $status;
            })
            ->rawColumns(['multiple','action'])
            ->make(true);

    }
}
