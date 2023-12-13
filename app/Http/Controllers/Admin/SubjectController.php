<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'store','create']); 
    }
    public function message()
    {
        return[
            'name.required' => 'يجب ادخال اسم المادة قبل حفظ البيانات'
        ];
    }

    public function index()
    {
        $rows = Subject::latest()->paginate(10);
        return view('admin.subject.index',compact('rows'));
    }

    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],$this->message());

        try{
            $row = new Subject();
            $row->name = $request->name;
            $row->user_create = Auth::user()->id;
            $row->save();
            return redirect()->route('admin.subject.create')->with('success','تم اضافة المادة الى النظام بنجاح');
        }
        catch(Exception $ex){
            return redirect()->route('admin.subject.create')->with('error','ex');
        }
    }

    public function edit($id)
    {
        $row = Subject::findOrFail($id);
        return view('admin.subject.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required'
        ],$this->message());

        $row = Subject::findOrFail($id);
        try{
            
            if($row->name == $request->name){
                return redirect()->route('admin.subject.edit',$row->id)->with('error','لم يتم تعديل بيانات المادة لعدم التغيير فى البيانات');
            }
            else{
                $row->name = $request->name;
                $row->update();
                return redirect()->route('admin.subject.edit',$row->id)->with('success','تم تعديل بيانات المادة من النظام بنجاح');
            }
        }
        catch(Exception $ex){
            return redirect()->route('admin.subject.edit',$row->id)->with('error','ex');
        }
        
    }

    public function destroy($id)
    {
        try{
            $row = Subject::findOrFail($id);
            $row->delete();
            return redirect()->route('admin.subject.index')->with('success','تم حذف مادة : '.$row->name.' بنجاح');
        }   

        catch(Exception $ex){
            return redirect()->route('admin.subject.index',$row->id)->with('error','ex');
        }
        
    }
}
