@extends('dashboard::layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Create Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter Slider Title" name="title">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" placeholder="Enter Slider Subtitle" name="subtitle">
                      @error('subtitle')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="url" class="form-control" id="link" placeholder="Enter Slider Link" name="link">
                              @error('link')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9\.]|(\.(?=.*\.))/g, '');" class="form-control" id="price" name="price">
                            @error('price')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
              </div><!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div><!-- /.card -->
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

@push('scripts')
    <script src="{{asset('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(function () {
          bsCustomFileInput.init();
        });
    </script>
@endpush