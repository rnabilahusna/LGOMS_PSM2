<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class appointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Appointment::latest()->paginate(5);
        return view('index', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointmentForm');
        // return redirect()->route('appointmentForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buyerCode'          =>  'required',
            'appDate'            =>  'required',
            'appPurpose'         =>  'required',
            'appStatus'          =>  'required',
            'appTime'            =>  'required'
        ]);

        $appointment = new Appointment;

        $appointment->buyerCode = $request->buyerCode;
        $appointment->appDate = $request->appDate;
        $appointment->appPurpose = $request->appPurpose;
        $appointment->appStatus = $request->appStatus;
        $appointment->appTime = $request->appTime;

        $appointment->save();

        return redirect()->route('appointment.index')->with('success', 'Appointment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'buyerCode'          =>  'required',
            'appDate'            =>  'required',
            'appPurpose'         =>  'required',
            'appStatus'          =>  'required',
            'appTime'            =>  'required'
        ]);

        $appointment = Appointment::find($request->hidden_id);

        $appointment->buyerCode = $request->buyerCode;

        $appointment->appDate = $request->appDate;

        $appointment->appPurpose = $request->appPurpose;

        $appointment->appStatus = $request->appStatus;

        $appointment->appTime = $request->appTime;        

        $appointment->save();

        return redirect()->route('appointment.index')->with('success', 'Appointment info has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointment.index')->with('success', 'Appointment deleted successfully');
    
    }
}
