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
$active[8] = '';
$active[9] = 'active-page';
$active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'فاتورة المدرس : ' . $teacher->name)

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'فاتورة المدرس : ' . $teacher->name)
@push('css')
    <style>
        @media print {
            .logo-printing{
                display :inline-block !important;
                opacity: 100% !important;
                visibility: visible !important;
            }
            button , a {
                display: none !important;
            }
		.tteacher{
			font-weight:bold !important;
			color: #000 !important
	        }
    </style>
@endpush
<!-- Content -->
@section('content')
    <div class="row gutters">

        <div class="logo-printing col-md-12 mb-3 text-center" style="display: none">
            <div class="row text-center ">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                    <img class="text-center logo-wrapper" width="100px" src="{{ URL::asset('assets/img/logo.png') }}"
                        style="">
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card-header row">
                <div class="col-md-6">
			<form method="post" action="{{ URL::route('admin.fatora.pay') }}">
				@csrf
				@method('post')
				<input type="hidden" value="{{$teacher->id}}" name="teacher">
				<button
                        class="btn btn-success"><span
                            style="font-weight: bold;font-size: 1rem" class="icon-archive1"></span></button>
			</form>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3 text-right">
                    <button onclick="window.print();" onfocus="window.print()"
                        class="btn btn-info "><span style="font-weight: bold;font-size: 1rem"
                            class="icon-print"></span></button>
                    <a href="{{ URL::route('admin.fatora.index') }}" class="btn btn-primary "><span
                            style="font-weight: bold;font-size: 1rem" class="icon-arrow-left"></span></a>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table custom-table m-0">
                        <thead>
                            <tr class="mt-2" style="background-color:#1A8E5F">

                                <th class="text-center text-light tteacher" colspan="5" style="font-siaze:.9rem;font-weight:bold">
                                    فاتورة المدرس : {{ $teacher->name }} - لشهر {{ $month }} - سنة
                                    {{ $year }}
                                    <hr>
                                </th>
                            </tr>
                            
                            <tr>
                                <th class="text-center">م</th>
                                <th class="text-center">تاريخ الحضور</th>
                                <th class="text-center">سعر الحصة</th>
					   <th class="text-center">المرحلة</th>
					  <th class="text-center">الملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($rows) > 0)
                                @php 
                                    $i = 1;
                                    $allSalary = 0; 
                                @endphp
                                @foreach ($rows as $row)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $row->date }}</td>
                                        @if (Auth::user()->role == 1)
                                            <td class="text-center">
                                                {{ $row->salary != null ? $row->salary.' جنية' : 'لا يوجد مبلغ مضاف' }}</td>
                                                @php
                                                    $allSalary = $allSalary + $row->salary;
                                                @endphp
                                        @endif
							<td class="text-center"></td>
						      <td class="text-center">{{ $row->comment }}</td>



                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center" style="font-weight: bold" colspan="5">الحساب الكلى {{ $allSalary }} جنية</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">
                                        هذا المدرس لم يتواجد طول شهر {{ $month }}
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>



        </div>


    </div>
@endsection
