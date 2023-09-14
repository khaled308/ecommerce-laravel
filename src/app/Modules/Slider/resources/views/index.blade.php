@extends('dashboard::layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Sliders</h3>
                        <a href="{{ route('sliders.create') }}" class="btn btn-primary btn-sm ms-auto">Create Slider</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting" tabindex="0" aria-controls="example2">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2">title</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2">subtitle</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2">image</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2">price</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($sliders as $slider)
                                            <tr class="{{ $loop->even ? 'even' : 'odd' }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ Str::of($slider->title)->limit(20)  }}</td>
                                                <td>{{ Str::of($slider->subtitle)->limit(20) }}</td>
                                                <td>
                                                    @php
                                                        $image = $slider->image;
                                                        if (!file_exists($image))
                                                            $image = 'uploads/' . $image;
                                                    @endphp
                                                    <img src="{{ asset($image) }}" alt="" width="100">
                                                </td>
                                                <td>{{ $slider->price }}</td>
                                                <td>
                                                    {{-- Add your action buttons here --}}
                                                    <a href="{{ route('sliders.edit', $slider->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="#"
                                                        class="btn btn-danger btn-sm category-delete">Delete</a>
                                                         <form action="{{route('sliders.destroy', $slider->id) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                         </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3">No sliders found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- display pagination here --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
   document.querySelectorAll('.category-delete').forEach(function (element) {
       element.addEventListener('click', function (e) {
           e.preventDefault();
           if (confirm('Are you sure you want to delete this slider?')) {
               element.nextElementSibling.submit();
           }
       });
   });
</script>
@endpush
