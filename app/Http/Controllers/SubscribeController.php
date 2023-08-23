<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Member;
use App\Models\subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscribe::with(['members', 'investments'])->get();
        return response()->view('subscribes.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = DB::select('SELECT `id`, `name` , `type`FROM `members`');
        $investments = DB::select('SELECT `id`, `name` FROM `investments`');
        return view('subscribes.create', compact('members', 'investments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =
            $request->validate([
                'member_id' => 'required',
                'investment_id' => 'required',
                'value' => 'required|numeric',
                'date' => 'required|',
            ]);
        $subscribe = new subscribe;
        $subscribe->name = $request->input('name');
        $subscribe->date = $request->input('date');
        $subscribe->member_id = $request->input('member_id');
        $subscribe->value = $request->input('value');
        $subscribe->investment_id = $request->input('investment_id');
        $investment = Investment::find($request->input('investment_id'));
        $investment->total += $subscribe->value;
        $saved = $subscribe->save();
        if ($saved) {
            $save =$investment->save();
            if ($save) {
                return redirect()->route('subscribes.index')->with('msg', 'Subscribe Created Successfully')->with('type', 'success');
            } else {
                return redirect()->back()->with('msg', 'Subscribe Create Failed')->with('type', 'danger');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(subscribe $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subscribe = Subscribe::findOrFail($id);
        $members = DB::select('SELECT `id`, `name` , `type`FROM `members` ');
        $subscribe = $subscribe->load('members');
        $investments = DB::select('SELECT `id`, `name` , `total`  FROM `investments`');
        $subscribe = $subscribe->load('investments');
        return view('subscribes.edit', compact('subscribe', 'members', 'investments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator =
            $request->validate([
                'member_id' => 'required',
                'value' => 'required|numeric',
                'date' => 'required|',
            ]);
        $subscribe = subscribe::findOrFail($id);
        $subscribe->value = $request->input('value');
        $subscribe->date = $request->input('date');
        $subscribe->member_id = $request->input('member_id');
        $saved = $subscribe->save();
        if ($saved) {
            return redirect()->route('subscribes.index')->with('msg', 'Subscribe updated Successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Subscribe update Failed')->with('type', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subscribe = subscribe::findOrFail($id);
        $deleted = $subscribe->delete();
        if ($deleted) {
            return redirect()->back()->with('msg', 'Subscribe deleted successfully')->with('type', 'success');
        } else {
            return redirect()->back()->with('msg', 'Subscribe delete Failed')->with('type', 'danger');
        }
    }
}
