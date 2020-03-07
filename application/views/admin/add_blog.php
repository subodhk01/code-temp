<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= base_url('admin/blogs') ?>">Blogs</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Blog</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> New <strong>Blog</strong>
    <small>create a new blog</small>
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

$title                  = set_value('title');
$url                    = set_value('url');
$category               = set_value('category');
$short_description      = set_value('short_description');
$full_description       = set_value('full_description');
$type                   = set_value('type');
$status                 = set_value('status');
$pr_status              = set_value('pr_status');
$meta_title             = set_value('meta_title');
$meta_description       = set_value('meta_description');
$meta_keywords          = set_value('meta_keywords');
if ( isset($blog) ) {
    $id                     = $blog->id;
    $title                  = $title == false ? $blog->title : $title;
    $url                    = $url == false ? $blog->url : $url;
    $category               = $category == false ? $blog->category : $category;
    $short_description      = $short_description == false ? $blog->short_description : $short_description;
    $full_description       = $full_description == false ? $blog->full_description : $full_description;
    $type                   = $type == false ? $blog->type : $type;
    $status                 = $status == false ? $blog->status : $status;
    $pr_status              = $pr_status == false ? $blog->pr_status : $pr_status;
    $meta_title             = $meta_title == false ? $blog->meta_title : $meta_title;
    $meta_description       = $meta_description == false ? $blog->meta_description : $meta_description;
    $meta_keywords          = $meta_keywords == false ? $blog->meta_keywords : $meta_keywords;
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
                    <span class="caption-subject font-dark sbold uppercase">Add Blog</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url('admin/blogs') ?>" class="btn btn-success btn-outline btn-circle btn-sm active">View Blogs</a>
                </div>
            </div>
            <div class="portlet-body form">
                <?= form_open('',array('class'=>'form-horizontal','id'=>'add_blog_form')) ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="blog_title" class="col-md-3 control-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" id="blog_title" name="title" placeholder="title of the blog" class="form-control" value="<?= $title ?>">
                                <?php echo form_error('title', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="blog_url" class="col-md-3 control-label">Url</label>
                            <div class="col-md-9">
                                <input type="text" id="blog_url" name="url" placeholder="url of the blog" class="form-control" value="<?= $url ?>">
                                <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="blog_category" class="col-md-3 control-label">Category</label>
                            <div class="col-md-9">
                                <select name="category" id="blog_category" class="form-control">
                                    <option value="0">Please select</option>
                                    <?php
                                    if ( isset($categories) && count($categories) > 0 ) {
                                        foreach ($categories as $key => $item) {
                                            echo '<option value="'.$item->id.'" '. ($category == $item->id ? 'selected' : '') .' >'.$item->title.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('category', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="short_description" class="col-md-3 control-label">Short Description</label>
                            <div class="col-md-9">
                                <textarea name="short_description" id="short_description" rows="9" placeholder="Short description of blog" class="summernote form-control"><?= $short_description ?></textarea>
                                <?php echo form_error('short_description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="full_description" class="col-md-3 control-label">Full Description</label>
                            <div class="col-md-9">
                                <textarea name="full_description" id="full_description" rows="9" placeholder="Detailed description of blog" class="summernote form-control"><?= $full_description ?></textarea>
                                <?php echo form_error('full_description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="blog_type" class="col-md-3 control-label">Type</label>
                            <div class="col-md-9">
                                <select name="type" id="blog_type" class="form-control">
                                    <option value="1" <?= $type == '1' ? 'selected' : '' ?> >Article</option>
                                    <option value="2" <?= $type == '2' ? 'selected' : '' ?> >News</option>
                                    <option value="3" <?= $type == '3' ? 'selected' : '' ?> >Press-Release</option>
                                </select>
                                <?php echo form_error('type', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="blog_status" class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
                                <select name="status" id="blog_status" class="form-control">
                                    <option value="1" <?= $status == '1' || $status == false ? 'selected' : '' ?> >Active</option>
                                    <option value="0" <?= $status == '0' ? 'selected' : '' ?> >Closed</option>
                                </select>
                                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="blog_pr_status" class="col-md-3 control-label">PR Status</label>
                            <div class="col-md-9">
                                <select name="pr_status" id="blog_pr_status" class="form-control">
                                    <option value="index" <?= $pr_status == 'index' ? 'selected' : '' ?> >Index</option>
                                    <option value="noindex" <?= $pr_status == 'noindex' ? 'selected' : '' ?> >No Index</option>
                                </select>
                                <?php echo form_error('pr_status', '<div class="error">', '</div>'); ?>
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
                                <textarea name="meta_description" id="meta_description" rows="3" placeholder="Meta description of the blog" class="form-control"><?= $meta_description ?></textarea>
                                <?php echo form_error('meta_description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords" class="col-md-3 control-label">Meta Keywords</label>
                            <div class="col-md-9">
                                <textarea name="meta_keywords" id="meta_keywords" rows="3" placeholder="Meta keywords for the blog" class="form-control"><?= $meta_keywords ?></textarea>
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