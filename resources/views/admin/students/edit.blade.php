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
@section('title', 'تعديل بيانات الطالب : '.$student->name)

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'تعديل بيانات الطالب : '.$student->name)

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
                    <div class="card-title">تعديل بيانات الطالب : {{$student->name}}</div>
                </div>
                <form class="card-body" action="{{ URL::route('admin.students.update',$student->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group ">

                        @include('admin.students.form')
				<div class="row mt-4">

                            <div class="col-md-12">
					  @if($student->status == 1)
					  <input id="status" name="status" type="checkbox" class="form-control" style="display:inline !important;width:20px" checked>
					  @else
                                <input id="status" name="status" type="checkbox" class="form-control" style="display:inline !important;width:20px">
					  @endif
					<label class="mr-2" for="status" style="display:inline !important">منقطع</label>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success w-100">تعديل</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ URL::route('admin.students.index') }}" class="btn btn-info w-100">عودة</a>
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
            $('#name').val('{{ $student->name }}');
		$('#status').val('{{ $student->status }}');
            $('#phone').val('{{ $student->phone }}');
            $('#phone2').val('{{ $student->phone2 }}');
            $('#row').val('{{ $student->row_id }}');

        });
    </script>
@endpush
