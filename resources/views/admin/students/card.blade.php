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
@section('title', 'عرض بيانات الطالب : ' . $student->name)

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'عرض كارت الطالب : ' . $student->name)

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
                    <div class="card-title">عرض كارت الطالب : {{ $student->name }}</div>
                </div>
                <div class="card-body">

                    <div class="form-group ">

                        <div class="row mt-0">
                            <div class="col-md-12 mt-0" id="image">
                                <img style="position: absolute;left:4rem;bottom:1.45rem" width="100px"
                                    src="data:image/png;base64,{{ $student->barcode }}">
                                <img src="{{ URL::asset('assets/card.jfif') }}" width="100%">
                                
                                <div style=""><input class="text-left pl-3 pt-0 pb-0" type="text" style="position: absolute;left:17rem;bottom:6.7rem;border:0px solid #fff;background:inherit !important" value="{{ $student->name }}" disabled></div>
                            
                                <div class="text-left p-0 m-0" style="position: absolute;left:17.8rem;bottom:2.9rem;" ><input type="text" class="text-left" style="border:0px solid #fff;background:inherit !important" value="{{ $student->Row->name }}" disabled></div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <button type="button" id="btn_convert" class="btn btn-success w-100">تحميل كارت التعريف</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ URL::route('admin.students.index') }}" class="btn btn-info w-100">عودة</a>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>



    </div>
@endsection
@push('js')
    <script src="{{ URL::asset('assets/js/html2canvas.min.js') }}"></script>
    <script>
        
        $(document).ready(function() {

            $("#btn_convert").on('click', function() {
                html2canvas(document.getElementById("image"), {
                    allowTaint: true,
                    useCORS: true
                }).then(function(canvas) {
                    var anchorTag = document.createElement("a");
                    document.body.appendChild(anchorTag);
                    document.getElementById("image").appendChild(canvas);
                    anchorTag.download = "كارت تعريف الطالب {{ $student->name }}";
                    anchorTag.href = canvas.toDataURL();
                    anchorTag.target = '_blank';
                    anchorTag.click();
                    $('canvas').hide();
                });
            });

        });
    </script>
@endpush
