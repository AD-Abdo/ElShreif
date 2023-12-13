@extends('admin.layouts.main')
@php
    $active[0] = '';
    $active[1] = 'active-page';
    $active[2] = '';
    $active[3] = '';
    $active[4] = '';
    $active[5] = '';
    $active[6] = '';
    $active[7] = '';
    $active[8] = '';
    $active[9] = '';
    $active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'تعديل صف : '.$row->name)

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'تعديل صف : '.$row->name))

<!-- Content -->
@section('content')
    <div class="row gutters">
        @if ($errors->any())
            <div class="card p-1 col-md-12 bg-secondary message">
                <div class="card-body p-1 row" class="bg-secondary">
                    <div class="col-md-12  text-light">{{ $errors->first('name') }}</div>
                </div>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="card p-1 col-md-12 bg-success message">
                <div class="card-body p-1 row" class="bg-success">
                    <div class="col-md-12  text-light">{{ Session::get('success') }}</div>
                </div>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="card p-1 col-md-12 bg-secondary message">
                <div class="card-body p-1 row" class="bg-secondary">
                    <div class="col-md-12  text-light">{{ Session::get('error') }}</div>
                </div>
            </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">تعديل صف : {{ $row->name }}</div>
                </div>
                <form class="card-body" action="{{ URL::route('admin.rows.update',$row->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">

                        @include('admin.rows.form')
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success w-100">تعديل</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>



    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('#name').val("{{ $row->name }}");
        });
    </script>
    

    
@endpush
