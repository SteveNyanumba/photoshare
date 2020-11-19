@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Create Post</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('photos.store') }}">
                        @csrf
                        <div class="form-group">
                          <label for="image">Photo</label>
                          <input type="file" class="form-control-file" name="image" id="image" placeholder="Choose your image" >
                          <small id="image" class="form-text text-muted">Choose a suitable Picture to post</small>
                        </div>
                        <div class="form-group">
                          <label for="caption">Caption</label>
                          <textarea class="form-control" name="caption" id="caption" rows="3"></textarea>
                          <small id="caption" class="form-text text-muted">Enter your Caption</small>
                        </div>
                        <div class="form-group">
                          <label for="location">Location</label>
                          <select class="form-control" name="location" id="location">
                            <option selected disabled>Select your Location</option>
                            <option value="Nairobi">Nairobi</option>
                            <option value="Kisumu">Kisumu</option>
                            <option value="Mombasa">Mombasa</option>
                            <option value="Eldoret">Eldoret</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tagname">Tagname</label>
                          <select multiple class="form-control" name="tagname" id="tagname">
                            <option value="Fire">Fire</option>
                            <option value="Ice">Ice</option>
                            <option value="Sugar">Sugar</option>
                            <option value="Spice">Spice</option>
                            <option value="Nice">Nice</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
