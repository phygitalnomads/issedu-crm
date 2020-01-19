<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CrmStudent;

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
        return $this->getProfs(1);
        return $this->getStudentDetails(55557);



    //        $key = 'QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft';
    //        $url = 'https://SystemId:'.$key.'@r3.minicrm.hu/Api/R3/Category?Detailed=1';
    //        $url2 = 'https://QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3.minicrm.hu/Api/R3/Category?Detailed=1';
    //Creating the URL
    $Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Project?CategoryId=22';
    $Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Category?Detailed=1';
    #$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Schema/Project/22';

    //$Url = 'https://37326:QYJcCH5Bd6y9s24IiERnfNXOMKGD07Ft@r3-test.minicrm.hu/Api/R3/Project?Query=Uimaaeur';


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

/*
 * Get students
 * gets first 100 by default
 * param $page => number of page (maxim 286 pe test)
 */
    public function getStudents($page = 1, $deleted = 0)
    {
        //$url = $this->buildUrl('Project?CategoryId=22&Page='.$page);
        $url = $this->buildUrl('Project?CategoryId=22&Deleted='.$deleted.'&Page='.$page);
        $students = $this->makeCurlCall($url);

        //dd($students);

        foreach ($students['Results'] as $key => $student) {

            $crmStudent = new CrmStudent();

            $crmStudent->crm_id = $student['Id'];
            $crmStudent->name = $student['Name'];
            $crmStudent->url = $student['Url'];
            $crmStudent->contact_id = $student['ContactId'];
            $crmStudent->status_id = $student['StatusId'];
            $crmStudent->user_id = $student['UserId'];
            $crmStudent->deleted = $student['Deleted'];

            if(isset($student['BusinessId'])) $crmStudent->business_id = $student['BusinessId'];

            $crmStudent->save();

            CrmStudent::updateOrCreate(
                ['crm_id' => $student['Id']],
                    [
                        'name' => $student['Name'],
                        'url' => $student['Url'],
                        'contact_id' => $student['ContactId']
                    ]
            );

        }

        dd($students);
    }

    public function getProfs($page = 1)
    {
        $url = $this->buildUrl('Project?CategoryId=26&Page='.$page);
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
