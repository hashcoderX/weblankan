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
        Member::where("id", $id)->delete();

        // response
        return response()->json(['message' => 'Member deleted successfully']);
    }

    public function memberdetail()
    {
        $id = $_GET['memberId'];
        $member = Member::find($id);

        return response()->json([
            'status' => 200,
            'member' => $member,
        ]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'memberid'  => 'required',
            'namee'  => 'required',
            'emaile'  => 'required',
            'addresse'  => 'required',
        ]);

        $id = $request->memberid;

        if (Member::where("id", $id)) {
            $member = Member::find($id);
            $member->name = $request->namee;
            $member->email = $request->emaile;
            $member->address = $request->addresse;

            $member->save();

            return redirect()->back();
        }
    }

    public function getmember(Request $request)
    {
        $value =  $request->value;
        $output = "";

        $members = Member::where('email', 'LIKE', '%' . $value . '%')
            ->get();

        foreach ($members as $member) {
            $output .=
                '<tr>
              <td> ' . $member->name . ' </td>
              <td> ' . $member->email . ' </td>
              <td> ' . $member->address . ' </td>
              <td><button class="btn btn-success" data-bs-toggle="modal"
              data-bs-target="#addmembermodel">Add +</button>
              
              <button class="btn btn-primary edit-button" onclick="setEditDetails(this.id)"
                                            id="' . $member->id . '" data-bs-toggle="modal"
                                            data-bs-target="#editmodal">Edit</button>
                                            <button class="btn btn-danger delete-button" onclick="destroyMember(this.id)"
                                            id="'.$member->id.'">Delete</button>
              
              </td>

              </tr>';
        }

        return response($output);
    }
}
