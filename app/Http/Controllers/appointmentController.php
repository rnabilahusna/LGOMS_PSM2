<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\design;
use Illuminate\Http\Request;

class appointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = appointment::latest()->paginate(5);
        return view('prod.appointmentsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('client.appointmentForm');
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

        $appointment = new appointment;

        $appointment->buyerCode = $request->buyerCode;
        $appointment->appDate = $request->appDate;
        $appointment->appPurpose = $request->appPurpose;
        $appointment->appStatus = $request->appStatus;
        $appointment->appTime = $request->appTime;

        $appointment->save();

        return redirect()->route('client.myDesignsListPage')->with('success', 'Appointment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(appointment $appointment)
    {
        return view('prod.appointmentDetailsPage', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(appointment $appointment)
    {
        return view('edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, appointment $appointment)
    {
        $request->validate([
            'appStatus'          =>  'required'
        ]);

        $appointment = appointment::find($request->hidden_id);

        $appointment->appStatus = $request->appStatus;  

        $appointment->save();

        return redirect()->route('appointment.index')->with('success', 'Appointment info has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointment.index')->with('success', 'Appointment deleted successfully');
    
    }

    public function requestAppointment() {
        return view('client.appointmentForm');
    }

    public function getMyDesignsListPage() {
        $data = design::latest()->paginate(5);
        return view('client.myDesignsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }


    //PRODUCTION PERSONNEL FUNCTIONS

    public function getProdAppointmentsListPage()
    {
        $data = appointment::latest()->paginate(5);
        return view('prod.appointmentsListPage', compact('data'))->with('i', (request()->input('page',1)-1)*5);
    }

    public function showForProdP(appointment $appointment)
    {
        return view('prod.AppointmentDetailsPage', compact('appointment'));
    }
    
    public function updateAppointmentInfo(Request $request, design $design)
    {
        
        $request->validate([
            'appStatus'          =>  'required'
        ]);

        $appointment = appointment::find($request->hidden_id);

        $appointment->appStatus = $request->appStatus;  

        $appointment->save();

        return redirect()->route('prod.appointmentsListPage')->with('success', 'Appointment info has been updated successfully');

    }
}

