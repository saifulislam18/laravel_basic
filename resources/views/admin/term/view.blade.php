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
                    <a href="{{route('term.index')}}"> {{$dirName}} List</a>
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
                <th>Term Name:</th>
                <td></td>
                <td>{{$term->name}}</td>
            </tr>
            <tr>
                <th>Term Type:</th>
                <td></td>
                <td>{{$term->type}}</td>
            </tr>
            <tr>
                <th>Created By:</th>
                <td></td>
                <td>{{$term->user->name}}</td>
            </tr>
            <tr>
                <th>Created At:</th>
                <td></td>
                <td>{{$term->created_at->toDateString()}}</td>
            </tr>
            <tr>
                <th>Last Updated At:</th>
                <td></td>
                <td>{{$term->updated_at->toDateString()}}</td>
            </tr>
        </table>


        <a href="{{route('term.index')}}" class="btn btn-info">View {{$dirName}} List</a>


    </div>
</div>
    

@endsection

@push('scripts')
    @include('admin.inc.msg')
@endpush

