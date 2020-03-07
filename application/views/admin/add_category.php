<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= base_url('admin/reports/categories') ?>">Categories</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Category</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> New <strong>Category</strong>
    <small>create a new category</small>
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
$title          = set_value('title');
$url            = set_value('url');
$description    = set_value('description');
$status         = set_value('status');
if ( isset($category) ) {
    $id             = $category->id;
    $title          = $title == false ? $category->title : $title;
    $url            = $url == false ? $category->url : $url;
    $description    = $description == false ? $category->description : $description;
    $status         = $status == false ? $category->status : $status;
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
                    <span class="caption-subject font-dark sbold uppercase">Add Category</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url('admin/reports/categories') ?>" class="btn btn-success btn-outline btn-circle btn-sm active">View Categories</a>
                </div>
            </div>
            <div class="portlet-body form">
                <?= form_open('',array('class'=>'form-horizontal')) ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="report_title" class="col-md-3 control-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" id="report_title" name="title" placeholder="title of the report" class="form-control" value="<?= $title ?>">
                                <?php echo form_error('title', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_url" class="col-md-3 control-label">Url</label>
                            <div class="col-md-9">
                                <input type="text" id="category_url" name="url" placeholder="url of the category" class="form-control" value="<?= $url ?>">
                                <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="report_description" class="col-md-3 control-label">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" id="report_description" rows="3" placeholder="Description of category" class="form-control"><?= $description ?></textarea>
                                <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="report_status" class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
                                <select name="status" id="report_status" class="form-control">
                                    <option value="1" <?= $status == '1' || $status == false ? 'selected' : '' ?> >Active</option>
                                    <option value="0" <?= $status == '0' ? 'selected' : '' ?> >Closed</option>
                                </select>
                                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
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