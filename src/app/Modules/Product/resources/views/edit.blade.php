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
                <form method="POST" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="name" value="{{old('name', $product->name)}}">
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
                                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}} >
                                            {{$category->name}}
                                        </option>
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
                              <input type="text" oninput="this.value = this.value.replace(/[^0-9\.]|(\.(?=.*\.))/g, '');" class="form-control" name="price" value="{{old('price', $product->price)}}">
                          </div>
                      </div>
                      <div class="col form-group">
                          <label for="">Quantity</label>
                          <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" name="quantity" value="{{old('quantity', $product->quantity)}}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="short_description">Short Description</label>
                          <input type="text" class="form-control" name="short_description" id="short_description" value="{{old('short_description', $product->short_description)}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description">{{old('description', $product->description)}}</textarea>
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
                                <div class="mt-2">
                                    @php
                                            $img = $product->image;
                                            if (!file_exists($img)) {
                                                $img = 'uploads/' . $img;
                                            }
                                     @endphp 
                                    <img src="{{ asset($img) }}" alt="Product Image" class="img-thumbnail" width="100">
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
                                @if ($product->images)
                                    @foreach ($product->images as $image)
                                    <div class="d-inline-block m-2">
                                        @php
                                            $img = $image->image;
                                            if (!file_exists($img)) {
                                                $img = 'uploads/' . $img;
                                            }
                                        @endphp 
                                        <img src="{{ asset($img) }}" alt="Thumbnail Image" class="img-thumbnail" width="100">
                                        <button type="button" class="btn btn-danger btn-sm mt-2" data-toggle="modal" data-id="{{ $image->id }}">Delete</button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
    
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>

                 <!-- Delete Confirmation Modal -->
                 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this image?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form method="POST" action="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        
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

<script>
  document.querySelectorAll('.btn-danger').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
          let imageId = e.currentTarget.getAttribute('data-id');

          if (imageId !== null) {
              let url = "{{ route('products.delete-image', ':id') }}";
              url = url.replace(':id', imageId);

              const form = document.querySelector('#deleteModal form');
              form.action = url;

              $('#deleteModal').modal('show');
          }
      });
  });
</script>

@endpush