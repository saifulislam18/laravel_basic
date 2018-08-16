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
            width: 50%;
            margin: 20px 50px;
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
    </style>
@stop

@section('content')

    <div class="breadcrumb-section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href=""> <i class="fa fa-home"></i> Home</a>
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
        <h4>Add New {{$dirName}}</h4>

        @if(Session::has('s_msg'))
            <p class="alert alert-success msg">{{session('s_msg')}}</p>
        @endif

        @if(Session::has('f_msg'))
            <p class="alert alert-danger msg">{{session('f_msg')}}</p>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



    <?php

        $controller=$dirName."\\".$dirName."Controller";

        $formInfo=array(
            'action'=>$controller."@store",
        );
        $formBuilder=new \App\Http\Lib\FormBuilder($formInfo);

        $fieldArr=array(
            'name'=>[
                'type'=>'text',
                'required'=>1
            ],
            'type'=>[
                'type'=>'select',
                'value'=>['category'=>'Category','tag'=>"Tag"],
                'required'=>1
            ]
        );

        if (count($errors)>0){
            $keyArr= array_keys($fieldArr);
            foreach ($keyArr as $key){
                if ($errors->first($key)){
                    $fieldArr[$key]['msg']=$errors->first($key);
                }
            }
        }

        foreach ($fieldArr as $key=>$value){
            $formBuilder->createField($key,$value);
        }

        $submitArr=array('class'=>'btn btn-primary');
        $formBuilder->submit($submitArr);

        ?>
    </div>
</div>
    

@endsection

@push('scripts')
    @include('admin.inc.msg')
@endpush

