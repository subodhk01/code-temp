<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= base_url('admin/reports/users') ?>">Users</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add User</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> New <strong>User</strong>
    <small>create a new user</small>
</h3>
<!-- END PAGE TITLE-->

<?php if ( isset($error) ) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php } ?>
<?php if ( isset($message) ) { ?>
    <div class="alert alert-<?= isset($message->type) ? $message->type : '' ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <?= isset($message->content) ? $message->content : '' ?>
    </div>
<?php } ?>

<?php

$username = set_value('username');
$email    = set_value('email');
$password = set_value('password');
$status   = set_value('status');
$is_admin = set_value('is_admin');

// $title          = set_value('title');
// $url            = set_value('url');
// $description    = set_value('description');
// $status         = set_value('status');
if ( isset($user) ) {
    $id             = $user->id;
    $username       = $username == false ? $user->username : $username;
    $email          = $email == false ? $user->email : $email;
    // $password       = $password == false ? $user->password : $password;
    $status         = $status == false ? $user->status : $status;
    $is_admin       = $is_admin == false ? $user->is_admin : $is_admin;
}
?>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-plus font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Add User</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url('admin/reports/users') ?>" class="btn btn-success btn-outline btn-circle btn-sm active">View Users</a>
                </div>
            </div>
            <div class="portlet-body form">
                <?= form_open('',array('class'=>'form-horizontal','id'=>'add_user_form')) ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="username" class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" id="username" name="username" placeholder="Username" class="form-control" value="<?= $username ?>">
                                <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?= $email ?>">
                                <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control" value="<?= $password ?>">
                                <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= $status == '1' || $status == false ? 'selected' : '' ?> >Active</option>
                                    <option value="0" <?= $status == '0' ? 'selected' : '' ?> >Closed</option>
                                </select>
                                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_admin" class="col-md-3 control-label">Privilege</label>
                            <div class="col-md-9">
                                <select name="is_admin" id="is_admin" class="form-control">
                                    <option value="1" <?= $is_admin == '1' || $is_admin == false ? 'selected' : '' ?> >Admin</option>
                                    <option value="0" <?= $is_admin == '0' ? 'selected' : '' ?> >User</option>
                                </select>
                                <?php echo form_error('privilege', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <?= isset($id) ? '<input type="hidden" name="id" value="'.$id.'">' : '' ?>
                        <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
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