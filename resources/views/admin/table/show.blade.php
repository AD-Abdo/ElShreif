@extends('admin.layouts.main')
@php
    $active[0] = '';
    $active[1] = '';
    $active[2] = '';
    $active[3] = '';
    $active[4] = '';
    $active[5] = 'active-page';
    $active[6] = '';
    $active[7] = '';
    $active[8] = '';
    $active[9] = '';
    $active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'عرض بيانات جدول : ' . $row->title)

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'عرض بيانات جدول : ' . $row->title)

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
                <div class="card-header row no-print">
                    <div class="col-md-6">
                        <div class="card-title">عرض بيانات جدول : {{ $row->title }}</div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3 text-right">
                        <button onclick="window.print();" onfocus="window.print()"
                            class="btn btn-info "><span style="font-weight: bold;font-size: 1rem"
                                class="icon-print"></span></button>
                        <a href="{{ URL::route('admin.table.index') }}" class="btn btn-primary "><span
                                style="font-weight: bold;font-size: 1rem" class="icon-arrow-left"></span></a>
                    </div>
                </div>
                <form class="card-body">
                    @csrf
                    @method('post')
                    <div class="form-group ">


                        <div class="print" style="display: none">
                            <div class="row text-center ">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 text-center">
                                    <img class="text-center logo-wrapper" width="100px"
                                        src="{{ URL::asset('assets/img/logo.png') }}" style="">
                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                        </div>
                        <div class="row  mt-3">

                            <div class="col-sm-12 ">
                                <img class="w-100" src="{{ URL::asset('table/' . $row->image) }}"
                                    alt="{{ $row->title }}">
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>



    </div>
@endsection
