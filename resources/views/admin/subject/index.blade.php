@extends('admin.layouts.main')
@php
$active[0] = '';
$active[1] = '';
$active[2] = '';
$active[3] = '';
$active[4] = '';
$active[5] = '';
$active[6] = 'active-page';
$active[7] = '';
$active[8] = '';
$active[9] = '';
$active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'كل المواد الدراسية')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'كل المواد الدراسية')

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

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table custom-table m-0">
                    <thead>
                        <tr>
                            <th class="text-center">م</th>
                            <th class="text-center">اسم المادة</th>
                            <th class="text-center">عدد المدرسين</th>
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
                                    <td class="text-center">{{ count($row->Teachers) }}</td>
                                    <td class="text-center">{{ $row->User->name }} (
                                        {{ $row->User->role == 1 ? 'مدير النظام' : 'مشرف للنظام' }} )</td>
                                    <td>
                                        <div class="td-actions">
                                            @if (Auth::user()->role == 1)
                                                <a href="{{ URL::route('admin.subject.edit', $row->id) }}"
                                                    class="icon green" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="تعديل المادة">
                                                    <i class="icon-pencil"></i>
                                                </a>
                                                <form action="{{ URL::route('admin.subject.destroy', $row->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="icon bg-secondary text-light delete"
                                                        data-toggle="tooltip" data-target="tooltip" data-placement="top"
                                                        title="حذف بيانات المادة" data-original-title="حذف بيانات المادة">
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
                                    لا توجد مواد دراسية مضافة حاليا
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
@endsection
