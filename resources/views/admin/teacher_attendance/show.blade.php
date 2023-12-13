@extends('admin.layouts.main')
@php
    $active[0] = '';
    $active[1] = '';
    $active[2] = '';
    $active[3] = '';
    $active[4] = '';
    $active[5] = '';
    $active[6] = '';
    $active[7] = '';
    $active[8] = 'active-page';
    $active[9] = '';
    $active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'عرض بيانات حضور المدرس')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'عرض بيانات حضور المدرس')

<!-- Content -->
@section('content')
    <div class="row gutters">

        @if (Session::has('success'))
            <div class="card p-1 col-md-12 bg-success message">
                <div class="card-body p-1 row" class="bg-success">
                    <div class="col-md-12  text-light">{{ Session::get('success') }}</div>
                </div>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="card p-1 col-md-12 bg-primary message">
                <div class="card-body p-1 row" class="bg-primary">
                    <div class="col-md-12  text-light">{{ Session::get('error') }}</div>
                </div>
            </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">عرض بيانات حضور المدرس : {{ $row->Teacher->name }}</div>
                </div>
                <form class="card-body" action="" method="POST">
                    @csrf
                    @method('post')

                    @include('admin.teacher_attendance.form')

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <a href="{{ URL::route('admin.teacher_attendance.index') }}" class="btn btn-info w-100">عودة</a>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>





                </form>
            </div>
        </div>



    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('#teacher').val('{{ $row->teacher_id }}').attr('disabled','disabled');
            $('#salary').val('{{ $row->salary }}').attr('disabled','disabled');
            $('#comment').val('{{ $row->comment }}').attr('disabled','disabled');
        });
    </script>
@endpush
