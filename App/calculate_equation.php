<?php
include "../config/dbconfig.php";
require_once(__DIR__."/DB.php");
require_once(__DIR__."/Equation.php");

use App\DB;
use App\Equation;

$config = [
    'host' => '127.0.0.1',
    'database' => 'equation_slover',
    'username' => 'root',
    'password' => ''
];

DB::init($config);

$error = null;
$data   = array();

$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];


$x1 = null;
$x2 = null;

$res = DB::returnResFromDatabase($a, $b, $c);

if ($res) {
    $x1 = $res["x1"];
    $x2 = $res["x2"];
} else {
    $equation = new Equation($a, $b, $c);

    $solutions = $equation->solve();

    if ($solutions) {
        $x1 = $solutions[0];
        $x2 = $solutions[1];
        
        DB::insertNewEquation($a, $b, $c, $x1, $x2);
    } else {
        $error = 'Nu exista solutii';
    }

}
    
$data['data'] = ["x1" => $x1, "x2" => $x2];
$data['error'] = $error;


echo json_encode($data);