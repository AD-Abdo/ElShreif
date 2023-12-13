@extends('admin.layouts.main')
@php
    $active[0] = '';
    $active[1] = '';
    $active[2] = 'active-page';
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
@section('title', 'اضافة طالب')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'اضافة طالب')

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
        @if ($rows_count > 0)
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">اضافة طالب جديد</div>
                    </div>
                    <form class="card-body" action="{{ URL::route('admin.students.store') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-group ">

                            @include('admin.students.form')
                            <div class="row mt-4">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success w-100">اضافة</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        @else
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center">يجب اضافة الصفوف قبل البدء فى اضافة الطلاب</div>
                    </div>

                </div>
            </div>
        @endif


    </div>
@endsection
@push('js')
@endpush
