@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <a href="{{ route('products.create') }}" class="btn btn-raised btn-primary round btn-min-width mr-1 mb-1"><i
            class="fa fa-plus-circle"></i> </a>
@stop

@section('content')

    <section id="multi-column">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="card-block ">
                            <table class="table table-responsive-lg" id="products-table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Descriptions</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@section('js')
    <script src="{{ asset('vendor/jquery/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 100,
                aaSorting: [[0, "desc"]],
                ajax: '{!! route('products.data') !!}',
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'price'},
                    {data: 'description'},
                    {data: 'action'},
                ]
            });
        });

    </script>
@endsection
