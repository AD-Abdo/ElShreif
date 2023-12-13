@extends('admin.layouts.main')
@php
$active[0] = 'active-page';
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
@section('title', 'الرئيسية')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', '')

<!-- Content -->
@section('content')
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header pt-2 pb-2 bg-primary text-light">
                    <div class="card-title text-center ">البيانات الاساسية للنظام</div>
                </div>

            </div>
        </div>
    </div>

    <div class="row gutters" id="data"></div>
    @if (Auth::user()->role == 1)
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="salaryTitle">
                <div class="card">
                    <div class="card-header pt-2 pb-2 bg-primary text-light">
                        <div class="card-title text-center ">الايراد اليومي</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row gutters" id="salary"></div>
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="attendanceTitle">
                <div class="card">
                    <div class="card-header pt-2 pb-2 bg-primary text-light">
                        <div class="card-title text-center ">الحضور اليومي</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row gutters" id="attendance"></div>
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="rowsTitle">
                <div class="card">
                    <div class="card-header pt-2 pb-2 bg-primary text-light">
                        <div class="card-title text-center "> عدد الطلاب فى الصفوف الدراسية</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row gutters" id="rows"></div>
    @endif
@endsection

@push('js')
    <script>
        function getData() {
            $.ajax({
                url: '{{ URL::route('admin.home.data') }}',
                type: 'GET',
                success: function(data) {
                    $('#data').append(
                        '<div class="rows col-xl-4 col-lg-4 col-md-6 col-sm-4 col-12"> <div class = "info-stats4" ><div class = "sale-num"><h4>' +
                        data['count_tables'] +
                        '</h4> <p> عدد الجداول على النظام</p></div></div> </div><div class="rows col-xl-4 col-lg-4 col-md-6 col-sm-4 col-12"> <div class = "info-stats4" ><div class = "sale-num"><h4>' +
                        data['count_subjects'] +
                        '</h4> <p> عدد المواد الدراسية على النظام</p></div></div> </div><div class="rows col-xl-4 col-lg-4 col-md-6 col-sm-4 col-12"> <div class = "info-stats4" ><div class = "sale-num"><h4>' +
                        data['count_teachers'] + '</h4> <p> عدد المدرسين على النظام</p></div></div> </div>'
                    );
                },
                error: function(err) {
                    console.log(err)
                }
            });
        };
        getData();
    </script>
    @if (Auth::user()->role == 1)
        <script>
            function getRows() {
                $.ajax({
                    url: '{{ URL::route('admin.home.RowData') }}',
                    type: 'GET',
                    success: function(data) {
                        console.log('ss');
                        var collection = data['rows'];
                        collection.forEach(element => {
                            $('#rows').append(
                                '<div class="rows col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"> <div class = "info-stats4" ><div class = "sale-num"><h4>' +
                                element['count_students'] + '</h4> <p>' + element['row'] +
                                '</p></div></div> </div>'
                            );
                        });
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
            };
        </script>
        <script>
            function getAttendance() {
                $.ajax({
                    url: '{{ URL::route('admin.home.Attendance') }}',
                    type: 'GET',
                    success: function(data) {
                        var collection = data['rows_student_attendance'];
                        collection.forEach(element => {
                            $('#attendance').append(
                                '<div class="attendance col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"> <div class = "info-stats4" ><div class = "sale-num"><h4>' +
                                element['count_students_attendances'] + ' </h4> <p>' + element['row'] +
                                '</p></div></div> </div>'
                            );
                        });
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
            };
        </script>
        <script>
            function getTodaySalary() {
                $.ajax({
                    url: '{{ URL::route('admin.home.TodaySalary') }}',
                    type: 'GET',
                    success: function(data) {
                        var collection = data['rows_student_salary'];
                        collection.forEach(element => {
                            $('#salary').append(
                                '<div class="salary col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"> <div class = "info-stats4" ><div class = "sale-num"><h4>' +
                                element['count_students_salary'] +
                                ' <span style="font-size:.85rem">جنية</span> </h4> <p>' + element[
                                    'row'] +
                                '</p></div></div> </div>'
                            );
                        });
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
            };
        </script>
        <script>
            getRows();
            getAttendance();
            getTodaySalary();

            setInterval(() => {

                $("#rowsTitle").slideUp();
                $(".rows").slideUp();
                $("#rowsTitle").slideDown();
                getRows();

                $("#attendanceTitle").slideUp();
                $(".attendance").slideUp();
                $("#attendanceTitle").slideDown();
                getAttendance();

                $("#salaryTitle").slideUp();
                $(".salary").slideUp();
                $("#salaryTitle").slideDown();
                getTodaySalary();

            }, 60000);
        </script>
    @endif
@endpush
