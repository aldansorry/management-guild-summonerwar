<div class="row">
    <div class="col-md-12">
        <?php echo form_open($cname.'/action_update',['id' => 'form-update','class' => 'form-horizontal']) ?>
        <input type="hidden" name="id" value="<?php echo $user->id ?>">
        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="input-name" value="<?php echo $user->name ?>" placeholder="input name" onkeypress="return onlyAlphaSpace(event)">
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>