<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $apps=DB::table('apps')->select('*')->orderBy('id', 'desc')->paginate(500);
       return view('backend.apps.index', compact('apps'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.apps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($request->file('image')!="")
        {
            if ($file = $request->file('image')) {
                $name = 'app'.time().$file->getClientOriginalName();
                $file->move('images/apps/', $name);
                $input['image'] = $name;
             }
       }
       else
       {
        $input['image'] ="";
       }
      
        App::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $app = App::findOrFail($id);
        $input = $request->all();
      
        if($request->file('image')!="")
        {
            if ($file = $request->file('image')) {
                $name = 'app_'.time().$file->getClientOriginalName();
                $file->move('images/apps/', $name);
                $input['image'] = $name;
            }
       }
       else
       {
        $input['image'] =$app['image'];
       }
        $app->update( $input);
       
        return back()->with('message', 'تم التعديل بنجاح');

        //if faile?
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $app= App::findOrFail($id);
        $app->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
