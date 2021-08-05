<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;

use \App\Models\User;


class StudentController extends Controller
{
	public function index()
	{
		$user = User::where('id_role', 3)->get();
		return view('student.index', compact('user'));
	}

	public function destroy(Request $request)
	{
		foreach ($request->check as $id) {
			User::where('id', $id)->delete();
		}

		return back();
	}
}
