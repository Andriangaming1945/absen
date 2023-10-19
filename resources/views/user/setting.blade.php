@extends('main')

@section('slot')
<h3 class="mb-3">Setting</h3>
<form action="/setting/update-profile" method="post">
    @csrf
    @method('put')
    <h5>Update Profile</h5>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="edit-name" class="form-label">Name</label>
                <input type="text" class="form-control" id="edit-name" name="name" value="{{ '' ?? $user->name }}" placeholder="Name">
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="edit-username" class="form-label">Username</label>
                <input type="number" class="form-control" id="edit-username" name="username" value="{{ '' ?? $user->username }}" placeholder="Ex: 11110000">
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="edit-phone" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="edit-phone" name="phone" value="{{ '' ?? $user->username }}" placeholder="Ex: 11110000">
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label for="edit-address" class="form-label">Address</label>
                <input type="text" class="form-control" id="edit-address" name="address" value="{{ '' ?? $user->username }}" placeholder="Jln..">
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="" class="form-control" id=""></select>
                {{-- <x-select :selects="$roles" key="name" value="id" param="roles" :selected="'' ?? (String)  $user->roles[0]->id" /> --}}
            </div>
        </div>
    </div>
    <button class="btn btn-sm btn-primary">Submit</button>
</form>

@endsection
