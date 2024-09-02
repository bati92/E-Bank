<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Turkification;
use Illuminate\Support\Facades\DB;

class TurkificationController extends Controller
{
    public function index()
    {
       $turkifications=DB::table('turkifications')->select('*')->orderBy('id', 'desc')->paginate(500);
       return view('backend.turkifications.index', compact('turkifications'));
    }

    public function create()
    {
        return view('backend.turkifications.create');
    }

    public function store(Request $request)
    {
        $current_user =1;
        $input = $request->all();

        Turkification::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    public function show(string $id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $turkification = Turkification::findOrFail($id);
        $input = $request->all();
        $turkification->update([
        'ime' => $input['ime'],
        ]);
        
        return back()->with('message', 'تم التعديل بنجاح');

        //if faile?

    }

    public function destroy(string $id)
    {
        $turkification= Turkification::findOrFail($id);
        $turkification->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
