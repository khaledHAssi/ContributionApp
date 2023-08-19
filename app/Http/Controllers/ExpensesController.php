<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function master()
    {
        return view('master');
    }
    public function index()
    {
        //
        $expenses = Expenses::all();
        return response()->view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('expenses.create');
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
                'details' => 'required|string|min:20',
                'total_expenses' => 'required|numeric',
            ]);
        $expenses = new Expenses();
        $expenses->name = $request->input('name');
        $expenses->details = $request->input('details');
        $expenses->total_expenses = $request->input('total_expenses');
        $saved = $expenses->save();
        if ($saved) {
            return redirect()->route('expenses.index')->with('msg', 'Expenses Created Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Expenses Create Failed')->with('type', 'danger');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $expenses = Expenses::find($id);

        return view('expenses.edit', compact('expenses'));
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
                'details' => 'required|string|min:20',
                'total_expenses' => 'required|numeric',

            ]);

        $expenses = Expenses::findOrFail($id);
        $expenses->name = $request->input('name');
        $expenses->details = $request->input('details');
        $expenses->total_expenses = $request->input('total_expenses');

        $saved = $expenses->save();
        if ($saved) {
            return redirect()->route('expenses.index')->with('msg', 'Expenses updated Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', ' Expenses update Failed ')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $expenses = Expenses::findOrFail($id);

        $deleted = $expenses->delete();
        if ($deleted) {
            return redirect()->back()->with('msg', 'Expenses deleted successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Expenses delete Failed')->with('type', 'danger');
        }
    }
}
