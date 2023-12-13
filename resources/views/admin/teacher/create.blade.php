@extends('admin.layouts.main')
@php
    $active[0] = '';
    $active[1] = '';
    $active[2] = '';
    $active[3] = '';
    $active[4] = '';
    $active[5] = '';
    $active[6] = '';
    $active[7] = 'active-page';
    $active[8] = '';
    $active[9] = '';
    $active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'اضافة بيانات المدرس')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'اضافة بيانات المدرس')

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
        @if ($subject_count > 0)
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">اضافة بيانات مدرس جديد</div>
                    </div>
                    <form class="card-body" action="{{ URL::route('admin.teacher.store') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="form-group row">

                            @include('admin.teacher.form')
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-success w-100">اضافة</button>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="row">
                                <div class="col-md-1  message pl-3 pr-3 mt-1 ">
                                </div>
                                <div class="col-md-3  message pl-3 pr-3 mt-1 ">
                                    @if ($errors->has('name'))
                                        <div class="text-light text-center bg-secondary pt-2 pb-2">
                                            {{ $errors->first('name') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-1  message pl-3 pr-3 mt-1 ">
                                </div>
                                <div class="col-md-3  message pl-3 pr-3 mt-1 ">
                                    @if ($errors->has('subject'))
                                        <div class="text-light text-center bg-secondary pt-2 pb-2">
                                            {{ $errors->first('subject') }}</div>
                                    @endif
                                </div>
                                <div class="message col-sm-4"></div>
                            </div>
                        @endif




                    </form>
                </div>
            </div>
        @else
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center">يجب اضافة المواد الدراسية قبل البدء فى اضافة المدرسين</div>
                    </div>

                </div>
            </div>
        @endif


    </div>
@endsection
@push('js')
@endpush
