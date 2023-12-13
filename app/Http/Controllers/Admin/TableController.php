<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index','show','search']); 
    }
    public function index()
    {
        $search = null;
        $rows = Table::latest()->paginate(8);
        return view('admin.table.index',compact('rows','search'));
    }

    public function create()
    {
        return view('admin.table.create');
    }

    public function message()
    {
        return [
            'title.required' => 'يجب ادخال عنوان الجدول',
            'image.required' => 'يجب اختيار الصورة'
        ];  
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required'
        ],$this->message());

        $image = $request->image;
        $image_name = '20'.date('y-m-d').$image->getClientOriginalName();

        $row = new Table();
        $row->title = $request->title;
        $row->user_create = Auth::user()->id;
        $row->date = Carbon::now();
        $row->image = $image_name;
        if($row->save()){
            $image->move('table/',$image_name);
        }

        return redirect()->route('admin.table.create')->with('success','تم اضافة الجدول فى النظام بنجاح');
        
    }
    public function show($id)
    {
        $row = Table::findOrFail($id);
        return view('admin.table.show',compact('row'));
    }

    public function edit($id)
    {
        $row = Table::findOrFail($id);
        return view('admin.table.edit',compact('row'));
    }

    public function update(Request $request ,$id)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $row = Table::findOrFail($id);
        if($row->title == $request->title && $request->image == null){
            return redirect()->route('admin.table.edit',$row->id)->with('error','لم يتم تعديل بيانات جدول :  '.$row->title.' لعدم تغيير البيانات');

        }else{
            $row->title = $request->title;
            $image = $request->image;
            if($image != null){
                unlink('table/'.$row->image);
                $image_name = '20'.date('y-m-d').$image->getClientOriginalName();
                $row->image = $image_name;
                $image->move('table/',$image_name);
            }
            $row->update();
            return redirect()->route('admin.table.edit',$row->id)->with('success','تم تعديل بيانات الجدول فى النظام بنجاح');

        }
    }

    public function destroy($id)
    {
        $row = Table::findOrFail($id);
        unlink('table/'.$row->image);
        $row->delete();
        return  redirect()->route('admin.table.index')->with('success','تم حذف بيانات الجدول من النظام بنجاح');

    }

    public function search(Request $request)
    {
        $search = $request->search;
        
        if($search == null ){
            return redirect()->route('admin.table.index');
        }

        else{
            $rows = Table::query()->where('title','LIKE','%'.$request->search.'%')->paginate(8);
            return view('admin.table.index',compact('rows','search'));
        }
            
    }

}
