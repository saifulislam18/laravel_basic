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


    <form  id="selectionForm" action="{{route('admin.multidisable')}}" method="post">

        @csrf

            <div style="padding: 20px">
                <div class="row">
                    <div class="col-md-1" style="margin: 0px 10px 0 0">
                        <input class="btn  btn-warning btn-sm" type="submit" id="disableMultipleButton" value="Disabled Multiple">
                    </div>

                    <div class="col-md-1" style="margin: 0px 15px 0 25px">
                        <input class="btn  btn-success btn-sm" type="submit" id="enableMultipleButton" value="Enable Multiple">
                    </div>

                    <div class="col-md-1" style="margin: 0px 0px 0 10px">
                        <input class="btn  btn-danger btn-sm" type="submit" id="deleteMultipleButton" value="Delete Multiple">
                    </div>
                </div>
            </div>

        @endif

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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
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
                ajax: '{{ route('admin.datalist') }}',
                columns: [
                        @if(Auth::guard('admin')->user()->role_id==1)
                            {data: 'multiple', orderable: false},
                        @endif
                    {data: 'rownum'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name:'role'},
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

        $(document).on('click', '.disable', function() {
            return confirm('are you sure to disabled the account?')
        });

        $(document).on('click', '.enable', function() {
            return confirm('are you sure to enabled the account?')
        });

        $(document).on('click', '.delete', function() {
            return confirm('are you sure to delete the account?')
        });
        function checkEmptySelection(){
            emptySelection =true;
            $('.checkbox').each(function(){
                if(this.checked)   emptySelection = false;
            });
            return emptySelection;
        }

        $("#disableMultipleButton").click(function(){
            if(checkEmptySelection()){
                alert("Empty Selection! Please select some record(s) first")
                return false;
            }else{

                $("#selectionForm").submit();

            }
        }) ;

        $("#enableMultipleButton").click(function(){
            if(checkEmptySelection()){
                alert("Empty Selection! Please select some record(s) first")
                return false;
            }else{
                $("#selectionForm").attr('action','{{route('admin.multienable')}}')
                $("#selectionForm").submit();

            }
        }) ;

        $("#deleteMultipleButton").click(function(){
            if(checkEmptySelection()){
                alert("Empty Selection! Please select some record(s) first")
                return false;
            }else{
                $("#selectionForm").attr('action','{{route('admin.multidelete')}}')
                $("#selectionForm").submit();

            }
        }) ;

    });
</script>
@endif
@endpush