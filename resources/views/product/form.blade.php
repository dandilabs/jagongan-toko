<div class="modal fade" tabindex="-1" role="dialog" id="modal-form" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name_product" class="col-md-2 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md-9">
                            <input type="text" name="name_product" id="name_product" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_category" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
                        <div class="col-md-9">
                            <select name="id_category" id="id_category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($category_data as  $key => $item)
                                    <option value="{{$key }}">{{$item}}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merk" class="col-md-2 col-md-offset-1 control-label">Merk</label>
                        <div class="col-md-9">
                            <input type="text" name="merk" id="merk" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_beli" class="col-md-2 col-md-offset-1 control-label">Harga Beli</label>
                        <div class="col-md-9">
                            <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_jual" class="col-md-2 col-md-offset-1 control-label">Harga Jual</label>
                        <div class="col-md-9">
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-md-2 col-md-offset-1 control-label">Diskon</label>
                        <div class="col-md-9">
                            <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock" class="col-md-2 col-md-offset-1 control-label">Stok</label>
                        <div class="col-md-9">
                            <input type="text" name="stock" id="stock" class="form-control" required value="0">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->