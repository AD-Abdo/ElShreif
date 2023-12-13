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
@section('title', 'تعديل بيانات مصاريف الطالب : ' . $salary->Student->name)

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'تعديل بيانات مصاريف الطالب : ' . $salary->Student->name)

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
        @if (Session::has('error'))
            <div class="card p-1 col-md-12 bg-danger message">
                <div class="card-body p-1 row" class="bg-danger">
                    <div class="col-md-12  text-light">{{ Session::get('error') }}</div>
                </div>
            </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">تعديل بيانات مصاريف الطالب :  {{ $salary->Student->name }}</div>
                </div>
                <form class="card-body" action="{{ URL::route('admin.salary.update',$salary->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group ">

                        @include('admin.salary.form')
                        
                        <div class="row mt-4">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success w-100">تعديل</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ URL::route('admin.salary.index') }}" class="btn btn-info w-100">عودة</a>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                    </div>

                </form>
            </div>
        </div>



    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#student').val('{{ $salary->student_id }}');
            $('#salary').val('{{ $salary->salary }}');
            if('{{ $salary->status }}' == 'كاملة'){
                $('#status0').attr('checked', 'checked');
            }
            if('{{ $salary->status }}' == 'خصم'){
                $('#status1').attr('checked', 'checked');
            }
            if('{{ $salary->status }}' == 'اعفاء'){
                $('#status2').attr('checked', 'checked');
            }
            if('{{ $salary->status }}' == 'حصة'){
                $('#status3').attr('checked', 'checked');
            }
            $('#notes').val('{{ $salary->notes }}');
            $('#admin_notes').val('{{ $salary->admin_notes }}');
            

        });
    </script>
@endpush
