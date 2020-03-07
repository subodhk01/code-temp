<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Request</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> All <strong>Requests</strong>
    <small>List of requests</small>
</h3>
<!-- END PAGE TITLE-->

<?php if ( isset($error) ) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php } ?>
<!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-book-open font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Request</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_request">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="5%"> # </th>
                                    <th width="20%"> Report Title </th>
                                    <th width="10%"> Type </th>
                                    <th width="10%"> Name </th>
                                    <th width="10%"> Phone </th>
                                    <th width="10%"> Email </th>
                                    <th width="25%"> Message </th>
                                    <th width="13%"> Date </th>
                                    <th width="17%"> Actions </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td> </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="report_title"> </td>
                                    <td>
                                        <select name="request_type" class="form-control form-filter input-sm">
                                            <option value="">All</option>
                                            <option value="request-sample">Request Sample</option>
                                            <option value="speak-to-analyst">Speak To Analyst</option>
                                            <option value="report-customization">Report Customization</option>
                                            <option value="inquiry-before-buying">Inquiry Before Buying</option>
                                            <option value="request-toc">Request TOC</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="name"> </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="contact_no"> </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="company_email"> </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="message"> </td>
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="request_date_from" placeholder="From">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="request_date_to" placeholder="To">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="margin-bottom-5">
                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                <i class="fa fa-search"></i> Search</button>
                                        <button class="btn btn-sm red btn-outline filter-cancel">
                                            <i class="fa fa-times"></i> Reset</button>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .row -->