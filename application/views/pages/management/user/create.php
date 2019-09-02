<div class="row">
    <div class="col-md-12">
        <?php echo form_open($cname.'/action_create',['id' => 'form-create','class' => 'form-horizontal']) ?>
        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="input-name" placeholder="input name" onkeypress="return onlyAlphaSpace(event)">
            </div>
        </div>
        <div class="form-group">
            <label for="input-address" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
                <textarea name="address" class="form-control" id="input-address"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="input-phone" class="col-sm-2 control-label">Telepon</label>
            <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" id="input-phone" placeholder="input phone" onkeypress="return onlyNumber(event)">
            </div>
        </div>
        <div class="form-group">
            <label for="input-email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="input-email" placeholder="input email">
            </div>
        </div>
        <div class="form-group">
            <label for="input-username" class="col-sm-2 control-label">username</label>
            <div class="col-sm-10">
                <input type="text" name="username" class="form-control" id="input-username" placeholder="input username">
            </div>
        </div>
        <div class="form-group">
            <label for="input-password" class="col-sm-2 control-label">Kata Sandi</label>
            <div class="col-sm-5">
                <input type="password" name="password" class="form-control" id="input-password" placeholder="input password">
            </div>
            <div class="col-sm-5">
                <input type="password" name="repassword" class="form-control" id="input-password" placeholder="reinput password">
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>