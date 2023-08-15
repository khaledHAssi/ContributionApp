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
        return response()->view('investments.index', compact('investments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subscribers = Subscribe::all();
        return view('investments.create' , compact('subscribers'));
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
                'total' => 'required|numeric',

            ]);

        $investment = new Investment();
        $investment->name = $request->input('name');
        $investment->total = $request->input('total');
        $saved = $investment->save();


        if ($saved) {
            return redirect()->route('investments.index')->with('msg', 'Investment Created Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Investment Create Failed')->with('type', 'danger');
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
                'total' => 'required|numeric',

            ]);

        $investment = Investment::findOrFail($id);
        $investment->name = $request->input('name');
        $investment->name = $request->input('total');

        $saved = $investment->save();
        if ($saved) {
            return redirect()->route('investments.index')->with('msg', 'Investment updated Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Investment update Failed ')->with('type', 'danger');
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
            return redirect()->back()->with('msg', 'Investment deleted successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Investment delete Failed')->with('type', 'danger');
        }
    }
}
