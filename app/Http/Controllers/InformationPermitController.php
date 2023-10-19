<?php

namespace App\Http\Controllers;

use App\Models\InformationPermit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information_permits = InformationPermit::orderBy('name')->get();

        return view('permit.information-permit', [
            'title' => 'Information Permit',
            'information_permits'  => $information_permits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', 'There was a problem adding.');
        }

        $validated = $validator->validated();

        InformationPermit::create($validated);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $information_permit = InformationPermit::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error', 'There was a problem adding.');
        }

        $validated = $validator->validated();

        $information_permit->update($validated);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $information_permit = InformationPermit::findOrFail($id);

        $information_permit->delete();

        return back();
    }
}
