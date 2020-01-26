<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\CrmStudent;
use App\User;

class MiniCrmController extends Controller
{
    //


    public static function buildUrl($params)
    {

        return \config('minicrm.url').$params;
    }

    public function index(Request $request)
    {
         return $this->getStudents(1, 0);
        //return $this->getProfs(1);
        // return $this->getStudentDetails(55557);



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

    $url =  'https://37326:c0HIVhKFtLB2Wrf1U4u3NZQXTdvOqoGl@r3.minicrm.hu/Api/R3/';
    //$Url = $url.'Contact/20410'; //returneaza detaliile de pe business cardul 20410
    //$Url = $url.'AddressList/20410'; //returneaza address listul ptr contactul 20410
    //$Url = $url.'Project/26280';
    //$Url = $url.'Project/26494';
    //$Url = $url.'Project/57324';
    //$Url = $url.'Contact/62844';
        $Url = $url.'Contact/62843';
    //$Url = $url.'Project?CategoryId=23&UserId=-1&Query=Royal%20Russell%20School%20-%20Londra';
    //$Url = $url.'Project/14705';
    //$Url = $url.'Schema/Project/23'; //schema detaliata a DB

    echo $Url;
    ///Project/26478 returneaza elevul cu id 26479

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

    public static function getBusinessDetails($businessId)
    {
        $url = self::buildUrl('Contact/'.$businessId);
        $data = self::makeCurlCall($url);

        return $data;
    }

    /*
    * Get students
    * gets first 100 by default
    * param $page => number of page (maxim 286 pe test)
    */
    public function getStudents($page = 1, $deleted = 0)
    {
        //$url = $this->buildUrl('Project?CategoryId=22&Page='.$page);
        //status 2834 = inscris
        $url = $this->buildUrl('Project?CategoryId=22&Deleted='.$deleted.'&Page='.$page.'&StatusId=2834');
        $students = $this->makeCurlCall($url);

        //dd($students);

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
                    //if has email add it tocrm_stundets table and create user
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

            }
        }

        dd($students);
    }

    public function getProfs($page = 1)
    {
        //$url = $this->buildUrl('Project?CategoryId=26&Page='.$page);
        $url = $this->buildUrl('Project?CategoryId=26&StatusId=2873&Deleted=0');
        //toti profii cu status formare grup
        $profs = $this->makeCurlCall($url);

        dd($profs);
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
