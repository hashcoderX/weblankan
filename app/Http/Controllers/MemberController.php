<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email'  => 'required',
            'address'  => 'required',
        ]);

        $member = new Member();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->address = $request->address;

        $member->save();

        return redirect()->back();
    }

    public function destroy()
    {
        // member Id 
        $id = $_GET['memberId'];

        $member = Member::findOrFail($id);
        $member->delete();

        // response
        return response()->json(['message' => 'Member deleted successfully']);
    }

    public function memberdetail(){
        $id = $_GET['memberId'];
        $member = Member::find($id);

        return response()->json([
            'status' => 200,
            'member' => $member,
        ]);
    }
}
