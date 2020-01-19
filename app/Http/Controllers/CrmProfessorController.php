<?php

namespace App\Http\Controllers;

use App\CrmProfessor;
use App\Http\Controllers\MiniCrmController;
use Illuminate\Http\Request;

use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CrmProfessorController extends Controller
{
    
    use Notifiable;
    use VoyagerUser;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();

        $canVisitAdmin = $user->hasPermission('browse_admin');

        //dd($canVisitAdmin);
        $crmId = 41576;

        $crmResponse = MiniCrmController::getProfessorDetails($crmId);

        //dd($crmResponse);

        return view('vendor.voyager.index', ['user' => $user], ['profesor' => $crmResponse]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrmProfessor  $crmProfessor
     * @return \Illuminate\Http\Response
     */
    public function show(CrmProfessor $crmProfessor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CrmProfessor  $crmProfessor
     * @return \Illuminate\Http\Response
     */
    public function edit(CrmProfessor $crmProfessor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CrmProfessor  $crmProfessor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrmProfessor $crmProfessor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CrmProfessor  $crmProfessor
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrmProfessor $crmProfessor)
    {
        //
    }
}
