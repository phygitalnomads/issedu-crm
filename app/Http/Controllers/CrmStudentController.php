<?php

namespace App\Http\Controllers;

use App\CrmStudent;
use App\Http\Controllers\MiniCrmController;
use Illuminate\Http\Request;

use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Foundation\Auth\User as Authenticatable;


class CrmStudentController extends Controller
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
        $crmId = 40566;

        $crmResponse = MiniCrmController::getStudentDetails($crmId);

        //dd($crmResponse);

        return view('vendor.voyager.index', ['user' => $user], ['utilizator' => $crmResponse]);

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
     * @param  \App\CrmStudent  $crmStudent
     * @return \Illuminate\Http\Response
     */
    public function show(CrmStudent $crmStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CrmStudent  $crmStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(CrmStudent $crmStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CrmStudent  $crmStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrmStudent $crmStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CrmStudent  $crmStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrmStudent $crmStudent)
    {
        //
    }
}
