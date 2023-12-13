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
@section('title', 'كل الطلاب')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'كل الطلاب')

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

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table custom-table m-0">
                            <thead>
                                <tr style="background-color:#1A8E5F">

                                    <th class="text-right " colspan="10">
                                        <form class="row" action="{{ URL::route('admin.students.search') }}"
                                            method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="col-md-2">
                                                <input type="text" class="form-control w-100" value="{{ $search }}"
                                                    name="search" placeholder="ادخل اسم او رقم الطالب">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="date" class="form-control w-100" value="{{ $date }}"
                                                    name="date">
                                            </div>
							<div class="col-md-2">
                                                <select class="form-control w-100 p-0 pr-1" name="marhla_search" >
									<option disabled selected>اختر المرحلة</option>
									@foreach($marhla as $m )
										@if($m->id == $marhla_search)
											<option value="{{ $m->id }}" selected>{{ $m->name }}</option>
										@else
											<option value="{{ $m->id }}">{{ $m->name }}</option>
										@endif
									@endforeach
								</select>
                                            </div>
                                            <div class="col-md-1">
                                                <input type="submit" class="form-control w-100 btn btn-info" value="بحث">
                                            </div>
							<div class="col-md-2">
                                                   <p class="p-1" style="color:#fff">عدد الطلاب ( {{ $rows_count }} )</p>
                                            </div>	
							<div class="col-md-1">
                                                   <a href="/admin/students"
                                                        class="btn btn-info">كل الطلاب</a>
                                            </div>
						
							<div class="col-md-1">
                                                   <a href="{{ URL::route('admin.students.status') }}"
                                                        class="btn btn-success">الطلاب المنقطعين</a>
                                            </div>
                                            <div class="col-md-1">
                                                @if ($date != null || $search != null)
                                                    <a href="{{ URL::route('admin.students.index') }}"
                                                        class="btn btn-danger">X</a>
                                                @endif
                                            </div>



                                        </form>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center">الرقم</th>
                                    <th class="text-center" >اسم الطالب</th>
                                    <th class="text-center">رقم هاتف الطالب (1)</th>
                                    <th class="text-center">رقم هاتف الطالب (2)</th>
                                    <th class="text-center">الصف</th>
                                    <th class="text-center">تارخ الاضافة</th>
                                    <th class="text-center">اسم القائم بالاضافة</th>
<th class="text-center">ملاحظات</th>

                                    <th class="text-center">باركود</th>
                                    <th class="text-right">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($rows) > 0)
                                    @php $i = 1; @endphp
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td class="text-center">{{ $row->id }}</td>
                                            <td class="text-center" style="font-size:1em">{{ $row->name }}</td>

                                            <td class="text-center">{{ $row->phone }}</td>
                                            <td class="text-center">
                                                {{ $row->phone2 == null ? 'لا يوجد رقم هاتف' : $row->phone2 }}</td>
                                            <td class="text-center">{{ $row->Row->name }}</td>
							
                                            <td class="text-center">{{ $row->date }}</td>
                                            <td class="text-center">{{ $row->User->name }} (
                                                {{ $row->User->role == 1 ? 'مدير النظام' : 'مشرف للنظام' }} )</td>
@if(!$row->getSalary )
<td class="text-center bg-danger" style="color:#fff;font-size:1em">{{ $row->getSalary
							? $row->getSalary->notes ? $row->getSalary->notes : "-"  : 'لم يدفع المصاريف حتي الان'   }}</td>
@else
<td class="text-center" style="font-size:1em">{{ $row->getSalary
							? $row->getSalary->notes ? $row->getSalary->notes : "-"  : 'لم يدفع المصاريف حتي الان'   }}</td>
@endif
                                            <td class="text-center"><img id="bardcode"
                                                    src="data:image/png;base64,{{ $row->barcode }}">
                                            </td>



                                            <td>
                                                <div class="td-actions">
                                                    @if (Auth::user()->role == 1)
                                                        <a href="data:image/png;base64,{{ $row->barcode }}"
                                                            download="باكود الطالب {{ $row->name }}.png"
                                                            class="icon bg-warning" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="تحميل باركود الطالب">
                                                            <i class="icon-folder_shared"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ URL::route('admin.students.show', $row->id) }}"
                                                        class="icon blue" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="عرض بيانات الطالب">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                    @if (Auth::user()->role == 1)
                                                        <a href="{{ URL::route('admin.students.edit', $row->id) }}"
                                                            class="icon green" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="تعديل بيانات الطالب">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <form
                                                            action="{{ URL::route('admin.students.destroy', $row->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="icon bg-secondary text-light delete"
                                                                data-toggle="tooltip" data-target="tooltip"
                                                                data-placement="top" title="حذف بيانات الطالب"
                                                                data-original-title="حذف بيانات الطالب">
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
                                        <td colspan="9" class="text-center">
                                            لا توجد طلاب مضافة حاليا
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
        

    </div>
@endsection
