@extends('dashboard::layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Create Product</h3>
            </div>
            <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="name">
                              @error('name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="categort" name="category_id">
                                <option>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                              @error('category_id')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label for="">Price</label>
                          <input type="text" oninput="this.value = this.value.replace(/[^0-9\.]|(\.(?=.*\.))/g, '');" class="form-control" name="price">
                      </div>
                  </div>
                  <div class="col form-group">
                      <label for="">Quantity</label>
                      <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" name="quantity">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="short_description">Short Description</label>
                      <input type="text" class="form-control" name="short_description" id="short_description" value="{{old('short_description')}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description">{{old('description')}}</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputFile">Product Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputFile">Product thumbnails</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="images[]" multiple>
                                <label class="custom-file-label" for="images">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>
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