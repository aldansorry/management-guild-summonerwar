<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Daftar Member</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="table-data" class="table table-bordered table-striped table-responsive" data-url="<?php echo base_url($cname . '/get_data') ?>" style="width:100%;">
          <thead>
            <tr>
              <th data-filter=""></th>
              <th data-filter=""></th>
              <th data-filter=""></th>
              <th data-filter="text"></th>
              <th data-filter="text"></th>
              <th data-filter="text"></th>
              <th data-filter="text"></th>
            </tr>

          </thead>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<div class="modal fade" id="modal-default" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="modal-body-container">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="modal-btn-accept" form="">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>