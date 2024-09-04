<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\EcardOrder;
use Illuminate\Support\Facades\DB;

class EcardOrderController extends Controller
{
    public function index()
    {
        $appOrders=DB::table('app_orders')->select('*')->orderBy('id', 'desc')->paginate(500);
        return view('backend.app.appOrders.index', compact('appOrders'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        EcardOrder::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    public function update(Request $request,  $id)
    {
        $appOrder = EcardOrder::findOrFail($id);
        $input = $request->all();
       
        $appOrder->update($input);
        
        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function destroy( $id)
    {
        $appOrder= EcardOrder::findOrFail($id);
        $appOrder->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
