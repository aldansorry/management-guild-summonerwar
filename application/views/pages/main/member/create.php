<div class="row">
    <div class="col-md-12">
        <?php echo form_open($cname.'/action_create',['id' => 'form-create','class' => 'form-horizontal']) ?>
        <div class="form-group">
            <label for="input-name" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="input-name" placeholder="input nama" onkeypress="return onlyAlphaSpace(event)">
            </div>
        </div>
        <div class="form-group">
            <label for="input-nickname" class="col-sm-2 control-label">Panggilan</label>
            <div class="col-sm-10">
                <input type="text" name="nickname" class="form-control" id="input-nickname" placeholder="input panggilan">
            </div>
        </div>
        <div class="form-group">
            <label for="input-ign" class="col-sm-2 control-label">Nama Game</label>
            <div class="col-sm-10">
                <input type="text" name="ign" class="form-control" id="input-ign" placeholder="input nama game">
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>