<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\CrmStudent;
use App\CrmProfessor;
use App\User;

class MiniCrmController extends Controller
{
    //

    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = \config('minicrm.key');
    }

    public static function buildUrl($params)
    {

        return \config('minicrm.url').$params;
    }


    public function testcrm(Request $request)
    {
        $key = isset($request->key) ? $request->key : null;
        if ($key !== $this->apiKey) die('Cheie access incorecta!');

        dd(self::getContactDetails(60887));
//        dd(self::getStudentDetails(14721));
//        dd(self::getProfessorDetails(40713));
//        dd(self::getTabaraDetails(57184));

        dd($this->getStudents());

    }


    public function crm(Request $request)
    {
        $key = isset($request->key) ? $request->key : null;
        if ($key !== $this->apiKey) die('Cheie access incorecta!');

        $page = isset($request->page) ? (int)$request->page : 1;

        $statusId = isset($request->statusid) ? (int)$request->statusid : null; //2834 -> inscris
        if (!$statusId) {
            echo('Linkul trebuie sa contina status id-ul cardului. Ex: &statusid=2834 - elev inscris<br><br>');
            echo $this->showStatuses();
            die();
        };

        $tip = isset($request->tip) ? $request->tip : null;
        $test = isset($request->test) ? $request->test : 1;

        if ($tip === 'student') return $this->getStudents($page, 0, $statusId, $test);
        if ($tip === 'profesor') return $this->getProfs($page, 0, $statusId, $test);

        die('Trebuie specificat tipul cardului! Ex: &tip=student sau &tip=profesor');


//        $url =  'https://37326:c0HIVhKFtLB2Wrf1U4u3NZQXTdvOqoGl@r3.minicrm.hu/Api/R3/';
    //return $this->getProfs(1);
    //return $this->getStudentDetails(55557);
    //        $key = 'QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft';
    //        $url = 'https://SystemId:'.$key.'@r3.minicrm.hu/Api/R3/Category?Detailed=1';
    //        $url2 = 'https://QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3.minicrm.hu/Api/R3/Category?Detailed=1';
    //Creating the URL
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Project?CategoryId=22';
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Category?Detailed=1';
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Schema/Project/26';
    //adresa
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Email/48017';
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Project?Query=Vvppioi';
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Project?GroupId=620';
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Contact?Query=Vvppioi';
    //call cu business id 48017
    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Contact/48017';
    //returneaza nume si adresa email ptr profesor indrumator
    //$Url = $url.'Contact/20410'; //returneaza detaliile de pe business cardul 20410
    //$Url = $url.'AddressList/20410'; //returneaza address listul ptr contactul 20410
    //$Url = $url.'Project/26280';
    //$Url = $url.'Project/26494';
    //$Url = $url.'Project/57324';
    //$Url = $url.'Contact/62844';
    //    $Url = $url.'Contact/64035';
    //$Url = $url.'Project?CategoryId=23&UserId=-1&Query=Royal%20Russell%20School%20-%20Londra';
    //$Url = $url.'Schema/Project/22'; //schema detaliata a DB
    //$Url = $url.'Contact?Email=oanaghinea2000@yahoo.com';
    //$Url = $url.'Project/48110';
    //$Url = $url.'Contact/21693';
    //$Url = $url.'Contact/48110';
//    echo $Url;

    //Initializing the Curl
        $Curl = curl_init();
        curl_setopt($Curl, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER , false);

    //Handover the URL to the Curl
        curl_setopt($Curl, CURLOPT_URL, $Url);

    //Execute the Curl request
        $Response = curl_exec($Curl);
    //        var_dump($Response);
    //        dd($Response);
    //Check for any errors in the Curl request
        if(curl_errno($Curl)) $Error = "Eroare: ".curl_error($Curl);

    //Request for the HTML response code
        $ResponseCode = curl_getinfo($Curl, CURLINFO_HTTP_CODE);
        if($ResponseCode != 200) $Error = "API error code: {$ResponseCode} - Message: {$Response}";

    //Closing the Curl
        curl_close($Curl);

    //Decoding and exporting the JSON response
        $Response = json_decode($Response, true);

        dd($Response);


    }


    /* Function used to get student details from miniCrm
     *
     * Params int $idStudent
     *
     */
    public static function getStudentDetails($idStudent)
    {
        $url = self::buildUrl('Project/'.$idStudent);
        $student = self::makeCurlCall($url);

       return $student;
    }

    /* Function used to get prefessor details from miniCrm
    *
    * Params int $idProfesor
    *
    */
    public static function getProfessorDetails($idProfesor)
    {
        $url = self::buildUrl('Project/'.$idProfesor);
        $profesor = self::makeCurlCall($url);

        return $profesor;
    }

    public static function getTabaraDetails($idTabara)
    {
        $url = self::buildUrl('Project/'.$idTabara);
        $tabara = self::makeCurlCall($url);

        return $tabara;
    }

    public static function getBusinessDetails($businessId)
    {
        $url = self::buildUrl('Contact/'.$businessId);
        $data = self::makeCurlCall($url);

        return $data;
    }

    public static function getContactDetails($contactId)
    {
        $url = self::buildUrl('Contact/'.$contactId);
        $data = self::makeCurlCall($url);

        return $data;
    }



    /*
    * Get students
    * gets first 100 by default
    * param $page => number of page (maxim 286 pe test)
    */
    public function getStudents($page = 0, $deleted = 0, $statusId = 2834, $test = 1)
    {
//
//        $StatusId => //ptr project 22 - elevi
//            2833 => "Oportunitate nouă"
//            2847 => "Prim contact"
//            2838 => "Ofertare pe email"
//            2832 => "Follow-up oferta"
//            3029 => "De finalizat"
//            2848 => "Confirmare date"
//            2849 => "Proforma"
//            3028 => "Retras / Anulat / Razgandit"
//            2987 => "In asteptare"
//            2836 => "Oportunitate pierduta"
//            de aici folosim status ids
//            2834 => "Inscris"
//            2850 => "Plata integrala"
//            3009 => "Inscris direct la partener"
//            3030 => "Copil profesor - neplatit"
//            3031 => "Copil profesor - platit"
//            3052 => "Copil sub varsta acceptată"

        $urlSecondPart = 'Project?CategoryId=22&Deleted='.$deleted.'&Page='.$page.'&StatusId='.$statusId;

        $url = $this->buildUrl($urlSecondPart);
        $students = $this->makeCurlCall($url);

        echo "Mod test: ".$test."</br>";
        echo "Linkul catre crm api: ".$urlSecondPart;

        if ($test) dd($students);

        foreach ($students['Results'] as $key => $student) {

            // $crmStudent = new CrmStudent();
            // $crmStudent->crm_id = $student['Id'];
            // $crmStudent->name = $student['Name'];
            // $crmStudent->url = $student['Url'];
            // $crmStudent->contact_id = $student['ContactId'];
            // $crmStudent->status_id = $student['StatusId'];
            // $crmStudent->user_id = $student['UserId'];
            // $crmStudent->deleted = $student['Deleted'];
            //$crmStudent->save();

            //check if response has business id in order to get the email address
            if (isset($student['BusinessId'])) {
                $business_id = $student['BusinessId'];

                //get business data
                $businessData = $this->getBusinessDetails($business_id);

                //check for email
                if ($businessData['Email']) {
                    //if has email add it to crm_students table and create user
                    CrmStudent::updateOrCreate(
                        ['crm_id' => $student['Id']],
                            [
                                'email' => $businessData['Email'],
                                'name' => $student['Name'],
                                'url' => $student['Url'],
                                'contact_id' => $student['ContactId'],
                                'status_id' => $student['StatusId'],
                                'user_id' => $student['StatusId'],
                                'deleted' => $student['Deleted'],
                                'business_id' => $business_id
                            ]
                    );

                    //check if user already exists in DB
                    $user = User::where('email', '=', $businessData['Email'])->first();

                    if ($user === null) {
                        //create user with default password issedu
                        $user = new User();
                        $user->password = Hash::make('issedu');
                        $user->email = $businessData['Email'];
                        $user->name = $student['Name'];
                        $user->crm_id = $student['Id'];
                        $user->user_type = 'Student';
                        //add role to user - student is 3. prof is 4
                        $user->role_id = 3;
                        //$user->settings = '{"locale":"ro"}'; //problem with Json type

                        $user->save();

                        //add role to user - student is 3. prof is 4
                        DB::table('user_roles')->insert(
                            ['user_id' => $user->id, 'role_id' => '3']
                        );

                    }
                    
                }

            } else echo "Contact data email nu exista ptr: ".$student['Id'].'<br>';
        }

        dd($students);
    }
//    public function getProfs($page = 0)
//    {
//        $url = $this->buildUrl('Project?CategoryId=26&Page='.$page);
//        $profs = $this->makeCurlCall($url);
//
//        dd($profs);
//    }
//
    public function getProfs($page = 0, $deleted = 0, $statusId = 2873, $test = 1)
    {

        $urlSecondPart = 'Project?CategoryId=26&StatusId='.$statusId.'&Deleted='.$deleted;

        $url = $this->buildUrl($urlSecondPart);
        $profs = $this->makeCurlCall($url);

        echo "Mod test: ".$test."</br>";
        echo "Linkul catre crm api: ".$urlSecondPart;

        if ($test) dd($profs);

        //insert prof in DB
        foreach ($profs['Results'] as $key => $prof) {

            //check if response has business id in order to get the email address
            if (isset($prof['ContactId'])) {
                $contactId = $prof['ContactId'];

                //get business data
                $contactData = MiniCrmController::getContactDetails($contactId);

                //check for email
                if ($contactData['Email']) {
                    //if has email add it to crm_professors table and create user
                    CrmProfessor::updateOrCreate(
                        ['crm_id' => $prof['Id']],
                        [
                            'email' => $contactData['Email'],
                            'name' => $prof['Name'],
                            'url' => $prof['Url'],
                            'contact_id' => $prof['ContactId'],
                            'status_id' => $prof['StatusId'],
                            'user_id' => $prof['StatusId'],
                            'deleted' => $prof['Deleted'],
                            'business_id' => $contactId
                        ]
                    );

                    //check if user already exists in DB
                    $user = User::where('email', '=', $contactData['Email'])->first();

                    if ($user === null) {
                        //create user with default password issedu
                        $user = new User();
                        $user->password = Hash::make('issedu');
                        $user->email = $contactData['Email'];
                        $user->name = $prof['Name'];
                        $user->crm_id = $prof['Id'];
                        $user->user_type = 'Profesor';
                        //add role to user - student is 3. prof is 4
                        $user->role_id = 4;
                        //$user->settings = '{"locale":"ro"}'; //problem with Json type

                        $user->save();

                        //add role to user - student is 3. prof is 4
                        DB::table('user_roles')->insert(
                            ['user_id' => $user->id, 'role_id' => '4']
                        );

                    }
                    //schimba tipul userului -> profesorelev
                    //functioneaza doar prima data - la un nou cron o sa suprascrie tot
                    else  {
                        echo "Userul cu emailul: ".$contactData['Email']." exista deja in DB<br>";
                        echo "Modificat userul cu emailul ".$contactData['Email']." din Elev in Profesor<br>";
                        $user->user_type='Profesor';
                        $user->crm_id = $prof['ContactId'];
                        $user->role_id = 4;
                        $user->save();

                        DB::table('user_roles')
                            ->where('user_id', $user->id)
                            ->update(['role_id' => 4]);
                    }

                } else echo "Contact data email nu exista ptr: ".$prof['Id'].'<br>';

            }
        }
        dd($profs);

    }

    public function showStatuses()
    {

        return 'Elevi:<br>
        2834 => "Inscris"<br>
        2850 => "Plata integrala"<br>
        3009 => "Inscris direct la partener"<br>
        3030 => "Copil profesor - neplatit"<br>
        3031 => "Copil profesor - platit"<br>
        3052 => "Copil sub varsta acceptată"<br>
        3028 => "Retras / Anulat / Razgandit"<br><br>
        Profesori:<br>
        2873 => "Formare grup"<br>';
    }

    public static function makeCurlCall($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER , false);

        curl_setopt($curl, CURLOPT_URL, $url);

        $response = curl_exec($curl);

        if(curl_errno($curl)) $Error = "Eroare: ".curl_error($curl);

        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($responseCode != 200) $Error = "API error code: {$responseCode} - Message: {$response}";

        curl_close($curl);

        return json_decode($response, true);
    }
}
