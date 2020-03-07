<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Change Password</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> Change <strong>Password</strong>
    <small>Change your password</small>
</h3>
<!-- END PAGE TITLE-->

<?php if ( isset($error) ) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php } ?>
<?php if ( isset($message) && isset($message->content) ) { ?>
    <div class="alert alert-<?= isset($message->type) ? $message->type : '' ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <?= $message->content ?>
    </div>
<?php } ?>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-plus font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Change Password</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?= form_open('',array('class'=>'form-horizontal','id'=>'change_password_form')) ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="old_password" class="col-md-3 control-label">Old Password</label>
                            <div class="col-md-6">
                                <input type="password" id="old_password" name="old_password" placeholder="Old Password" class="form-control" >
                                <?php echo form_error('old_password', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-md-3 control-label">New Password</label>
                            <div class="col-md-6">
                                <input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control" >
                                <?php echo form_error('new_password', '<div class="error">', '</div>'); ?>
                                <p class="help-block">At least 6 characters</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" class="col-md-3 control-label">New Password</label>
                            <div class="col-md-6">
                                <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm New Password" class="form-control" >
                                <?php echo form_error('password_confirm', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
<!--                         <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-custom" value="Reset">
                        </div>
 -->                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6">
                                    <button type="submit" class="btn green">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>