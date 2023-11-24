<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\AggregatesCodesModel;

class AggregatesCodesController extends Controller
{
    public function index(Request $request)
    {
        $agrygetnam = $request['agrygetname'] ?? "";
        if($request->ajax()){
            $cates =AggregatesCodesModel::Query();
            if($agrygetnam !="" ){
              $cates->where('site_name', 'LIKE', "%$agrygetnam%")->get();
            }
            $aggregatescodes = $cates->Paginate(5);
            return view('admin.aggregatescodes.data',compact('aggregatescodes'));
          }
          $cates =AggregatesCodesModel::Query();
          if($agrygetnam !="" ){
            $cates->where('site_name', 'LIKE', "%$agrygetnam%")->get();
          }
               $aggregatescodes = $cates->Paginate(5);
        return view('admin.aggregatescodes.index',compact('aggregatescodes'));
    }
    public function create()
    {
        return view('admin.aggregatescodes.create');
    }
    public function store(Request $request)
    {
    $valData =  $request->validate([
        'site_name' => 'required',
        'pixel_code' => 'required',
    ]);
    $data = new AggregatesCodesModel;
    $data->site_name = $request->input('site_name');
    $data->pixel_code = $request->input('pixel_code');
    $data->save();
    return redirect()->route('aggregatescodes.index')->with('message','Aggregates Codes Created Successfully');
}
    public function show($id)
    {
        $data = AggregatesCodesModel::find($id);
        return view('admin.aggregatescodes.show',compact('data'));
    }
    public function edit($id)
    {
        $aggregatescodes = AggregatesCodesModel::find($id);
        return view('admin.aggregatescodes.edit',compact('aggregatescodes'));
    }
    public function update(Request $request,$id)
    {
        $valData =  $request->validate([
            'site_name' => 'required',
            'pixel_code' => 'required',
        ]);
        $data = AggregatesCodesModel::find($id);
        $data->site_name = $request->input('site_name');
        $data->pixel_code = $request->input('pixel_code');
        $data->save();
        return redirect()->route('aggregatescodes.index')->with('message','Aggregates Codes Updated Successfully');
    }
    public function destroy(Request $request,$id)
    {
        $data = AggregatesCodesModel::find($id);
        $data ->delete();
        return redirect()->route('aggregatescodes.index')->with('message','Aggregates Codes Deleted Successfully');
    }
}