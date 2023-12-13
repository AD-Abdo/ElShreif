@extends('admin.layouts.main')
@php
$active[0] = '';
$active[1] = '';
$active[2] = '';
$active[3] = 'active-page';
$active[4] = '';
$active[5] = '';
$active[6] = '';
$active[7] = '';
$active[8] = '';
$active[9] = '';
$active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'كل حضور الطلاب')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'كل حضور الطلاب')

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

    </div>
    <div class="row gutters">
        @if (Session::has('error'))
            <div class="card p-1 col-md-12 bg-danger message">
                <div class="card-body p-1 row" class="bg-danger">
                    <div class="col-md-12  text-light">{{ Session::get('error') }}</div>
                </div>
            </div>
        @endif

    </div>
    @if ($student_count > 0)
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table custom-table m-0">
                        <thead>
                            <tr>

                                <th class="text-right " colspan="7">
                                    <form class="row"
                                        action="{{ URL::route('admin.student_attendance.attendance') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <input type="text" id="id" class="form-control w-100" name="id"
                                                placeholder="اقرء باركود الطالب" autofocus style="border-radius: 100px">
                                        </div>
                                        <div class="col-md-2"></div>




                                    </form>
                                </th>
                            </tr>
                            <tr style="background-color:#1A8E5F">

                                <th class="text-right " colspan="7">
                                    <form class="row"
                                        action="{{ URL::route('admin.student_attendance.search') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="col-md-4"></div>
                                        <div class="col-md-1">
                                            @if ($search != null || $id != null)
                                                <a href="{{ URL::route('admin.student_attendance.index') }}"
                                                    class="btn btn-danger">X</a>
                                            @endif
                                        </div>
                                        <button type="submit" for="search"
                                            class="col-md-1 btn btn-info text-light">ابحث</button>

                                        <div class="col-md-3">
                                            <input type="date" id="search" class="form-control w-100"
                                                value="{{ $search }}" name="search" placeholder="اختر تاريخ البحث">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="id" class="form-control w-100"
                                                value="{{ $id }}" name="id" placeholder="ادخل رقم الطالب او اسم الطالب">
                                        </div>



                                    </form>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">م</th>
                                <th class="text-center">اسم الطالب</th>
                                <th class="text-center">صف الطالب</th>
						<th class="text-center">ملاحظات</th>
                                <th class="text-center">تاريخ الحضور</th>
                                <th class="text-center">اسم القائم بالحضور</th>
                                <th class="text-right">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($rows) > 0)
                                @php $i = 1; @endphp
                                @foreach ($rows as $row)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $row->Student->name }} </td>
                                        <td class="text-center">{{ $row->Student->Row->name }}</td>
@if(!$row->Student->getSalary )
<td class="text-center bg-danger" style="color:#fff">{{ $row->Student->getSalary
							? $row->Student->getSalary->notes ? $row->Student->getSalary->notes : "-"  : 'لم يدفع المصاريف حتي الان'   }}</td>
@else
<td class="text-center">{{ $row->Student->getSalary
							? $row->Student->getSalary->notes ? $row->Student->getSalary->notes : "-"  : 'لم يدفع المصاريف حتي الان'   }}</td>
@endif
							
                                        <td class="text-center">{{ $row->date }}</td>
                                        <td class="text-center">{{ $row->User->name }} (
                                            {{ $row->User->role == 1 ? 'مدير النظام' : 'مشرف للنظام' }} )</td>

                                        <td>
                                            <div class="td-actions">

                                                @if (Auth::user()->role == 1)
                                                    <form
                                                        action="{{ URL::route('admin.student_attendance.destroy', $row->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="icon bg-secondary text-light delete"
                                                            data-toggle="tooltip" data-target="tooltip" data-placement="top"
                                                            title="حذف بيانات حضور الطالب"
                                                            data-original-title="حذف بيانات حضور الطالب">
                                                            <i class="icon-cancel"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                            </div>
                                        </td>


                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">
                                        لا يوجد اى حضور مضاف حاليا
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center w-100">
                <div class="text-center w-100">
                    {{ $rows->links() }}
                </div>
            </div>

        </div>
    @else
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center">لا يمكن تحضير الطلاب قبل تسجيلهم على النظام</div>
                </div>

            </div>
        </div>
    @endif
@endsection
