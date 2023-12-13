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
@section('title', 'المصاريف')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'المصاريف')

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

                                    <th class="text-right " colspan="8">
                                        <form class="row" action="{{ URL::route('admin.salary.search') }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            
							 <div class="col-md-3 text-right">
								<a href="{{ URL::route('admin.students.notpay') }}"
                                                        class="btn btn-danger">طلاب لم يتم دفع المصاريف لهم</a>
							  </div>
								<div class="col-md-2 text-right">
									</div>
                                            <div class="col-md-3">
                                                <input type="date" name="search" value="{{ $search }}"
                                                    class="form-control ">

                                            </div>
							<div class="col-md-3">
                                                <input type="text" placeholder="ادخل اسم الطالب او كود المعرف" name="search_name" value="{{ $search_name }}"
                                                    class="form-control ">

                                            </div>

                                            <div class="col-md-1">

                                                <button type="submit" class="btn btn-warning"><span class="icon-search"
                                                        style="font-weight: bold;font-size:1rem"></span></button>
                                            </div>


                                        </form>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center">م</th>
                                    <th class="text-center">اسم الطالب</th>
                                    <th class="text-center">حالة الدفع</th>
                                    <th class="text-center">المبلغ</th>
                                    <th class="text-center">ملاحظات</th>
                                    <th class="text-center">تارخ الدفع</th>
                                    <th class="text-center">اسم القائم بالدفع</th>
                                    <th class="text-right">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($rows) > 0)
                                    @php $i = 1; @endphp
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $row->Student->name }}</td>
                                            <td class="text-center">{{ $row->status }}</td>

                                            <td class="text-center">{{ $row->salary }} جنية</td>
                                            <td class="text-center">{{ substr($row->notes, 0, 100) }} ....</td>
                                            <td class="text-center">{{ $row->date }}</td>
                                            <td class="text-center">{{ $row->User->name }} (
                                                {{ $row->User->role == 1 ? 'مدير النظام' : 'مشرف للنظام' }} )</td>

                                            <td>
                                                <div class="td-actions">


                                                    <a href="{{ URL::route('admin.salary.show', $row->id) }}"
                                                        class="icon blue" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="عرض بيانات مصاريف الطالب">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                    @if (Auth::user()->role == 1)
                                                        <a href="{{ URL::route('admin.salary.edit', $row->id) }}"
                                                            class="icon green" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="تعديل بيانات مصاريف الطالب">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <form action="{{ URL::route('admin.salary.destroy', $row->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="icon bg-secondary text-light delete"
                                                                data-toggle="tooltip" data-target="tooltip"
                                                                data-placement="top" title="حذف بيانات مصاريف الطالب"
                                                                data-original-title="حذف بيانات مصاريف الطال">
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
                                        <td colspan="8" class="text-center">
                                            لا توجد مصاريف مضافة حاليا
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center w-100">
                <div class="text-center w-100">
                    {{ $rows->links() }}
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
