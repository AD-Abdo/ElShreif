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
@section('title', 'كل المدرسين')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'كل المدرسين')

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
    @if ($subject_count > 0)
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table custom-table m-0">
                        <thead>
                            <tr>
                                <th class="text-center">م</th>
                                <th class="text-center">اسم المدرس</th>
                                <th class="text-center">المادة</th>
                                <th class="text-center">اسم القائم بالاضافة</th>
                                <th class="text-right">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($rows) > 0)
                                @php $i = 1; @endphp
                                @foreach ($rows as $row)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $row->name }}</td>
                                        <td class="text-center">{{ $row->subject->name }}</td>
                                        <td class="text-center">{{ $row->User->name }} (
                                            {{ $row->User->role == 1 ? 'مدير النظام' : 'مشرف للنظام' }} )</td>
                                        <td>
                                            <div class="td-actions">
                                                @if (Auth::user()->role == 1)
                                                    <a href="{{ URL::route('admin.teacher.edit', $row->id) }}"
                                                        class="icon green" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="تعديل بيانات المدرس">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <form action="{{ URL::route('admin.teacher.destroy', $row->id) }}"
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
                                    <td colspan="5" class="text-center">
                                        لا توجد مدرسين مضافة حاليا
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
                    <div class="card-title text-center">يجب اضافة المواد الدراسية قبل البدء فى اضافة المدرسين</div>
                </div>

            </div>
        </div>
    @endif
@endsection
