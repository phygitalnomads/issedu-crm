<?php

namespace App\Http\Controllers;

use App\CrmProfessor;
use App\CrmStudent;
use App\Http\Controllers\MiniCrmController;
use Illuminate\Http\Request;

use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;


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

        if (!$user) return redirect('admin/login');
        //$canVisitAdmin = $user->hasPermission('browse_admin');
        $userCrmId = $user->crm_id;
        $userType = $user->user_type;
        $userEmail = $user->email;

        switch ($userType) {

            case 'Student' :
                $tip = 'Student';
                $data = $this->prepareStudentDetails($userEmail, $userCrmId);
                break;

            case 'Profesor' :
                $tip = 'Profesor';
                $data =  $this->prepareProfesorDetails($userEmail, $userCrmId);
                break;

            default : die('no data available');
        }


        return view('vendor.voyager.index',
            ['user_type' => $tip],
            ['data' => $data]
        );

        // return view('vendor.voyager.index')->with('user', $user)
        //     ->with('utilizator', $crmResponse)
        //     ->with('business', $businessData);
    }

    public function prepareStudentDetails($email, $crmId)
    {
        $start = microtime(true);

        $cacheKey = 'student_details'.$email.$crmId;

        if (Cache::has($cacheKey)) {
           return Cache::get($cacheKey);
        }

        $cards = CrmStudent::where('email', '=', $email)->orderBy('crm_id', 'desc')->get();

        $data = [];
        $data['TipUser'] = 'Student';

        $i =  0;

        foreach ($cards as $entry) {

            $bulkData = [];

            //detalii principale
            $crmDetails = MiniCrmController::getStudentDetails($entry->crm_id);
            $bulkData['Nume'] = strtok($crmDetails['Name'], '(') ;

            $bulkData['Detalii'] = $crmDetails;

            //detalii tabara
            $crmTabaraId = $crmDetails['IdTabaraLink'];
            //daca nu are tabara asociata nu mai facem call in crm api
            if ($crmTabaraId) {
                $crmTabaraData = MiniCrmController::getTabaraDetails($crmTabaraId);
                $bulkData['Tabara'] = $crmTabaraData;

                //detalii card business
                $crmBusinessId = $crmDetails['BusinessId'];
                $crmBusinessData = MiniCrmController::getBusinessDetails($crmBusinessId);
                $businessData['Tags'] = '';
                $bulkData['Business'] = $crmBusinessData;

                //detalii copil?
                $crmContactId = $crmDetails['ContactId'];
                $crmContactData = MiniCrmController::getContactDetails($crmContactId);
                $bulkData['Contact'] = $crmContactData;

                //agregare
                $data['Carduri'][$i] = $bulkData;
            }

            $i++;
        }

        //dd($data);

        echo("Timp executie: ".$time_elapsed_secs = microtime(true) - $start);


        Cache::put( $cacheKey, $data, '7200'); //o ora in cache

        return $data;
    }


    public function prepareProfesorDetails($email, $crmId)
    {
        $start = microtime(true);

        $cacheKey = 'professor_details'.$email.$crmId;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $cards = CrmProfessor::where('email', '=', $email)->orderBy('crm_id', 'desc')->get();

        $data = [];
        $data['TipUser'] = 'Profesor';

        //daca are mai multe entries inseamna ca are mai multe tabare in formare
//        if (count($cards) > 1) {
//            $data['TipUser'] = 'ProfesorTabereMultiple';
//        }

        $i =  0;

        foreach ($cards as $entry) {

            $bulkData = [];

            //detalii principale
            $crmDetails = MiniCrmController::getProfessorDetails($entry->crm_id);
            //dd($crmDetails);
            $bulkData['Nume'] = strtok($crmDetails['Name'], '(');
            $bulkData['Detalii'] = $crmDetails;

            //detalii tabara
            $crmTabaraId = $crmDetails['IdTabaraLink2'];
            //daca nu are tabara asociata nu mai facem call in crm api
            if ($crmTabaraId) {
                $crmTabaraData = MiniCrmController::getTabaraDetails($crmTabaraId);
                $bulkData['Tabara'] = $crmTabaraData;

                //detalii card business
                $crmBusinessId = $crmDetails['BusinessId'];
                $crmBusinessData = MiniCrmController::getBusinessDetails($crmBusinessId);
                $businessData['Tags'] = '';
                $bulkData['Business'] = $crmBusinessData;

                //detalii copil?
                $crmContactId = $crmDetails['ContactId'];
                $crmContactData = MiniCrmController::getContactDetails($crmContactId);
                $bulkData['Contact'] = $crmContactData;

                //agregare
                $data['Carduri'][$i] = $bulkData;
            }

            $i++;
        }

        //verificam daca are si copii
        $studentCards = CrmStudent::where('email', '=', $email)->orderBy('crm_id', 'desc')->get();

        //daca nu are copii
        if(!$studentCards) {
            return $data;
        } else {
            //parcurgem logica ptr copii
            $data['TipUser'] = 'ProfesorElev';

            $i =  0;

            foreach ($studentCards as $entry) {

                $bulkData = [];

                //detalii principale
                $crmDetails = MiniCrmController::getStudentDetails($entry->crm_id);
                $bulkData['Nume'] = strtok($crmDetails['Name'], '(') ;

                $bulkData['Detalii'] = $crmDetails;

                //detalii tabara
                $crmTabaraId = $crmDetails['IdTabaraLink'];
                //daca nu are tabara asociata nu mai facem call in crm api
                if ($crmTabaraId) {
                    $crmTabaraData = MiniCrmController::getTabaraDetails($crmTabaraId);
                    $bulkData['Tabara'] = $crmTabaraData;

                    //detalii card business
                    $crmBusinessId = $crmDetails['BusinessId'];
                    $crmBusinessData = MiniCrmController::getBusinessDetails($crmBusinessId);
                    $businessData['Tags'] = '';
                    $bulkData['Business'] = $crmBusinessData;

                    //detalii copil?
                    $crmContactId = $crmDetails['ContactId'];
                    $crmContactData = MiniCrmController::getContactDetails($crmContactId);
                    $bulkData['Contact'] = $crmContactData;

                    //agregare
                    $data['Elevi'][$i] = $bulkData;
                }

                $i++;
            }


        }


        echo("Timp executie: ".$time_elapsed_secs = microtime(true) - $start);
        //dd($data);
        Cache::put( $cacheKey, $data, '7200'); //2 ore cache

        return $data;
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
