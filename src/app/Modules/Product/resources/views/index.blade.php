@extends('dashboard::layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-12">
             <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Categories</h3>
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
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                               <thead>
                                  <tr>
                                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Rendering engine</th>
                                     <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column descending" aria-sort="ascending">Browser</th>
                                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th>
                                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th>
                                     <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  <tr class="odd">
                                     <td class="dtr-control" tabindex="0">Other browsers</td>
                                     <td class="sorting_1">All others</td>
                                     <td>-</td>
                                     <td>-</td>
                                     <td>U</td>
                                  </tr>
                                  <tr class="even">
                                     <td class="dtr-control" tabindex="0">Trident</td>
                                     <td class="sorting_1">AOL browser (AOL desktop)</td>
                                     <td>Win XP</td>
                                     <td>6</td>
                                     <td>A</td>
                                  </tr>
                                  <tr class="odd">
                                     <td class="dtr-control" tabindex="0">Gecko</td>
                                     <td class="sorting_1">Camino 1.0</td>
                                     <td>OSX.2+</td>
                                     <td>1.8</td>
                                     <td>A</td>
                                  </tr>
                                  <tr class="even">
                                     <td class="dtr-control" tabindex="0">Gecko</td>
                                     <td class="sorting_1">Camino 1.5</td>
                                     <td>OSX.3+</td>
                                     <td>1.8</td>
                                     <td>A</td>
                                  </tr>
                                  <tr class="odd">
                                     <td class="dtr-control" tabindex="0">Misc</td>
                                     <td class="sorting_1">Dillo 0.8</td>
                                     <td>Embedded devices</td>
                                     <td>-</td>
                                     <td>X</td>
                                  </tr>
                                  <tr class="even">
                                     <td class="dtr-control" tabindex="0">Gecko</td>
                                     <td class="sorting_1">Epiphany 2.20</td>
                                     <td>Gnome</td>
                                     <td>1.8</td>
                                     <td>A</td>
                                  </tr>
                                  <tr class="odd">
                                     <td class="dtr-control" tabindex="0">Gecko</td>
                                     <td class="sorting_1">Firefox 1.0</td>
                                     <td>Win 98+ / OSX.2+</td>
                                     <td>1.7</td>
                                     <td>A</td>
                                  </tr>
                                  <tr class="even">
                                     <td class="dtr-control" tabindex="0">Gecko</td>
                                     <td class="sorting_1">Firefox 1.5</td>
                                     <td>Win 98+ / OSX.2+</td>
                                     <td>1.8</td>
                                     <td>A</td>
                                  </tr>
                                  <tr class="odd">
                                     <td class="dtr-control" tabindex="0">Gecko</td>
                                     <td class="sorting_1">Firefox 2.0</td>
                                     <td>Win 98+ / OSX.2+</td>
                                     <td>1.8</td>
                                     <td>A</td>
                                  </tr>
                                  <tr class="even">
                                     <td class="dtr-control" tabindex="0">Gecko</td>
                                     <td class="sorting_1">Firefox 3.0</td>
                                     <td>Win 2k+ / OSX.3+</td>
                                     <td>1.9</td>
                                     <td>A</td>
                                  </tr>
                               </tbody>
                            </table>
                         </div>
                      </div>
                      @include('dashboard::includes.pagination')
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
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}
    
@endpush

@push('scripts')
    <script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        // $(function () {
        //     $('#example2').DataTable({
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": false,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //         "responsive": true,
        //     });
        // });
      </script>
@endpush