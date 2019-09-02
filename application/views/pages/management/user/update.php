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
            <label for="input-address" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
                <textarea name="address" class="form-control" id="input-address"><?php echo $user->address ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="input-phone" class="col-sm-2 control-label">Telepon</label>
            <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" id="input-phone" value="<?php echo $user->phone ?>" placeholder="input phone" onkeypress="return onlyNumber(event)">
            </div>
        </div>
        <div class="form-group">
            <label for="input-email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="input-email" value="<?php echo $user->email ?>" placeholder="input email">
            </div>
        </div>
        <div class="form-group">
            <label for="input-username" class="col-sm-2 control-label">username</label>
            <div class="col-sm-10">
                <input type="text" name="username" class="form-control" id="input-username" value="<?php echo $user->username ?>" placeholder="input username">
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>