@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="row"> 
            <div class="col-8 offset-2">
                <div class="row"><h2>Add a new post</h2></div>
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Post Caption</label>

                        <input
                        id="caption" 
                        type="text" 
                        class="form-control @error('caption') is-invalid @enderror" 
                        name="caption" 
                        value="{{ old('caption') }}" 
                        required autocomplete="caption" 
                        autofocus>

                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>

                    <input type="file" class='form-control-file' id='image' name='image'>

                    @error('image')
                    
                        <strong>{{ $message }}</strong>
                    
                    @enderror
                </div>

                <div class="row pt-3">

                    <button type='submit' class='btn btn-primary'>Add post</button>

                </div>
            </div>
        </div>  
    </form>
</div>
@endsection
