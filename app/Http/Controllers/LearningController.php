<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Learning;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Session::get('id_role')==1) {
        $learning = Learning::latest()->get();
        return view('learning.admin', compact('learning'));
      } elseif (Session::get('id_role')==2) {
        $user = User::where('email', Session::get('email'))->first();
        $learning = Learning::where('id_category', $user->id_category)->latest()->get();
        return view('learning.lecturer', compact('learning', 'user'));
      } else {
        return view('learning.student');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = User::where('email', Session::get('email'))->first();
      return view('learning.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = User::where('email', Session::get('email'))->first();

      $request->validate([
        'title' => 'required|unique:learnings,title',
        'material' => 'required',
      ]);

      Learning::create([
        'id_lecturer' => $user->id,
        'id_category' => $user->id_category,
        'title' => htmlspecialchars($request->title),
        'slug' => Str::slug(htmlspecialchars($request->title), '-'),
        'material' => $request->material,
      ]);

      return redirect('/learning')->with('message', "<script>swal('Selamat!', 'Selamat materi anda berhasil dibuat!', 'success');</script>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $learning = Learning::where('slug', $slug)->first();
      if ($learning) {
        return view('learning.show', compact('learning'));
      } else {
        abort(404);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $learning = Learning::where('slug', $slug)->first();
      if ($learning) {
        return view('learning.edit', compact('learning'));
      } else {
        abort(404);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      Learning::where('id', $id)->update([
        'title' => htmlspecialchars($request->title),
        'slug' => Str::slug(htmlspecialchars($request->title), '-'),
        'material' => $request->material,
      ]);

      return redirect('/learning')->with('message', "<script>swal('Selamat!', 'Selamat materi anda berhasil diupdate!', 'success');</script>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {

      $learning = Learning::where('slug', $slug)->first();

      Learning::destroy($learning->id);

      return redirect('/learning')->with('message', "<script>swal('Selamat!', 'Selamat materi anda berhasil dihapus!', 'success');</script>");
    }
  }
