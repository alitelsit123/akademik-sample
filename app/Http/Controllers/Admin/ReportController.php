<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class ReportController extends Controller
{
    public function index() {
        return view('admin.report');
    }
    public function preview($id) {
        $student = User::findOrFail($id);
        return view('admin.report-preview', compact('student'));
    }
}
