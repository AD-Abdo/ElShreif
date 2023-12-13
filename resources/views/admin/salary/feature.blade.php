@extends('admin.layouts.main')
@php
$active[0] = '';
$active[1] = '';
$active[2] = '';
$active[3] = '';
$active[4] = 'active-page';
$active[5] = '';
$active[6] = '';
$active[7] = '';
$active[8] = '';
$active[9] = '';
$active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'مدخلات النظام الكلية')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'مدخلات النظام الكلية')

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
        @if ($student_count > 0)

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table custom-table m-0">
                            <thead>
                                <tr style="background-color:#1A8E5F">

                                    <th class="text-right " colspan="2">
                                        <form class="row" action="{{ URL::route('admin.salary.feature.post') }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="col-md-7"></div>
                                            <div class="col-md-1">

                                                @if($search != null)
                                                    <a type="submit" class="btn btn-danger" href="{{ URL::route('admin.salary.feature')}}">X</a>
                                                @endif
                                            </div>
                                            <div class="col-md-1">

                                                <button type="submit" class="btn btn-warning"><span class="icon-search"
                                                        style="font-weight: bold;font-size:1rem"></span></button>
                                            </div>
                                            

                                            <div class="col-md-3">
                                                <input type="date" name="search" value="{{ $search }}"
                                                    class="form-control ">

                                            </div>

                                            


                                        </form>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center">المبلغ</th>
                                    <th class="text-center">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($search != null)
                                @if (count($rows) > 0 )
                                    
                                        
                                            <tr>
                                                <td class="text-center">{{ $salary }} جنية</td>
                                                <td class="text-center">{{ $search }}</td>


                                            </tr>
                                           
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            لا توجد مصاريف مضافة حاليا
                                        </td>
                                    </tr>
                                @endif
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            يجب اختيار التاريخ أولا
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            
        @else
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center">عفوا لا يمكن رؤية مصاريف الطلاب قبل تسجيل الطلاب على النظام
                        </div>
                    </div>

                </div>
            </div>
        @endif

    </div>
@endsection
