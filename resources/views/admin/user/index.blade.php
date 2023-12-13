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
    $active[9] = '';
    $active[10] = 'active-page';
@endphp
<!-- Page Title -->
@section('title', 'كل المستخدمين')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'كل المستخدمين')

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
                            <th class="text-center">اسم المستخدم</th>
                            <th class="text-center">البريدالالكتروني</th>
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
                                    <td class="text-center">{{ $row->email }}</td>
                                    <td>
                                        <div class="td-actions">


                                            <form action="{{ URL::route('admin.user.destroy', $row->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="icon bg-secondary text-light delete"
                                                    data-toggle="tooltip" data-target="tooltip" data-placement="top"
                                                    title="حذف بيانات المستخدم" data-original-title="حذف بيانات المستخدم">
                                                    <i class="icon-cancel"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    لا يوجد مستخدمين مضافين حاليا
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
