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
        <div class="form-group">
            <label for="input-nickname" class="col-sm-2 control-label">Panggilan</label>
            <div class="col-sm-10">
                <input type="text" name="nickname" class="form-control" id="input-nickname" value="<?php echo $user->nickname ?>" placeholder="input panggilan">
            </div>
        </div>
        <div class="form-group">
            <label for="input-ign" class="col-sm-2 control-label">Nama Game</label>
            <div class="col-sm-10">
                <input type="text" name="ign" class="form-control" id="input-ign" value="<?php echo $user->ign ?>" placeholder="input Nama Game">
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>