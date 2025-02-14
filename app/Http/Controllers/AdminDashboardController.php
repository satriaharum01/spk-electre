<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        //$this->middleware('is_admin');
    }

    /*
     * Dashboad Function
    */
    public function index()
    {
        $this->data['title'] = 'Dashboard Admin';
        $this->data['c_patients'] = 0;
        $this->data['c_doctors'] = 0;
        $this->data['c_appointments'] = 0;
        $this->data['c_payments'] = 0;

        $this->data['chart'] = $this->graph_area();
        return view('admin/dashboard/index', $this->data);
    }



    //COUNTERS
    public function count_patients()
    {
        $data = Patients::select('*')->count();

        return $data;
    }

    public function count_doctors()
    {
        $data = Doctors::select('*')->count();

        return $data;
    }

    public function count_appointments()
    {
        $data = Appointments::select('*')->count();

        return $data;
    }

    public function count_payments()
    {
        $data = Billing::select('*')->where('payment_status', 'Paid')->sum('total_amount');

        return number_format($data, 0);
    }

    //GRAPH
    public function graph_area()
    {
        $out = array();
        $date = date('Y-');
        for ($i = 1; $i <= 12 ; $i++) {
            if ($i < 10) {
                $finder = $date.'0'.$i;
            } else {
                $finder = $date.$i;
            }
            $data = Alternatif::select('*')->where('created_at', '>=', $finder.'-00')->where('created_at', '<=', $finder.'-31')->get();
            $result = 0;
            $out[] = $result;
        }

        return json_encode($out);
    }
}
