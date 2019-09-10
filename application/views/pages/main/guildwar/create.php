<div class="row">
    <div class="col-md-12">
        <?php echo form_open($cname.'/action_create',['id' => 'form-create','class' => 'form-horizontal']) ?>
        <table id="table-member" class="table table-bordered table-striped table-responsive" data-url="<?php echo base_url($cname . '/get_suggestion_member') ?>" style="width:100%;">
        </table>
        <?php echo form_close(); ?>
    </div>
</div>