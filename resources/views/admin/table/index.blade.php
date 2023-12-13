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
@section('title', 'كل الجداول')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'كل الجداول')

@push('css')
    <style>
        input {
            border-radius: 100px !important;
            box-shadow: 0 0 20px #1A8E5F;
        }

    </style>
@endpush
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
        <div class="col-md-12 mb-4">
            <form class="row" action="{{ URL::route('admin.table.search') }}" method="POST">
                @csrf
                @method('POST')
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="text" class="form-control w-100" value="{{ $search }}" name="search"
                        placeholder="ابحث بعنوان الجدول">
                </div>
                <div class="col-md-4"></div>


            </form>
        </div>


        @if (count($rows) > 0)


            @foreach ($rows as $row)
                <div class="card-deck col-md-3">
                    <div class="card ">
                        <img class="card-img-top" width="100%" src="{{ URL::asset('table/' . $row->image) }}"
                            alt="{{ $row->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $row->title }}</h5>
                            <p class="card-text">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted">{{ $row->date }}</small>
                                </div>
                                <div class="col-md-6 table">
                                    <div class="td-actions">


                                        <a href="{{ URL::route('admin.table.show', $row->id) }}" class="icon blue"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="عرض بيانات الجدول">
                                            <i class="icon-eye"></i>
                                        </a>
                                        @if (Auth::user()->role == 1)
                                            <a href="{{ URL::route('admin.table.edit', $row->id) }}"
                                                class="icon green" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="تعديل بيانات الجدول">
                                                <i class="icon-pencil"></i>
                                            </a>
                                            <form action="{{ URL::route('admin.table.destroy', $row->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="icon bg-secondary text-light delete"
                                                    data-toggle="tooltip" data-target="tooltip" data-placement="top"
                                                    title="حذف بيانات الجدول" data-original-title="حذف بيانات الجدول">
                                                    <i class="icon-cancel"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card-deck text-center col-md-12">
                <p class="text-center w-100" style="font-size: .8rem">
                    لا يوجد جداول مضافة حاليا
                </p>
            </div>
        @endif

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center w-100">
            <div class="text-center w-100">
                {{ $rows->links() }}
            </div>
        </div>

    </div>
@endsection
