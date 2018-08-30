<?php
$fileName = explode('.', $view);
$dirName = ucfirst($fileName[1]);

$title = ' - ' . $dirName . ' List';
?>

@extends('admin.layout.admin')
@section('title',$title)
@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <style>
        .data-table-custom {
            margin: 10px;
        }

        .content-heading {
            background: #00030e;
            color: #f3f3f3;
            padding: 5px;

        }
        .action-separate{
            display: inline;
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
                <li class="breadcrumb-item active" aria-current="page">{{$dirName}} List</li>
            </ol>
        </nav>
    </div>

    <div class="content-heading">
        <h2 class="text-center">{{$dirName}} List</h2>
    </div>

    @if(Auth::guard('admin')->user()->role_id==1)


    <form  id="selectionForm" action="{{route('post.trashmultiple')}}" method="post">

        @csrf
        @endif

        <div style="padding: 20px">
                <div class="row">
                    @if(Auth::guard('admin')->user()->role_id==1)
                        <div class="col-md-1" style="margin: 0px 10px 0 0">
                            <input class="btn  btn-danger btn-sm" type="submit" id="trashMultipleButton" value="Trashed Multiple">
                        </div>
                    @endif
                        <div class="col-md-1" style="margin: 0px 0px 0 20px">
                            <a href="{{route('post.trash')}}" class="btn  btn-info btn-sm">View Trash List</a>
                        </div>
                </div>
        </div>



        @if(Session::has('s_msg'))
            <p class="alert alert-success msg">{{session('s_msg')}}</p>
        @endif

        @if(Session::has('f_msg'))
            <p class="alert alert-danger msg">{{session('f_msg')}}</p>
        @endif

        <div class="data-table-custom">

            <table class="table table-striped table-bordered" style="width:100%" id="table">
                <thead>
                <tr>
                    @if(Auth::guard('admin')->user()->role_id==1)
                        <th>
                            {!! Form::checkbox(null,null,false,['id'=>'select_all']) !!}
                        </th>
                    @endif
                        <th>SL</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Thumbnail</th>
                        <th>Author</th>
                        <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>

        @if(Auth::guard('admin')->user()->role_id==1)
            </form>
        @endif

@endsection

@push('scripts')
@include('admin.inc.msg')
<script>

    $(document).ready(function () {
        $(function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('post.datalist') }}',
                columns: [
                    @if(Auth::guard('admin')->user()->role_id==1)
                    {data: 'multiple', orderable: false},
                    @endif
                    {data: 'rownum'},
                    {data: 'title', name: 'title'},
                    {data: 'content', name: 'content'},
                    {data: 'category', name: 'category'},
                    {data: 'thumbnail'},
                    {data: 'user'},
                    {data: 'action'}
                ]
            });
        });
    });

</script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


@if(Auth::guard('admin')->user()->role_id==1)

<script>
    $(document).ready(function () {
        $("#select_all").change(function(){  //"select all" change
            var status = this.checked; // "select all" checked status
            $('.checkbox').each(function(){ //iterate all listed checkbox items
                this.checked = status; //change ".checkbox" checked status
            });
        });


        $(document).on('change', '.checkbox', function() {
            if(this.checked == false){
                $("#select_all")[0].checked = false;
            }
            if ($('.checkbox:checked').length == $('.checkbox').length ){
                $("#select_all")[0].checked = true;
            }
        });

        $(document).on('click', '.delete', function() {
            return confirm('are you sure to delete the post?');
        });
        function checkEmptySelection(){
            emptySelection =true;
            $('.checkbox').each(function(){
                if(this.checked)   emptySelection = false;
            });
            return emptySelection;
        }

        function confirmation() {
            return confirm('Are You Sure To Trash The Selected Rows?');
        }

        $("#trashMultipleButton").click(function(){
            if(checkEmptySelection()){
                alert("Empty Selection! Please select some record(s) first")
                return false;
            }else{

                if (confirmation()){
                    $("#selectionForm").submit();
                }else {
                    event.preventDefault();
                }
            }
        }) ;
    });
</script>

@endif

@endpush