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
@section('title', ' طلاب لم يتم دفع المصاريف لهم')

<!-- Header Nav Title -->
@section('nav', 'الرئيسية')

<!-- Header SubNav Title -->
@section('sub_nav', 'طلاب لم يتم دفع المصاريف لهم')

@php
			$one = 0;
			$three = 0;
			$four = 0;
			$five = 0;
			$six = 0;
			$seven = 0;
			$eight = 0;
			$nine = 0;
			$ten = 0;
			$eleven = 0;
			$twelve = 0;
			$thirteen = 0;
			$fourteen = 0;
@endphp
@if (count($rows) > 0)
                                    @foreach ($rows as $row)
							@php
			
	if($row->Row->name == "الصف الاول الابتدائى"){
		$one = $one + 1 ;
	}

if($row->Row->name == "الصف الثانى الابتدائى"){
		$three = $three + 1 ;
	}
if($row->Row->name == "الصف الثالث الابتدائى"){
		$four = $four + 1 ;
	}
if($row->Row->name == "الصف الرابع الابتدائى"){
		$five = $five + 1 ;
	}
if($row->Row->name == "الصف الخامس الابتدائى"){
		$six = $six + 1 ;
	}
if($row->Row->name == "الصف السادس الابتدائى"){
		$seven = $seven + 1 ;
	}
if($row->Row->name == "الصف الاول الاعدادى"){
		$eight = $eight + 1 ;
	}
if($row->Row->name == "الصف الثانى الاعدادى"){
		$nine = $nine + 1 ;
	}
if($row->Row->name == "الصف الثالث الاعدادى"){
		$ten = $ten + 1 ;
	}
if($row->Row->name == "الصف الاول الثانوى العام"){
		$eleven = $eleven + 1 ;
	}
if($row->Row->name == "الصف الثانى الثانوى العام"){
		$twelve = $twelve + 1 ;
	}
if($row->Row->name == "الصف الاول الثانوى الازهرى"){
		$thirteen = $thirteen + 1 ;
	}
if($row->Row->name == "الصف الثانى الثانوى الازهرى"){
		$fourteen = $fourteen + 1 ;
	}

			
		@endphp
@endforeach
@endif
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
		
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table custom-table m-0">
<thead>
						<td colspan="2" class="bg-info text-center p-2" style="color:#fff" >الصف الاول الابتدائى : <span style="font-weight:bold">{{$one}}</span></td>
<td colspan="2" class="bg-success text-center p-2" style="color:#fff" >الصف الثانى الابتدائى : <span style="font-weight:bold">{{$three}}</span></td>
<td colspan="2" class="bg-danger text-center p-2" style="color:#fff" >الصف الثانت الابتدائى : <span style="font-weight:bold">{{$four}}</span></td>
<td colspan="2" class="bg-warning text-center p-2" style="color:#fff" >الصف الرابع الابتدائى : <span style="font-weight:bold">{{$five}}</span></td>
<td colspan="2" class="bg-dark text-center p-2" style="color:#fff" >الصف الخامس الابتدائى : <span style="font-weight:bold">{{$six}}</span></td>
</thead>
<thead>

<td colspan="2" class="bg-info text-center p-2" style="color:#fff" >الصف السادس الابتدائى : <span style="font-weight:bold">{{$seven}}</span></td>
<td colspan="2" class="bg-success text-center p-2" style="color:#fff" >الصف الاول الاعدادى : <span style="font-weight:bold">{{$eight}}</span></td>
<td colspan="2" class="bg-danger text-center p-2" style="color:#fff" >الصف الثانى الاعدادى : <span style="font-weight:bold">{{$nine}}</span></td>
<td colspan="2" class="bg-warning text-center p-2" style="color:#fff" >الصف الثالث الاعدادى : <span style="font-weight:bold">{{$ten}}</span></td>
<td colspan="2" class="bg-dark text-center p-2" style="color:#fff" >الصف الثانى الثانوى العام : <span style="font-weight:bold">{{$eleven}}</span></td>
                            </thead>
                            <thead>

						<td colspan="2" class="bg-info text-center p-2" style="color:#fff" >الصف الاول الثانوى العام : <span style="font-weight:bold">{{$twelve}}</span></td>

<td colspan="2" class="bg-success text-center p-2" style="color:#fff" >الصف الاول الثانوى الازهرى : <span style="font-weight:bold">{{$thirteen}}</span></td>
<td colspan="2" class="bg-danger text-center p-2" style="color:#fff" >الصف الثانى الثانوى الازهرى : <span style="font-weight:bold">{{$fourteen}}</span></td>
<td colspan="2" class="bg-warning text-center p-2" style="color:#fff" >العدد الكلى : <span style="font-weight:bold">{{
	$one+$three+$four+$five+$six+$seven+$eight+$nine+$ten+$eleven+$twelve+$thirteen+$fourteen
}}</span></td>
<td colspan="2"></td>

                            
					

                                
                                
                            </thead>
 <thead>
<tr>
                                    <th class="text-center">الرقم</th>
                                    <th class="text-center">اسم الطالب</th>
                                    <th class="text-center">رقم هاتف الطالب (1)</th>
                                    <th class="text-center">رقم هاتف الطالب (2)</th>
                                    <th class="text-center">الصف</th>
                                    <th class="text-center">تارخ الاضافة</th>
                                    <th class="text-center">اسم القائم بالاضافة</th>
                                    <th class="text-center">باركود</th>
                                    <th class="text-right">العمليات</th>
<th class="text-right"></th>
                                </tr>
 </thead>
                            <tbody>
                                @if (count($rows) > 0)
                                    @php $i = 1; @endphp
                                    @foreach ($rows as $row)
							@php
			
	if($row->Row->name == "الصف الاول الابتدائى"){
		$one = $one + 1 ;
	}
if($row->Row->name == "الصف الاول الابتدائى"){
		$two = $two + 1 ;
	}
if($row->Row->name == "الصف الثانى الابتدائى"){
		$three = $three + 1 ;
	}
if($row->Row->name == "الصف الثالث الابتدائى"){
		$four = $four + 1 ;
	}
if($row->Row->name == "الصف الرابع الابتدائى"){
		$five = $five + 1 ;
	}
if($row->Row->name == "الصف الخامس الابتدائى"){
		$six = $six + 1 ;
	}
if($row->Row->name == "الصف السادس الابتدائى"){
		$seven = $seven + 1 ;
	}
if($row->Row->name == "الصف الاول الاعدادى"){
		$eight = $eight + 1 ;
	}
if($row->Row->name == "الصف الثانى الاعدادى"){
		$nine = $nine + 1 ;
	}
if($row->Row->name == "الصف الثالث الاعدادى"){
		$ten = $ten + 1 ;
	}
if($row->Row->name == "الصف الاول الثانوى العام	"){
		$eleven = $eleven + 1 ;
	}
if($row->Row->name == "الصف الثانى الثانوى العام"){
		$twelve = $twelve + 1 ;
	}
if($row->Row->name == "الصف الاول الثانوى الازهرى"){
		$thirteen = $thirteen + 1 ;
	}
if($row->Row->name == "الصف الثانى الثانوى الازهرى"){
		$fourteen = $fourteen + 1 ;
	}

			
		@endphp
                                        <tr>
                                            <td class="text-center">{{ $row->id }}</td>
                                            <td class="text-center">{{ $row->name }}</td>
                                            <td class="text-center">{{ $row->phone }}</td>
                                            <td class="text-center">
                                                {{ $row->phone2 == null ? 'لا يوجد رقم هاتف' : $row->phone2 }}</td>
                                            <td class="text-center">{{ $row->Row->name }}</td>
                                            <td class="text-center">{{ $row->date }}</td>
                                            <td class="text-center">{{ $row->User->name }} (
                                                {{ $row->User->role == 1 ? 'مدير النظام' : 'مشرف للنظام' }} )</td>
                                            <td class="text-center"><img id="bardcode"
                                                    src="data:image/png;base64,{{ $row->barcode }}">
                                            </td>

                                            <td>
                                                <div class="td-actions">
                                                    @if (Auth::user()->role == 1)
                                                        <a href="data:image/png;base64,{{ $row->barcode }}"
                                                            download="باكود الطالب {{ $row->name }}.png"
                                                            class="icon bg-warning" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="تحميل باركود الطالب">
                                                            <i class="icon-folder_shared"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ URL::route('admin.students.show', $row->id) }}"
                                                        class="icon blue" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="عرض بيانات الطالب">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                    @if (Auth::user()->role == 1)
                                                        <a href="{{ URL::route('admin.students.edit', $row->id) }}"
                                                            class="icon green" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="تعديل بيانات الطالب">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                        <form
                                                            action="{{ URL::route('admin.students.destroy', $row->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="icon bg-secondary text-light delete"
                                                                data-toggle="tooltip" data-target="tooltip"
                                                                data-placement="top" title="حذف بيانات الطالب"
                                                                data-original-title="حذف بيانات الطالب">
                                                                <i class="icon-cancel"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                </div>
                                            </td>
 <td class="text-center"></td>


                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            لا توجد طلاب مضافة حاليا
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center w-100">
                <div class="text-center w-100">
                    {{ $rows->links() }}
                </div>
            </div>
        

    </div>
@endsection
