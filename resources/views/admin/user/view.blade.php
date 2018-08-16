<?php
$fileName=explode('.',$view);
$dirName=ucfirst($fileName[1]);
$fileName=ucfirst($fileName[2]);

$title=' - '.$dirName.' '.$fileName;
?>
@extends('admin.layout.admin')
@section('title',$title)
@section('custom-css')
    <style>
        .form {
            width: 100%;
            box-shadow: 1px aliceblue;
            background: #FFFFFF;
        }
        .page{
            background: #F3EEED;
        }
        .content-heading{
            background: #00030e;
            color: #f3f3f3;
            padding: 5px;

        }
        table {
            font-size: 1.2em;
            color: #666;
        }
        tr{
            padding: 10px;
        }
    </style>
@stop

@section('content')

    <div class="breadcrumb-section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href=""> <i class="fa fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('admin.list')}}"> {{$dirName}} List</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$dirName}} {{$fileName}}</li>
            </ol>
        </nav>
    </div>

    <div class="content-heading">
        <h2 class="text-center">{{$dirName}} {{$fileName}}</h2>
    </div>

<div class="form">
    <div class="card-body">
        <h4>{{$dirName}} Details</h4>

        <table class="table table-bordered">
            <tr>
                <th>User Name:</th>
                <td></td>
                <td>{{$admin->name}}</td>
            </tr>
            <tr>
                <th>User Email:</th>
                <td></td>
                <td>{{$admin->email}}</td>
            </tr>
            <tr>
                <th>User Role:</th>
                <td></td>
                <td>{{$admin->role->role_name}}</td>
            </tr>
            <tr>
                <th>User Avatar:</th>
                <td></td>
                <td><img src="{{asset('avatar')."/".$admin->avatar}}" height="100" width="100" alt=""></td>
            </tr>
        </table>


        <a href="{{route('admin.list')}}" class="btn btn-info">View {{$dirName}} List</a>


    </div>
</div>
    

@endsection

@push('scripts')
    @include('admin.inc.msg')
@endpush

