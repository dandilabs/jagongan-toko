@extends('layouts.master')
@section('title')
Product
@endsection

@section('breadcrumb')
@parent
<li class="active">Product</li>
@endsection

@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="addForm('{{route('product.store')}}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Add</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>kategori</th>
                        <th>Merk</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Diskon</th>
                        <th>Stok</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@includeIf('category.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function () {
            table = $('.table').DataTable({
                processing : true,
                autoWidth : false,
                ajax: {
                    url : '{{route('product.data')}}'
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false,sortable:false},
                    {data : 'kode_product'},
                    {data : 'name_product'},
                    {data : 'category'},
                    {data : 'merk'},
                    {data : 'harga_beli'},
                    {data : 'harga_jual'},
                    {data : 'dikon'},
                    {data : 'stock'},
                    {data : 'action', searchable: false,sortable:false}
                ]
            });

            $('#modal-form').validator().on('submit', function (e) {
                if(! e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    }) 
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return ;
                    });
                }
            })
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Add Product')

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name = _method]').val('post');
            $('#modal-form [name = name_category]').focus();

        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Product')

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name = _method]').val('put');
            $('#modal-form [name = name_category]').focus();
            $.get(url)
            .done((response) =>{
                $('#modal-form [name = name_category]').val(response.name_category);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            })
        }

        function deleteData(url) {
            if(confirm('Yakin ingin menghapus data?')) {
                $.post(url, {
                '_token' : $('[name= csrf-token]').attr('content'),
                '_method' : 'delete'
                })
                    .done((response) => {
                        table.ajax.reload()
                    })
                    .fail((errors) => {
                        alert('Tidak dapat dihapus');
                        return;
                    })
            }
        }
    </script>
@endpush
