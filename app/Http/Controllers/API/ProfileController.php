<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Request success!',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nim' => 'required|numeric',
            'name' => 'required',
            'whatsapp' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 403);
        }

        $user = User::findOrFail($id);

        $user->where('id', $id)->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'whatsapp' => $request->whatsapp,
            'id_class' => $request->class,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Update success!',
            'data' => $user
        ], 200);
    }
}
