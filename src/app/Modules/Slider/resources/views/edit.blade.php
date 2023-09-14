@extends('dashboard::layouts.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create slider</h3>
                </div>
                <form method="POST" action="{{route('sliders.update', $slider->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  <div class="card-body">
                        <div class="form-group">
                          <label for="name">title</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter slider Title" name="title" value="{{old('title', $slider->title)}}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">SubTitle</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter slider Subtitle" name="subtitle" value="{{old('subtitle', $slider->subtitle)}}">
                              @error('subtitle')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" id="link" placeholder="Enter Slider Link" name="link" value="{{old('link', $slider->link)}}">
                                      @error('link')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9\.]|(\.(?=.*\.))/g, '');" class="form-control" id="price" name="price" value="{{old('price', $slider->price)}}">
                                    @error('price')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputFile">slider Image</label>
                                    <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    </div>
                                    <div class="mt-2">
                                        @php
                                                $img = $slider->image;
                                                if (!file_exists($img)) {
                                                    $img = 'uploads/' . $img;
                                                }
                                        @endphp 
                                        <img src="{{ asset($img) }}" alt="slider Image" class="img-thumbnail" width="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                  <!-- /.card-body -->
    
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>

              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
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