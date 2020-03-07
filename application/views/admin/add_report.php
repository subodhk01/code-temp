<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= base_url('admin/reports') ?>">Reports</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Report</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> New <strong>Report</strong>
    <small>create a new report</small>
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
$table_of_content       = set_value('table_of_content');
$list_of_table          = set_value('list_of_table');
$list_of_charts         = set_value('list_of_charts');
$no_of_pages            = set_value('no_of_pages');
$delivery_format        = set_value('delivery_format');
$licence_single_user    = set_value('licence_single_user');
$licence_multi_user     = set_value('licence_multi_user');
$licence_corporate      = set_value('licence_corporate');
$status                 = set_value('status');
$meta_title             = set_value('meta_title');
$meta_description       = set_value('meta_description');
$meta_keywords          = set_value('meta_keywords');
$heading                = set_value('heading');
$report_code            = set_value('report_code');
$report_type            = set_value('report_type');
$adjacent_reports       = set_value('adjacent_reports');
$canonical_tag          = set_value('canonical_tag');
if ( isset($report) ) {
    $id                     = $report->id;
    $title                  = $title == false ? $report->title : $title;
    $url                    = $url == false ? $report->url : $url;
    $category               = $category == false ? $report->category : $category;
    $short_description      = $short_description == false ? $report->short_description : $short_description;
    $full_description       = $full_description == false ? $report->full_description : $full_description;
    $table_of_content       = $table_of_content == false ? $report->table_of_content : $table_of_content;
    $list_of_table          = $list_of_table == false ? $report->list_of_table : $list_of_table;
    $list_of_charts         = $list_of_charts == false ? $report->list_of_charts : $list_of_charts;
    $no_of_pages            = $no_of_pages == false ? $report->no_of_pages : $no_of_pages;
    $delivery_format        = $delivery_format == false ? $report->delivery_format : $delivery_format;
    $licence_single_user    = $licence_single_user == false ? $report->licence_single_user : $licence_single_user;
    $licence_multi_user     = $licence_multi_user == false ? $report->licence_multi_user : $licence_multi_user;
    $licence_corporate      = $licence_corporate == false ? $report->licence_corporate : $licence_corporate;
    $status                 = $status == false ? $report->status : $status;
    $meta_title             = $meta_title == false ? $report->meta_title : $meta_title;
    $meta_description       = $meta_description == false ? $report->meta_description : $meta_description;
    $meta_keywords          = $meta_keywords == false ? $report->meta_keywords : $meta_keywords;
    $heading                = $heading == false ? $report->heading : $heading;
    $report_code            = $report_code == false ? $report->report_code : $report_code;
    $report_type            = $report_type == false ? $report->report_type : $report_type;
    $adjacent_reports       = $adjacent_reports == false ? $report->adjacent_reports : $adjacent_reports;
    $canonical_tag          = $canonical_tag == false ? $report->canonical_tag : $canonical_tag;
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
                    <span class="caption-subject font-dark sbold uppercase">Add Report</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url('admin/reports') ?>" class="btn btn-success btn-outline btn-circle btn-sm active">View Reports</a>
                </div>
            </div>
            <div class="portlet-body form">
                <?= form_open('',array('class'=>'form-horizontal','id'=>'add_report_form')) ?>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="report_title" class="col-md-3 control-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" id="report_title" name="title" placeholder="title of the report" class="form-control" value="<?= $title ?>">
                                <?php echo form_error('title', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="report_heading" class="col-md-3 control-label">Heading</label>
                            <div class="col-md-9">
                                <input type="text" id="report_heading" name="heading" placeholder="heading of the report" class="form-control" value="<?= $heading ?>">
                                <?php echo form_error('heading', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="report_url" class="col-md-3 control-label">Url</label>
                            <div class="col-md-9">
                                <input type="text" id="report_url" name="url" placeholder="url of the report" class="form-control" value="<?= $url ?>">
                                <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="report_category" class="col-md-3 control-label">Category</label>
                            <div class="col-md-9">
                                <select name="category" id="report_category" class="form-control">
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
                            <label for="canonical_tag" class="col-md-3 control-label">Canonical Tag</label>
                            <div class="col-md-9">
                                <input type="text" id="canonical_tag" name="canonical_tag" placeholder="canonical tag" class="form-control" value="<?= $canonical_tag ?>">
                                <?php echo form_error('canonical_tag', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="short_description" class="col-md-3 control-label">Short Description</label>
                            <div class="col-md-9">
                                <textarea name="short_description" id="short_description" rows="9" placeholder="Short description of report" class="summernote form-control"><?= $short_description ?></textarea>
                                <?php echo form_error('short_description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="full_description" class="col-md-3 control-label">Full Description</label>
                            <div class="col-md-9">
                                <textarea name="full_description" id="full_description" rows="9" placeholder="Detailed description of report" class="summernote form-control"><?= $full_description ?></textarea>
                                <?php echo form_error('full_description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="table_of_content" class="col-md-3 control-label">Table Of Content</label>
                            <div class="col-md-9">
                                <textarea name="table_of_content" id="table_of_content" rows="9" placeholder="Table of content" class="summernote form-control"><?= $table_of_content ?></textarea>
                                <?php echo form_error('table_of_content', '<div class="error">', '</div>'); ?>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="list_of_table" class="col-md-3 control-label">List Of Table</label>
                            <div class="col-md-9">
                                <textarea name="list_of_table" id="list_of_table" rows="9" placeholder="Lisf of table" class="summernote form-control"><?= $list_of_table ?></textarea>
                                <?php echo form_error('list_of_table', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="list_of_charts" class="col-md-3 control-label">List Of Charts</label>
                            <div class="col-md-9">
                                <textarea name="list_of_charts" id="list_of_charts" rows="9" placeholder="Lisf of charts" class="summernote form-control"><?= $list_of_charts ?></textarea>
                                <?php echo form_error('list_of_charts', '<div class="error">', '</div>'); ?>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="adjacent_reports" class="col-md-3 control-label">Adjacent Reports</label>
                            <div class="col-md-9">
                                <textarea name="adjacent_reports" id="adjacent_reports" rows="9" placeholder="Adjacent Reports" class="summernote form-control"><?= $adjacent_reports ?></textarea>
                                <?php echo form_error('adjacent_reports', '<div class="error">', '</div>'); ?>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="no_of_pages" class="col-md-3 control-label">No. Of Pages</label>
                            <div class="col-md-9">
                                <input type="number" id="no_of_pages" name="no_of_pages" placeholder="Number of pages" class="form-control" value="<?= $no_of_pages ?>">
                                <?php echo form_error('no_of_pages', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="delivery_format" class="col-md-3 control-label">Delivery Format</label>
                            <div class="col-md-9">
                                <input type="text" id="delivery_format" name="delivery_format" placeholder="Delivery format" class="form-control" value="<?= $delivery_format ?>">
                                <?php echo form_error('delivery_format', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="licence_single_user" class="col-md-3 control-label">Single User Licence</label>
                            <div class="col-md-9">
                                <input type="number" id="licence_single_user" name="licence_single_user" placeholder="Price for single user licence" class="form-control" value="<?= $licence_single_user ?>">
                                <?php echo form_error('licence_single_user', '<div class="error">', '</div>'); ?>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="licence_multi_user" class="col-md-3 control-label">Multi User Licence</label>
                            <div class="col-md-9">
                                <input type="number" id="licence_multi_user" name="licence_multi_user" placeholder="Price for multi user licence" class="form-control" value="<?= $licence_multi_user ?>">
                                <?php echo form_error('licence_multi_user', '<div class="error">', '</div>'); ?>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="licence_corporate" class="col-md-3 control-label">Corporate Licence</label>
                            <div class="col-md-9">
                                <input type="number" id="licence_corporate" name="licence_corporate" placeholder="Price for corporate licence" class="form-control" value="<?= $licence_corporate ?>">
                                <?php echo form_error('licence_corporate', '<div class="error">', '</div>'); ?>
                            </div>
                        </div> -->
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
                        <div class="form-group">
                            <label for="report_type" class="col-md-3 control-label">Report Type</label>
                            <div class="col-md-9">
                                <select name="report_type" id="report_type" class="form-control">
                                    <option value="1" <?= $report_type == 1 ? 'selected' : '' ?> >Published</option>
                                    <option value="2" <?= $report_type == 2 ? 'selected' : '' ?> >Upcoming</option>
                                </select>
                                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="report_type" class="col-md-3 control-label">Add Image</label>
                            <div class="col-md-9">
                                <div class="choose_file">  
                                    <input name="Select File" type="file" accept="image/*"/>
                                </div>
                                <?php echo form_error('image', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="report_code" class="col-md-3 control-label">Report Code</label>
                            <div class="col-md-9">
                                <input type="text" id="report_code" name="report_code" placeholder="Report Code" class="form-control" value="<?= $report_code ?>">
                                <?php echo form_error('report_code', '<div class="error">', '</div>'); ?>
                            </div>
                        </div> -->
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
                                <textarea name="meta_description" id="meta_description" rows="3" placeholder="Meta description of the report" class="form-control"><?= $meta_description ?></textarea>
                                <?php echo form_error('meta_description', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords" class="col-md-3 control-label">Meta Keywords</label>
                            <div class="col-md-9">
                                <textarea name="meta_keywords" id="meta_keywords" rows="3" placeholder="Meta keywords for the report" class="form-control"><?= $meta_keywords ?></textarea>
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