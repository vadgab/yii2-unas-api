<?


require "../src/UnasApi.php";

//use vadgab\UnasApi;



$apicall = new UnasApi('84ab11ca4f4859d00a27875266e14ccb0c5d6a65');


var_dump($apicall->login());



?>