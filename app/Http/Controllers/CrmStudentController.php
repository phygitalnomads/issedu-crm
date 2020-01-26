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
        $user = auth()->user();

        //$canVisitAdmin = $user->hasPermission('browse_admin');
 
        $userCrmId = $user->crm_id;

        $crmResponse = MiniCrmController::getStudentDetails($userCrmId);

        if ($crmResponse) {
            $crmResponse['TipUser'] = $user->user_type;
            
            $businessData = MiniCrmController::getBusinessDetails($crmResponse['BusinessId']);
            $businessData['Tags'] = '';
        } else {
            $businessData = null;
        }

       

        return view('vendor.voyager.index',
            ['utilizator' => $crmResponse],
            ['business' => $businessData]
        );

        // return view('vendor.voyager.index')->with('user', $user)
        //     ->with('utilizator', $crmResponse)
        //     ->with('business', $businessData);
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
