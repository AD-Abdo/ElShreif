<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'store','create']); 
    }
    public function message()
    {
        return[
            'name.required' => 'يجب ادخال اسم المدرس قبل حفظ البيانات',
            'subject.required' => 'يجب اختيار المادة قبل حفظ البيانات',
        ];
    }
    public function index()
    {
        $rows = Teacher::latest()->paginate(10);
        $subject_count = count(Subject::get()->all());
        return view('admin.teacher.index',compact('rows','subject_count'));
    }

    public function create()
    {
        $subjects = Subject::get()->all();
        $subject_count = count(Subject::get()->all());
        return view('admin.teacher.create',compact('subjects','subject_count'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required'
        ],$this->message());

        try{
            $row = new Teacher();
            $row->name = $request->name;
            $row->subject_id = $request->subject;
            $row->user_create = Auth::user()->id;

            $row->save();
            return redirect()->route('admin.teacher.create')->with('success','تم اضافة المدرس الى النظام بنجاح');
        }
        catch(Exception $ex){
            return redirect()->route('admin.teacher.create')->with('error',$ex);
        }
    }

    public function edit($id)
    {
        $row = Teacher::findOrFail($id);
        $subjects = Subject::get()->all();
        return view('admin.teacher.edit',compact('row','subjects'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required',
            'subject' => 'required'
        ],$this->message());


        $row = Teacher::findOrFail($id);
        try{
            
            if($row->name == $request->name && $row->subject_id == $request->subject){
                return redirect()->route('admin.teacher.edit',$row->id)->with('error','لم يتم تعديل بيانات المدرس لعدم التغيير فى البيانات');
            }
            else{
                $row->name = $request->name;
                $row->subject_id = $request->subject;
                $row->update();
                return redirect()->route('admin.teacher.edit',$row->id)->with('success','تم تعديل بيانات المدرس من النظام بنجاح');
            }
        }
        catch(Exception $ex){
            return redirect()->route('admin.teacher.edit',$row->id)->with('error',$ex);
        }
        
    }

    public function destroy($id)
    {
        try{
            $row = Teacher::findOrFail($id);
            $row->delete();
            return redirect()->route('admin.teacher.index')->with('success','تم حذف المدرس : '.$row->name.' بنجاح');
        }   

        catch(Exception $ex){
            return redirect()->route('admin.teacher.index',$row->id)->with('error','ex');
        }
        
    }
}
