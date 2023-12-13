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
@section('title', 'عرض بيانات مصاريف الطالب : ' . $salary->Student->name)

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'عرض بيانات مصاريف الطالب : ' . $salary->Student->name)

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
            <div class="card p-1 col-md-12 bg-primary message">
                <div class="card-body p-1 row" class="bg-primary">
                    <div class="col-md-12  text-light">{{ Session::get('error') }}</div>
                </div>
            </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">عرض بيانات مصاريف الطالب :  {{ $salary->Student->name }}</div>
                </div>
                <form class="card-body">
                    @csrf
                    @method('post')
                    <div class="form-group ">

                        @include('admin.salary.form')
                        
                        <div class="row mt-4">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <a href="{{ URL::route('admin.salary.index') }}" class="btn btn-info w-100">عودة</a>
                            </div>
                            <div class="col-md-4"></div>
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
            $('#student').val('{{ $salary->student_id }}').attr('disabled', 'disabled');
            $('#salary').val('{{ $salary->salary }}').attr('disabled', 'disabled');
            if('{{ $salary->status }}' == 'كاملة'){
                $('#status0').attr('checked', 'checked').attr('disabled', 'disabled');
                $('#status1').attr('disabled', 'disabled');
                $('#status2').attr('disabled', 'disabled');
                $('#status3').attr('disabled', 'disabled');
            }
            if('{{ $salary->status }}' == 'حصة'){
                $('#status1').attr('disabled', 'disabled');
                $('#status0').attr('disabled', 'disabled');
                $('#status2').attr('disabled', 'disabled');
                $('#status3').attr('checked', 'checked').attr('disabled', 'disabled');
            }
            if('{{ $salary->status }}' == 'خصم'){
                $('#status1').attr('checked', 'checked').attr('disabled', 'disabled');
                $('#status0').attr('disabled', 'disabled');
                $('#status2').attr('disabled', 'disabled');
                $('#status3').attr('disabled', 'disabled');
            }
            if('{{ $salary->status }}' == 'اعفاء'){
                $('#status2').attr('checked', 'checked').attr('disabled', 'disabled');
                $('#status1').attr('disabled', 'disabled');
                $('#status0').attr('disabled', 'disabled');
                $('#status3').attr('disabled', 'disabled');
            }
            $('#notes').val('{{ $salary->notes }}').attr('disabled', 'disabled');
            $('#admin_notes').val('{{ $salary->admin_notes }}').attr('disabled', 'disabled');
            

        });
    </script>
@endpush
