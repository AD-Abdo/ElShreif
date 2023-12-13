<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\Student;
use App\Models\Row;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'store','create','show','search']); 
    }
    public function index(){
        $rows = Salary::latest()->paginate(10);
        $search = null;
	  $search_name = null;
        $student_count = count(Student::get()->all());
        return view('admin.salary.index',compact('search','rows','student_count','search_name'));
    }

     public function notIndex(){
        $search = null;
	  $search_name = null;

	  $month = now()->month;
	  $year = now()->year;
        $students = Student::get()->all();
	  if($month < 10){
		$month = '0'.$month;
	  }
	  $students = Student::where('status',0)->get()->all();
	  $students_rows = [];
	  foreach($students as $student){
             $salary = Salary::query()->whereDate('date','LIKE','%'.$year.'-'.$month.'%')->where('student_id',$student->id)->first();
			
              if($salary == null){
                 array_push($students_rows ,$student->id);  
             }
		
        }
	  
        $rows_count = count($students_rows );
	  $date = null;
	  $marhla = Row::latest()->get();
	  $marhla_search = '';
	  $rows = Student::whereIn('id',$students_rows )->paginate(10000);
        return view('admin.students.notpay',compact('search','rows','rows_count','search_name','date','marhla','marhla_search'));
    }

    public function feature()
    {
        $rows = Salary::latest()->paginate(10);
        $search = null;
        $salary = 0;
	 $search_name  = null;
        $student_count = count(Student::where('status',0)->get()->all());
        return view('admin.salary.feature',compact('search','rows','student_count','salary','search_name'));
    }
    public function featurePost(Request $request)
    {
        $rows = Salary::query()->where('date','=',$request->search)->get();
        $search = $request->search;
        $student_count = count(Student::where('status',0)->get()->all());
        $salary = 0;
	 $search_name  = $request->search_name;
        foreach ($rows as $row ) {
            $salary = $row->salary + $salary;
        }
        return view('admin.salary.feature',compact('search','rows','student_count','salary','search_name'));
    }

    public function create()
    {
        
        $month = now()->month;
	  $year = now()->year;
        $students = Student::where('status',0)->get()->all();
	  if($month < 10){
		$month = '0'.$month;
	  }
        $salaries = Salary::query()->where('date','LIKE','%'.$year.'-'.$month.'%')->get()->all();

        $rows = [];
        if(count($salaries) > 0){
           foreach($students as $student){
                $salary = Salary::query()->where('date','LIKE','%'.$year.'-'.$month.'%')->where('student_id',$student->id)->first();
		
                if($salary == null || $salary->status == 'حصة' ){
                    array_push($rows,$student);  
                }

		     
          }
                
            
        }

        else{
            $students = Student::where('status',0)->get()->all();
            $rows = $students;
        }

        $student_count = count(Student::where('status',0)->get()->all());
        return view('admin.salary.create',compact('rows','student_count'));
    }
    
    public function message()
    {
        return [
            'student.required' => 'يجب اختيار الطالب',
            'salary.required' => 'يجب ادخال المبلغ المدفوع',
            'status.required' => 'يجب اختيار حالة الطالب',
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'student' => 'required',
            'salary' =>'required',
            'status' => 'required'
        ],$this->message());

        $row = new Salary();
        $row->student_id = $request->student;
        $row->salary = $request->salary;
        $row->status  = $request->status;
        $row->user_create = Auth::user()->id;
        $row->notes = $request->notes;
        $row->admin_notes = $request->admin_notes;
        $row->date = Carbon::now();
        $row->save();
        return redirect()->route('admin.salary.create')->with('success','تم اضافة مصاريف الطالب '.$row->Student->name.' على النظام بنجاح');
    }
    public function show($id)
    {
        $salary = Salary::findOrFail($id);
        $rows = Student::where('status',0)->get()->all();
        return view('admin.salary.show',compact('rows','salary'));
    }
    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        $rows = Student::where('status',0)->get()->all();
        return view('admin.salary.edit',compact('rows','salary'));
    }
    public function update(Request $request , $id)  
    {
        $request->validate([
            'student' => 'required',
            'salary' =>'required',
            'status' => 'required'
        ],$this->message());


        $row = Salary::findOrFail($id);
        if($row->student_id == $request->student &&
            $row->salary == $request->salary &&
            $row->status == $request->status &&
            $row->notes == $request->notes &&
            $row->admin_notes == $request->admin_notes
        
        ){
            
            return redirect()->route('admin.salary.edit',$row->id)->with('error','لم يتم تعديل مصاريف الطالب '.$row->Student->name.' لعدم تغيير البيانات');

        }else{

        
            $row->student_id = $request->student;
            $row->salary = $request->salary;
            $row->status  = $request->status;
            $row->notes = $request->notes;
            $row->admin_notes = $request->admin_notes;
            $row->update();
            return redirect()->route('admin.salary.edit',$row->id)->with('success','تم تعديل مصاريف الطالب '.$row->Student->name.' على النظام بنجاح');
        }
    }

    public function destroy($id)
    {
        $row = Salary::findOrFail($id);
        $row->delete();
        return redirect()->route('admin.salary.index')->with('success','تم حذف مصاريف الطالب '.$row->Student->name.' من النظام بنجاح');

    }

    public function search(Request $request)
    {
        $search = $request->search;
	  $search_name  = $request->search_name;
        if($search != null && $search_name == null){
            $rows = Salary::where('date',$search)->paginate();  
            $student_count = count(Student::where('status',0)->get()->all());  
            return view('admin.salary.index',compact('rows','search','student_count','search_name'));
        }elseif($search == null && $search_name != null){
		$students = Student::query()->where('status',0)->where('name','LIKE','%'.$search_name.'%')->orWhere('id',$search_name)->get()->all();	
		$students_ids = [];
		foreach($students as $student){
                 array_push($students_ids,$student->id);
             }
             $rows = Salary::query()->whereIn('student_id',$students_ids)->latest()->paginate(10000);
		$student_count = Salary::query()->whereIn('student_id',$students_ids)->count();
		 return view('admin.salary.index',compact('rows','search','student_count','search_name'));
	  }
        else {
            return redirect()->route('admin.salary.index');
        }
        
    }
}
