<?php
use App\Term\Term;$fileName=explode('.',$view);
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
                <th>Title</th>
                <td></td>
                <td>{{$post->title}}</td>
            </tr>
            <tr>
                <th>Content</th>
                <td></td>
                <td>{!! $post->content !!}</td>
            </tr>

            <tr>
                <th>Author:</th>
                <td></td>
                <td>{{$post->user->name}}</td>
            </tr>

            <tr>
                <th>Category:</th>
                <td></td>
                <td>
                    <?php
                        $category=$post->category;
                        $ids=explode(',',$category);
                        if ($ids){
                            $terms=Term::select('name')->find($ids);

                            foreach ($terms as $term){
                                echo "$term->name<br>";
                            }
                        }
                    ?>

                </td>
            </tr>

            <tr>
                <th>Tag:</th>
                <td></td>
                <td>
                    <?php
                    $tag=$post->tag;
                    $ids=explode(',',$tag);
                    if ($ids){
                        $terms=Term::select('name')->find($ids);

                        foreach ($terms as $term){
                            echo "$term->name<br>";
                        }
                    }
                    ?>

                </td>
            </tr>

            <tr>
                <th>Thumbnail:</th>
                <td></td>
                <td>
                    <?php
                    $files=$post->files;
                        foreach ($files as $thumbnail){
                           echo $img="<img src='$thumbnail->path' height='300' width='300'/>";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th>Status:</th>
                <td></td>
                <td>{{$post->status}}</td>
            </tr>

            <tr>
                <th>Is Featured:</th>
                <td></td>
                <td>{{$post->featured?'Yes':'No'}}</td>
            </tr>



            <tr>
                <th>Meta Description:</th>
                <td></td>
                <td>{{$post->seos->description}}</td>
            </tr>

            <tr>
                <th>Meta Keywords:</th>
                <td></td>
                <td>{{$post->seos->keywords}}</td>
            </tr>

            <tr>
                <th>SEO Title:</th>
                <td></td>
                <td>{{$post->seos->title}}</td>
            </tr>


            <tr>
                <th>Created At:</th>
                <td></td>
                <td>{{$post->created_at->toDateString()}}</td>
            </tr>
            <tr>
                <th>Last Updated At:</th>
                <td></td>
                <td>{{$post->updated_at->toDateString()}}</td>
            </tr>
        </table>


        <a href="{{route('term.index')}}" class="btn btn-info">View {{$dirName}} List</a>


    </div>
</div>
    

@endsection

@push('scripts')
    @include('admin.inc.msg')
@endpush

