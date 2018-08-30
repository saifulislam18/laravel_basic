<?php
$fileName = explode('.', $view);
$dirName = ucfirst($fileName[1]);
$fileName = ucfirst($fileName[2]);

$title = ' - ' . $dirName . ' ' . $fileName;
?>
@extends('admin.layout.admin')
@section('title',$title)
@section('custom-css')
    <style>
        .form {
            width: 100%;
            margin: 10px;
            box-shadow: 1px aliceblue;
            background: #FFFFFF;
        }

        .page {
            background: #F3EEED;
        }

        .content-heading {
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

            $controller = $dirName . "\\" . $dirName . "Controller";

            $formInfo = array(
                'action' => $controller . "@store",
            );
            $formBuilder = new \App\Http\Lib\FormBuilder($formInfo);

            $row = "<div class='row'> <div class='col-md-7'>";



            $formBuilder::rawInput($row);

            $fieldArr = array(
                'title' => [
                    'type' => 'text',
                    'required' => 1
                ],
                'content' => [
                    'type' => 'textarea',
                    'required' => 1,
                ],
                'excerpt' => [
                    'type' => 'textarea',
                ]
            );

            if (count($errors) > 0) {
                $keyArr = array_keys($fieldArr);
                foreach ($keyArr as $key) {
                    if ($errors->first($key)) {
                        $fieldArr[$key]['msg'] = $errors->first($key);
                    }
                }
            }

            foreach ($fieldArr as $key => $value) {
                $formBuilder->createField($key, $value);
            }
            $row = "</div><div class='col-md-5'>";

            $formBuilder::rawInput($row);

            $postDetails = <<<PANEL
<div class="card text-white bg-primary" style="width: 100%">
  <h2 style="padding: 10px">Post Details</h2>
</div>
PANEL;
            $formBuilder::rawInput($postDetails);

            $fieldArr = array(
                'status' => [
                    'label_place' => 'Post Status',
                    'type' => 'select',
                    'value' => ['publish' => 'Published', 'draft' => 'Draft', 'pending' => 'Pending']
                ],

            );

            if (count($errors) > 0) {
                $keyArr = array_keys($fieldArr);
                foreach ($keyArr as $key) {
                    if ($errors->first($key)) {
                        $fieldArr[$key]['msg'] = $errors->first($key);
                    }
                }
            }

            foreach ($fieldArr as $key => $value) {
                $formBuilder->createField($key, $value);
            }?>

            <div class="input-group">
               <span class="input-group-btn">
                 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-default">
                   <i class="fa fa-picture-o"></i> Choose thumbnail
                 </a>
               </span>
                <input id="thumbnail" class="form-control" type="text" name="path">
            </div>

            <img id="holder" style="margin-top:15px;max-height:100px;">

            @if(count($categories)>0)
            <div class='form-group'>

                <h4>Category</h4>


                @foreach($categories as  $category)
                    <input type="checkbox" value="<?php echo $category->id?>" name="category[]"><?php echo $category->name?>
                @endforeach

            </div>
            @endif

            @if(count($tags)>0)
            <div class='form-group'>
                <h4>Tags</h4>

                @foreach($tags as  $tag)
                    <input type="checkbox" value="<?php echo $tag->id?>" name="tags[]"><?php echo $tag->name?>
                @endforeach

            </div>
            @endif

            <div class='form-group'>
                <label for="featured"> Featured Post</label>
                <input id="featured" type="checkbox" value="1" name="featured">Featured
            </div>


            <?php
            $seoDetails = <<<PANEL
<div class="card text-white bg-danger" style="width: 100%">
  <h2 style="padding: 10px">SEO Content</h2>
</div>
PANEL;
            $formBuilder::rawInput($seoDetails);

            $fieldArr = array(
                'meta_description' => [
                    'label_place'=>'Meta Description',
                    'input_place'=>'Meta Description',
                    'type' => 'textarea',
                ],
                'meta_keywords' => [
                    'label_place'=>'Meta Keywords',
                    'input_place'=>'Meta Keywords',
                    'type' => 'textarea',
                ],
                'seo_title' => [
                    'label_place'=>'Seo Title',
                    'input_place'=>'Seo Title',
                    'type' => 'text',
                ]
            );

            if (count($errors) > 0) {
                $keyArr = array_keys($fieldArr);
                foreach ($keyArr as $key) {
                    if ($errors->first($key)) {
                        $fieldArr[$key]['msg'] = $errors->first($key);
                    }
                }
            }

            foreach ($fieldArr as $key => $value) {
                $formBuilder->createField($key, $value);
            }

            $submitArr = array('class' => 'btn btn-primary', 'wrapper' => '</div>');
            $formBuilder->submit($submitArr);

            ?>
        </div>
    </div>
@endsection

@push('scripts')
@include('admin.inc.msg')

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('content', options);
</script>

<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>

@endpush

