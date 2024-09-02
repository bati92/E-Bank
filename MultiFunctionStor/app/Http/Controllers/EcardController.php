<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcardSection;
use App\Models\Ecard;
use Illuminate\Support\Facades\DB;

class EcardController extends Controller
{
  
    public function index()
    { 
        $ecards=DB::table('ecards')->select('*')->orderBy('id', 'desc')->paginate(500);
        $ecards_sections=DB::table('ecard_sections')->select('*')->orderBy('id', 'desc')->paginate(500);
        return view('backend.ecard.ecards.index', compact('ecards','ecards_sections'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $input = $request->all();
       
         if($request->file('image')!="")
         {
             if ($file = $request->file('image')) {
            $name = 'ecard'.time().$file->getClientOriginalName();
            $file->move('assets/images/ecard/', $name);
            $input['image'] = $name;
         }
        }
        else
        {
            $input['image']= "";
        }
        Ecard::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $ecard = Ecard::findOrFail($id);
        $input = $request->all();
        if($request->file('image')!="")
        {
            if ($file = $request->file('image')) {
           $name = 'ecard'.time().$file->getClientOriginalName();
           $file->move('assets/images/ecard/', $name);
           $input['image'] = $name;
        }
        }
        else
        {
            $input['image']= $ecard['image'];
        }
        $ecard->update( $input);
       
        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function destroy(string $id)
    {
        $ecard= Ecard::findOrFail($id);
        $ecard->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }

}
 