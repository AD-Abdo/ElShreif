<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Row;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RowController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'store','create']); 
    }
    public function message()
    {
        return[
            'name.required' => 'يجب ادخال اسم الصف قبل حفظ البيانات'
        ];
    }

    

    public function index()
    {
        $rows = Row::latest()->paginate(10);
        return view('admin.rows.index',compact('rows'));
    }

    public function create()
    {
        return view('admin.rows.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],$this->message());

        try{
            $row = new Row();
            $row->name = $request->name;
            $row->user_create = Auth::user()->id;
            $row->save();
            return redirect()->route('admin.rows.create')->with('success','تم اضافة الصف الى النظام بنجاح');
        }
        catch(Exception $ex){
            return redirect()->route('admin.rows.create')->with('error','ex');
        }
    }

    public function edit($id)
    {
        $row = Row::findOrFail($id);
        return view('admin.rows.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ],$this->message());

        $row = Row::findOrFail($id);
        try{
            
            if($row->name == $request->name){
                return redirect()->route('admin.rows.edit',$row->id)->with('error','لم يتم تعديل بيانات الصف لعدم التغيير فى البيانات');
            }
            else{
                $row->name = $request->name;
                $row->update();
                return redirect()->route('admin.rows.edit',$row->id)->with('success','تم تعديل الصف من النظام بنجاح');
            }
        }
        catch(Exception $ex){
            return redirect()->route('admin.rows.edit',$row->id)->with('error','ex');
        }
        
    }

    public function destroy($id)
    {
        try{
            $row = Row::findOrFail($id);
            $row->delete();
            return redirect()->route('admin.rows.index')->with('success','تم حذف صف : '.$row->name.' بنجاح');
        }   

        catch(Exception $ex){
            return redirect()->route('admin.rows.index',$row->id)->with('error','ex');
        }
        
    }
}
