<?php

namespace App\Http\Controllers;

use App\Models\Expense_field;
use Illuminate\Http\Request;

class ExpenseFieldController extends Controller
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
        $expense_fields = Expense_field::all();
        return response()->view('expense_fields.index', compact('expense_fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('expense_fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validator =
            $request->validate([
                'name' => 'required|string|',
                'notes' => 'nullable|string|',
            ]);
        $expense_fields = new Expense_field();
        $expense_fields->name = $request->input('name');
        $expense_fields->notes = $request->input('notes');
        $saved = $expense_fields->save();
        if ($saved) {
            return redirect()->route('expense_fields.index')->with('msg', 'تم إنشاء وجه الصرف بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم إنشاء وجه صرف')->with('type', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense_field $expense_field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $expense_fields = Expense_field::find($id);

        return view('expense_fields.edit', compact('expense_fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator =
            $request->validate([
                'name' => 'required|string|min:3',
                'notes' => 'nullable|string|',
            ]);

        $expense_fields = Expense_field::findOrFail($id);
        $expense_fields->name = $request->input('name');
        $expense_fields->notes = $request->input('notes');
        $saved = $expense_fields->save();

        if ($saved) {
            return redirect()->route('expense_fields.index')->with('msg', 'تم التعديل بنجاح')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', ' لم يتم التعديل ')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $expense_fields = Expense_field::findOrFail($id);

        $deleted = $expense_fields->delete();
        if ($deleted) {
            return redirect()->back()->with('msg', 'تم حذف وجه الصرف')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'لم يتم حذف وجه الصرف')->with('type', 'danger');
        }
    }
}
