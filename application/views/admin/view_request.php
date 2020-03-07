<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?= base_url('admin/request') ?>">Request</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Request View</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<?php
if ( !isset($request) ) {
    $request = new stdClass();
    $request->request_type   = '';
    $request->report_id      = '';
    $request->name           = '';
    $request->company_name   = '';
    $request->company_email  = '';
    $request->designation    = '';
    $request->contact_no     = '';
    $request->message        = '';
    $request->date_request   = '';
    $request->meta_title          = '';
}
?>
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"><?= $request->meta_title ?></h3>
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
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-plus font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">View Request</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url('admin/requests') ?>" class="btn btn-success btn-outline btn-circle btn-sm active">View Requests</a>
                </div>
            </div>
            <div class="portlet-body">
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Request Type</label>
                        <div class="col-md-9">
                            <label class="label label-sm label-<?= $request->request_type ?>"><?= ucwords(str_replace('-', ' ', $request->request_type)) ?></label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Report Title</label>
                        <div class="col-md-9">
                            <span class=""><a href="<?= base_url('industry-reports/'.$request->url) ?>"><?= $request->meta_title ?></a></span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Name</label>
                        <div class="col-md-9">
                            <span class=""><?= $request->name ?></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Contact Number</label>
                        <div class="col-md-9">
                            <span class=""><?= $request->contact_no ?></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Company Email</label>
                        <div class="col-md-9">
                            <span class=""><?= $request->company_email ?></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Company Name</label>
                        <div class="col-md-9">
                            <span class=""><?= $request->company_name ?></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Designation</label>
                        <div class="col-md-9">
                            <span class=""><?= $request->designation ?></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Message</label>
                        <div class="col-md-9">
                            <span class=""><?= $request->message ?></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="page_title" class="col-md-3 control-label bold">Date</label>
                        <div class="col-md-9">
                            <span class=""><?= date('d-M-Y | h:i A' ,strtotime($request->date_request)) ?></span>
                        </div>
                    </div>

            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>