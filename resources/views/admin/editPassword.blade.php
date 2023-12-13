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
$active[10] = '';
@endphp
<!-- Page Title -->
@section('title', 'تعديل كلمة المرور')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'تعديل كلمة المرور')

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
                    <div class="card-title">تعديل كلمة المرور</div>
                </div>
                <form class="card-body" action="{{ URL::route('admin.edit.password.post') }}" method="POST">
                    @csrf
                    @method('post')


                    <div class="form-group mt-3 row">
                        <label for="password" class="col-sm-2 col-form-label">كلمة المرور</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="ادخل كلمة المرور">
                        </div>
                        <label for="confirmPassword" class="col-sm-2 col-form-label">تاكيد كلمة المرور</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="ادخل تاكيد كلمة المرور">
                        </div>

                    </div>
                    @if ($errors->any())
                        <div class="row mt-3">
                            <div class="col-md-2  message pl-3 pr-3 mt-1 ">
                            </div>
                            <div class="col-md-10  message pl-3 pr-3 mt-1 ">
                                @if ($errors->has('password'))
                                    <div class="text-light text-center bg-secondary pt-2 pb-2">
                                        {{ $errors->first('password') }}</div>
                                @endif
                            </div>



                        </div>
                    @endif
                    <div class="form-group row mt-5">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success w-100">تعديل</button>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>





                </form>
            </div>
        </div>



    </div>
@endsection
@push('js')
@endpush
