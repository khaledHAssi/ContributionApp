<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //
    public function master()
    {
        return view('master');
    }
    public function index()
    {
        $investments = Investment::all();
        $investments = $investments->load('subscribers', 'subscribers.members');
        return response()->view('investments.index', compact('investments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $subscribers = Subscribe::all();
        return view('investments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =
            $request->validate([
                'name' => 'required|string|min:3|max:20|',
            ]);

        $investment = new Investment();
        $investment->name = $request->input('name');
        $saved = $investment->save();


        if ($saved) {
            return redirect()->route('investments.index')->with('msg', 'ثم إنشاء صندوق بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم إنشاء صندوق')->with('type', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Investment $investment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $investment = Investment::findOrFail($id);

        return view('investments.edit', compact('investment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator =
            $request->validate([
                'name' => 'required|string|min:3|max:20|',
            ]);

        $investment = Investment::findOrFail($id);
        $investment->name = $request->input('name');
        $saved = $investment->save();
        if ($saved) {
            return redirect()->route('investments.index')->with('msg', 'ثم تحديث الصندوق بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم تحديث الصندوق ')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $investment = Investment::findOrFail($id);
        $deleted = $investment->delete();
        if ($deleted) {
            return redirect()->back()->with('msg', 'ثم حذف الصندوق بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم حذف الصندوق')->with('type', 'danger');
        }
    }
}
