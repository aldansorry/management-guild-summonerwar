<div class="row">
    <div class="col-md-12">
        <?php echo form_open($cname . '/action_war_end', ['id' => 'form-update', 'class' => 'form-horizontal']) ?>
        <input type="hidden" name="fk_guildwar" value="<?php echo $war_end->id ?>">
        <div class="form-group">
            <label for="input-nickname" class="col-sm-2 control-label">State</label>
            <div class="col-sm-12">
                <div class="radio">
                <label>
                        <input type="radio" name="state" id="state1" value="1" checked="">
                        Victory
                    </label>
                    <label>
                        <input type="radio" name="state" id="state1" value="2">
                        Draw
                    </label>
                    <label>
                        <input type="radio" name="state" id="state1" value="3">
                        Defeated
                    </label>
                </div>
            </div>
        </div>
        <table id="table-member" class="table table-bordered table-striped table-responsive" data-url="<?php echo base_url($cname . '/get_member_list/' . $war_end->id) ?>" style="width:100%;">
        </table>
        <?php echo form_close(); ?>
    </div>
</div>