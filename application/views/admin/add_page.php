<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= base_url('admin/pages') ?>">Pages</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Page</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> New <strong>Page</strong>
    <small>create a new page</small>
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

$title             = set_value('title');
$url               = set_value('url');
$content           = set_value('content');
$status            = set_value('status');
$meta_title        = set_value('meta_title');
$meta_description  = set_value('meta_description');
$meta_keywords     = set_value('meta_keywords');
if ( isset($page) ) {
    $id                = $page->id;
    $title             = $title == false ? $page->title : $title;
    $url               = $url == false ? $page->url : $url;
    $content           = $content == false ? $page->content : $content;
    $status            = $status == false ? $page->status : $status;
    $meta_title        = $meta_title == false ? $page->meta_title : $meta_title;
    $meta_description  = $meta_description == false ? $page->meta_description : $meta_description;
    $meta_keywords     = $meta_keywords == false ? $page->meta_keywords : $meta_keywords;
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
                    <span class="caption-subject font-dark sbold uppercase">Add Page</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url('admin/pages') ?>" class="btn btn-success btn-outline btn-circle btn-sm active">View Pages</a>
                </div>
            </div>
            <div class="portlet-body form">
                <?= form_open('',array('class'=>'form-horizontal','id'=>'add_page_form')) ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="page_title" class="col-md-3 control-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" id="page_title" name="title" placeholder="title of the page" class="form-control" value="<?= $title ?>">
                                <?php echo form_error('title', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="page_url" class="col-md-3 control-label">Url</label>
                            <div class="col-md-9">
                                <input type="text" id="page_url" name="url" placeholder="url of the page" class="form-control" value="<?= $url ?>">
                                <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-md-3 control-label">Content</label>
                            <div class="col-md-9">
                                <textarea name="content" id="content" rows="9" placeholder="Content of the page" class="summernote form-control"><?= $content ?></textarea>
                                <?php echo form_error('content', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="page_status" class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
                                <select name="status" id="page_status" class="form-control">
                                    <option value="1" <?= $status == '1' || $status == false ? 'selected' : '' ?> >Active</option>
                                    <option value="0" <?= $status == '0' ? 'selected' : '' ?> >Closed</option>
                                </select>
                                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_title" class="col-md-3 control-label">Meta Title</label>
                            <div class="col-md-9">
                                <input type="text" id="meta_title" name="meta_title" placeholder="Meta title" class="form-control" value="<?= $meta_title ?>">
                                <?php echo form_error('meta_title', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_description" class="col-md-3 control-label">Meta Description</label>
                            <div class="col-md-9">
                                <textarea name="meta_description" id="meta_description" rows="3" placeholder="Meta description of the page" class="form-control"><?= $meta_description ?></textarea>
                                <?php echo form_error('meta_description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords" class="col-md-3 control-label">Meta Keywords</label>
                            <div class="col-md-9">
                                <textarea name="meta_keywords" id="meta_keywords" rows="3" placeholder="Meta keywords for the page" class="form-control"><?= $meta_keywords ?></textarea>
                                <?php echo form_error('meta_keywords', '<div class="error">', '</div>'); ?>
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