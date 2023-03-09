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
                        <label for="name_category" class="col-md-2 col-md-offset-1 control-label">Category</label>
                        <div class="col-md-9">
                            <input type="text" name="name_category" id="name_category" class="form-control" required autofocus>
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