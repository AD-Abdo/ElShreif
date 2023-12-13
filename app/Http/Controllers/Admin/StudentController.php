<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Row;
use App\Models\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Picqer\Barcode\BarcodeGeneratorPNG;



class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'store','create','show','search']); 
    }
    public function index()
    {
        $search = '';
        $date = '';
	 $marhla_search = '';
        $rows = Student::where('status',0)->orderby('row_id','asc')->latest()->paginate(10);
	  $marhla = Row::get();
        $rows_count = Student::where('status',0)->count();

        return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
    }
	public function status()
    {
        $search = '';
        $date = '';
	 $marhla_search = '';
        $rows = Student::where('status',1)->orderby('row_id','asc')->latest()->paginate(10);
	  $marhla = Row::get();
        $rows_count = Student::where('status',1)->count();
        return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
    }
    
    public function create()
    {
        $rows = Row::get()->all();
        $rows_count = count(Row::get()->all());
        return view('admin.students.create',compact('rows','rows_count'));
    }

    public function message()
    {
        return [
            'name.required' => 'يجب ادخال اسم الطالب',
            'phone.required' => ' (1) يجب ادخال رقم الطالب',
            'phone.digits' => 'يجب ادخال رقم صحيح يحتوى على 11 رقم',
            'phone.numeric' => 'رقم الطالب يجب ان يحتوى على ارقام فقط',
            'phone2.digits' => 'يجب ادخال رقم صحيح يحتوى على 11 رقم',
            'phone2.numeric' => 'رقم الطالب يجب ان يحتوى على ارقام فقط',
            'row.required' => 'يجب اختيار الصف',
        ];
    }

    public function Store(Request $request)
    {
        
        $phone2 = null;
        if($request->phone2 != null){
            $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric|digits:11',
                'phone2' => 'required|numeric|digits:11',
                'row' => 'required'
            ],$this->message());
            $phone2 = $request->phone2;
        }else{
            $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric|digits:11',
                'row' => 'required'
            ],$this->message());
        }
        try{
            $student = new Student();
            $result = $student->query()->where('name','=',$request->name)->Where('phone','=',$request->phone)->Where('row_id',$request->row)->first();
            if($result == null){
                $student->name = $request->name;
                $student->phone = $request->phone;
                $student->phone2 = $phone2;
                $student->user_create = Auth::user()->id;
                $student->row_id = $request->row;
                $student->date = Carbon::now();
                $student->save();

                $number = $student->id;
                $generator = new BarcodeGeneratorPNG();
                $barcode =  base64_encode($generator->getBarcode($number, $generator::TYPE_CODE_128));
                $student->barcode = $barcode;
                $student->update();
                return redirect()->route('admin.students.create')->with('success','تم اضافة بيانات الطالب الى النظام بنجاح');
            }
            else{
                return redirect()->route('admin.students.create')->with('error','هذا الطالب مسجل مسبقا');
            }
        }
        catch(Exception $ex){
            return redirect()->route('admin.students.create')->with('error','ex');
        }
        
        
        
        
        
    }

    public function show($id)
    {
        $rows = Row::get()->all();
        $student = Student::findOrFail($id);
        return view('admin.students.show',compact('rows','student'));
    }

    public function card($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.card',compact('student'));
    }


    public function edit($id)
    {
        try{
            $student = Student::findOrFail($id);
            $rows = Row::get()->all();
            return view('admin.students.edit',compact('rows','student'));
        }   
        catch(Exception $ex){

        }
    }

    public function update(Request $request , $id)
    {
	  $status = 0;
	  if($request->has('status')){
		$status = 1;

	 }
        $student = Student::findOrFail($id);
            $phone2 = $student->phone2;
            if($request->phone2 != null){
                $request->validate([
                    'name' => 'required',
                    'phone' => 'required|numeric|digits:11',
                    'phone2' => 'required|numeric|digits:11',
                    'row' => 'required'
                ],$this->message());
                $phone2 = $request->phone2;
            }else{
                $request->validate([
                    'name' => 'required',
                    'phone' => 'required|numeric|digits:11',
                    'row' => 'required'
                ],$this->message());
            }
        try{
            
            if($student->name == $request->name &&
                $student->phone == $request->phone &&
                $student->phone2 == $request->phone2 &&
                $student->row_id == $request->row &&
		    $student->status == $status 
            ){
                return redirect()->route('admin.students.edit',$student->id)->with('error','لم يتم تعديل بيانات الطالب '.$student->name.' لعدم التغيير البيانات');
            }
            else{
                $student->name = $request->name;
                $student->phone = $request->phone;
                $student->phone2 = $request->phone2;
                $student->row_id = $request->row;
		   $student->status = $status;
                $student->update();
                return redirect()->route('admin.students.edit',$student->id)->with('success','تم تعديل بيانات الطالب '.$student->name.' من النظام بنجاح');

            }
        }   
        catch(Exception $ex){

        }
    }

    public function destroy($id)
    {
        try{
            $student = Student::findOrFail($id);
            $student->delete();
            return redirect()->route('admin.students.index')->with('success','تم حذف بيانات الطالب '.$student->name.' من النظام بنجاح');
        }

        catch(Exception $ex){
            return redirect()->route('admin.students.index')->with('error','ex');
        }
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $date = $request->date;
	  $marhla_search = $request->marhla_search;
	  $marhla = Row::get();
if($marhla_search  != null && $search == null){
		 
		$rows = Student::query()->where('status',0)->where('row_id',$marhla_search)->paginate(10000); 
		$rows_count = Student::query()->where('status',0)->where('row_id',$marhla_search)->count();

            
            return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
	   }
if( $search != null && $marhla_search  == null){
		 
		$rows = Student::query()->where('status',0)->where('name','LIKE','%'.$request->search.'%')->paginate(10000); 
		$rows_count = Student::query()->where('status',0)->where('name','LIKE','%'.$request->search.'%')->count();

            return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
	   }
	 if($marhla_search  != null && $search != null){
		 
		$rows = Student::query()->where('status',0)->where('row_id',$marhla_search)->where('name','LIKE','%'.$request->search.'%')->paginate(10000); 
		$rows_count = Student::query()->where('status',0)->where('row_id',$marhla_search)->where('name','LIKE','%'.$request->search.'%')->count();

            
            return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
	   }
          	
        if($search == null && $date == null){
            return redirect()->route('admin.students.index');
        }
	
	else if($search != null && $date == null){

            $rows = Student::query()->where('status',0)->where('name','LIKE','%'.$request->search.'%')->paginate(10000); 
		$rows_count = Student::query()->where('status',0)->where('name','LIKE','%'.$request->search.'%')->count();
		

            
            return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
        }
        else if($search == null && $date != null){
            $rows = Student::query()->where('status',0)->where('date','=',$request->date)->paginate(10000);
            $rows_count = Student::query()->where('status',0)->where('date','=',$request->date)->count();
            return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
        }
	else if($search != null && $date != null){
		 $rows = Student::query()->where('status',0)->where('name','LIKE','%'.$request->search)->where('date','=',$request->date)->orWhere('id',$request->search)->paginate(10000); 
		$rows_count = Student::query()->where('status',0)->where('name','LIKE','%'.$request->search.'%')->where('date','=',$request->date)->orWhere('id',$request->search)->count();
		
		

            
            return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
	}
	else{
            $rows = Student::query()->where('status',0)->where('id',$request->search)->where('date','=',$request->date)->paginate(10000);
            $count_all_rows = Student::query()->where('status',0)->where('id',$request->search)->where('date','=',$request->date)->count();
            if($count_all_rows == 0){
                $rows = Student::query()->where('status',0)->where('name','LIKE','%'.$request->search.'%')->where('date','=',$request->date)->paginate(10000);
            }

            $rows_count = count(Row::get()->where('status',0)->all());
            return view('admin.students.index',compact('rows','search','rows_count','date','marhla','marhla_search'));
        }
        
    }
}
