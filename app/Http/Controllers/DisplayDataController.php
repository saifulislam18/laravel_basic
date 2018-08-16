<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class DisplayDataController extends Controller
{
    public function index()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $admins = User::all([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'status']);

        return datatables()->of($admins)->make(true);

//        return datatables()->of(User::query())
//            ->addColumn('intro', '<input type="checkbox" value="{{$id}}" />')
//            ->rawColumns(['intro'])
//            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('display');
    }
}
