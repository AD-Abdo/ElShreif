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
@section('title', 'كل حضور المدرسين')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'كل حضور المدرسين')

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
    @if ($teachers_count > 0)
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table custom-table m-0">
                        <thead>
                            <tr style="background-color:#1A8E5F">

                                <th class="text-right " colspan="8">
                                    <form class="row"
                                        action="{{ URL::route('admin.teacher_attendance.search') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="col-md-7"></div>
                                        <div class="col-md-1">
                                            @if ($search != null)
                                                <a href="{{ URL::route('admin.teacher_attendance.index') }}"
                                                    class="btn btn-danger">X</a>
                                            @endif
                                        </div>
                                        <button type="submit" for="search"
                                            class="col-md-1 btn btn-info text-light">ابحث</button>

                                        <div class="col-md-3">
                                            <input type="date" id="search" class="form-control w-100"
                                                value="{{ $search }}" name="search" placeholder="اختر تاريخ البحث">
                                        </div>



                                    </form>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">م</th>
                                <th class="text-center">اسم المدرس</th>
                                <th class="text-center">المادة</th>
                                <th class="text-center">سعر الحصة</th>
                                <th class="text-center">تاريخ الحضور</th>
                                <th class="text-center">التعليق</th>
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
                                        <td class="text-center">{{ $row->Teacher->name }}</td>
                                        <td class="text-center">{{ $row->Teacher->Subject->name }}</td>
                                        @if (Auth::user()->role == 1)
                                            <td class="text-center">
                                                {{ $row->salary != null ? $row->salary : 'لا يوجد مبلغ مضاف' }}</td>
                                        @else
                                            <td class="text-center">خاصية لمدير النظام فقط</td>
                                        @endif
                                        <td class="text-center">{{ $row->date }}</td>
                                        <td class="text-center">
                                            {{ $row->comment != null? (strlen($row->comment) <= 110? $row->comment . '.': substr($row->comment, 0, 110) . ' ...الخ'): '---------------' }}
                                        </td>
                                        <td class="text-center">{{ $row->User->name }} (
                                            {{ $row->User->role == 1 ? 'مدير النظام' : 'مشرف للنظام' }} )</td>
                                        <td>
                                            <div class="td-actions">
                                                <a href="{{ URL::route('admin.teacher_attendance.show', $row->id) }}"
                                                    class="icon blue" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="عرض بيانات حضور المدرس">
                                                    <i class="icon-eye"></i>
                                                </a>
                                                @if (Auth::user()->role == 1)
                                                    <a href="{{ URL::route('admin.teacher_attendance.edit', $row->id) }}"
                                                        class="icon green" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="تعديل بيانات حضور المدرس">
                                                        <i class="icon-pencil"></i>
                                                    </a>

                                                    <form
                                                        action="{{ URL::route('admin.teacher_attendance.destroy', $row->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="icon bg-secondary text-light delete"
                                                            data-toggle="tooltip" data-target="tooltip" data-placement="top"
                                                            title="حذف بيانات حضور المدرس"
                                                            data-original-title="حذف بيانات حضور المدرس">
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
                    <div class="card-title text-center">عفوا لا يوجد مدرسين مسجيلن على النظام لكي يتم تحضيرهم</div>
                </div>

            </div>
        </div>
    @endif
@endsection
