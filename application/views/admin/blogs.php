<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url('admin') ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Blogs</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> All <strong>Blogs</strong>
    <small>List of blogs</small>
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
                        <i class="icon-notebook font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Blogs</span>
                    </div>
                    <div class="actions">
                        <a href="<?= base_url('admin/blogs/add_blog') ?>" class="btn btn-success btn-outline btn-circle btn-sm active">Add Blog</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_blogs">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="5%"> # </th>
                                    <th width="15%"> Title </th>
                                    <th width="200"> Url </th>
                                    <th width="10%"> Status </th>
                                    <th width="10%"> Type </th>
                                    <th width="10%"> Date </th>
                                    <th width="10%"> Actions </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td> </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="blog_title"> </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="blog_url"> </td>
                                    <td>
                                        <select name="blog_status" class="form-control form-filter input-sm">
                                            <option value="">All</option>
                                            <option value="1">Active</option>
                                            <option value="0">Closed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="blog_type" class="form-control form-filter input-sm">
                                            <option value="">All</option>
                                            <option value="1">Article</option>
                                            <option value="2">News</option>
                                            <option value="3">Pre-release</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="date_published_from" placeholder="From">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="date_published_to" placeholder="To">
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