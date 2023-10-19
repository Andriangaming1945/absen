@extends('main')

@section('slot')
    <form action="/change-password" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="edit-password" class="form-label">Now Password</label>
            <input type="password" class="form-control" id="edit-password" name="password" placeholder="Password">
        </div>
        <div class="mb-3">
            <label for="edit-password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="edit-password" name="password" placeholder="Password">
        </div>
        <button class="btn btn-sm btn-primary">Submit</button>
    </form>
@endsection
