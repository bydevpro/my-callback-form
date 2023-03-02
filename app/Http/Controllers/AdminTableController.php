<?php
namespace App\Http\Controllers;

use App\Models\Callback;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminTableController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
->join('callback', 'users.id', '=', 'callback.user_id')
->select('users.name', 'users.email', 'callback.*')
->get(); 
//json нужно учить.....
$data = json_decode($data);
return view('admin', compact('data'));
//return $data;    
    }
}
