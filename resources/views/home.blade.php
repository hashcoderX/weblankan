@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addmembermodel">
                            Add Member +
                        </button>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row">
                    <div id="notification"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->address }}</td>
                                    <td><button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#addmembermodel">Add +</button>
                                        <button class="btn btn-primary edit-button" onclick="setEditDetails(this.id)"
                                            id="{{ $member->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editmodal">Edit</button>
                                        <button class="btn btn-danger delete-button" onclick="MemberD()"
                                            data-member-id="{{ $member->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="links">
                        <span> {{ $members->links() }} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Register Modal -->
    <div class="modal fade" id="addmembermodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Member Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="/addmember">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Address" required>
                            </textarea>

                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Edit Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Member Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="/addmember">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Member Id</label>
                            <input type="text" class="form-control" id="memberid" name="memberid" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" id="namee" name="namee" placeholder="Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">E-mail</label>
                            <input type="email" class="form-control" id="emaile" name="emaile"
                                placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Address</label>
                            <textarea class="form-control" id="addresse" name="addresse" placeholder="Address" required>
                            </textarea>

                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function MemberD() {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {

            const memberId = button.getAttribute('data-member-id');
            destroyMember(memberId);

        });
    }

    function destroyMember(memberId) {
        $.ajax({
            url: "/destroymember",
            method: "GET",
            data: {
                memberId: memberId,
            },
            success: function(data) {
                document.getElementById("notification").innerHTML = data.message;
            }
        });
    }

    function setEditDetails(memberId) {
        $.ajax({
            url: "/getmemberdetails",
            method: "GET",
            data: {
                memberId: memberId,
            },
            success: function(data) {
                document.getElementById("memberid").value = data.member.id;
                document.getElementById("namee").value = data.member.name;
                document.getElementById("emaile").value = data.member.email;
                document.getElementById("addresse").value = data.member.address;
            }
        });

    }
</script>
