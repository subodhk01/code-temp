                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> <?= date('Y') . ' &copy; '.SITE_TITLE ?>
                <a href="<?= base_url('admin') ?>" title="<?= SITE_TITLE.' Admin' ?>" target="_blank"><?= SITE_TITLE ?></a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?= base_url('assets/global/plugins/jquery.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/js.cookie.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/jquery.blockui.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/uniform/jquery.uniform.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= base_url('assets/global/plugins/moment.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/morris/raphael-min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/jquery-validation/js/additional-methods.mi') ?>n.js" type="text/javascript"></script>

        <script src="<?= base_url('assets/global/plugins/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
        
        <script src="<?= base_url('assets/global/plugins/bootstrap-summernote/summernote.min.js') ?>" type="text/javascript"></script>

        <script src="<?= base_url('assets/global/scripts/datatable.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/datatables/datatables.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url('assets/global/scripts/app.js') ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url('assets/global/plugins/counterup/jquery.waypoints.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/counterup/jquery.counterup.min.js') ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url('assets/layouts/layout/scripts/layout.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/layouts/layout/scripts/demo.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/pages/js/form-validation.js') ?>" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

        <script type="text/javascript">
        $(document).ready(function(){
            $('.summernote').summernote({height: 300});

            if($("#datatable_reports").length > 0) {
                options = {"src": $("#datatable_reports"),
                    "aoColumnDefs": [
                                        { "sName": "id", "aTargets": [ 0 ]},
                                        { "sName": "title", "aTargets": [ 1 ]},
                                        { "sName": "url", "aTargets": [ 2 ]},
                                        { "sName": "status", "aTargets": [ 3 ]},
                                        { "sName": "no_of_pages", "aTargets": [ 4 ]},
                                        { "sName": "date_published", "aTargets": [ 5 ]}
                                    ],
                    "pageLength": 10, // default record count per page
                    "ajax_url": "<?= base_url('admin/get_reports_ajax') ?>", // ajax source
                    "order": [ [1, "asc"] ], // set first column as a default sort by asc
                    "for":"report"
                    };
                initiate_datatable(options);
            }
            if($("#datatable_request").length > 0) {
                options = {"src": $("#datatable_request"),
                    "aoColumnDefs": [
                                        { "sName": "id", "aTargets": [ 0 ]},
                                        { "sName": "rp.meta_title", "aTargets": [ 1 ]},
                                        { "sName": "rq.request_type", "aTargets": [ 2 ]},
                                        { "sName": "rq.name", "aTargets": [ 3 ]},
                                        { "sName": "rq.contact_no", "aTargets": [ 4 ]},
                                        { "sName": "rq.company_email", "aTargets": [ 5 ]},
                                        { "sName": "rq.message", "aTargets": [ 6 ]},
                                        { "sName": "rq.date_request", "aTargets": [ 7 ]}
                                    ],
                    "pageLength": 10, // default record count per page
                    "ajax_url": "<?= base_url('admin/get_requests_ajax') ?>", // ajax source
                    "order": [ [1, "asc"] ], // set first column as a default sort by asc
                    "for":"request"
                    };
                initiate_datatable(options);
            }
            if($("#datatable_blogs").length > 0) {
                options = {"src": $("#datatable_blogs"),
                    "aoColumnDefs": [
                                        { "sName": "id", "aTargets": [ 0 ]},
                                        { "sName": "title", "aTargets": [ 1 ]},
                                        { "sName": "url", "aTargets": [ 2 ]},
                                        { "sName": "status", "aTargets": [ 3 ]},
                                        { "sName": "type", "aTargets": [ 4 ]},
                                        { "sName": "date_published", "aTargets": [ 5 ]}
                                    ],
                    "pageLength": 10, // default record count per page
                    "ajax_url": "<?= base_url('admin/get_blogs_ajax') ?>", // ajax source
                    "order": [ [1, "asc"] ], // set first column as a default sort by asc
                    "for":"blog"
                    };
                initiate_datatable(options);
            }

            if($("#datatable_users").length > 0) {
            
                options = {"src": $("#datatable_users"),
                    "aoColumnDefs": [
                                        { "sName": "id", "aTargets": [ 0 ]},
                                        { "sName": "username", "aTargets": [ 1 ]},
                                        { "sName": "email", "aTargets": [ 2 ]},
                                        { "sName": "status", "aTargets": [ 3 ]},
                                        { "sName": "is_admin", "aTargets": [ 4 ]},
                                        { "sName": "created_at", "aTargets": [ 5 ]}
                                    ],
                    "pageLength": 10, // default record count per page
                    "ajax_url": "<?= base_url('admin/get_users_ajax')?>", // ajax source
                    "order": [ [1, "asc"] ], // set first column as a default sort by asc
                    "for":"user"
                    };
                initiate_datatable(options);
            }

            if($("#datatable_pages").length > 0) {
                options = {"src": $("#datatable_pages"),
                    "aoColumnDefs": [
                                        { "sName": "id", "aTargets": [ 0 ]},
                                        { "sName": "title", "aTargets": [ 1 ]},
                                        { "sName": "url", "aTargets": [ 2 ]},
                                        { "sName": "status", "aTargets": [ 3 ]},
                                        { "sName": "date_published", "aTargets": [ 4 ]}
                                    ],
                    "pageLength": 10, // default record count per page
                    "ajax_url": "<?= base_url('admin/get_pages_ajax') ?>", // ajax source
                    "order": [ [1, "asc"] ], // set first column as a default sort by asc
                    "for":"page"
                    };
                initiate_datatable(options);
            }

            if($("#datatable_report_categories").length > 0) {
                options = {"src": $("#datatable_report_categories"),
                    "aoColumnDefs": [
                                        { "sName": "id", "aTargets": [ 0 ]},
                                        { "sName": "title", "aTargets": [ 1 ]},
                                        { "sName": "url", "aTargets": [ 2 ]},
                                        { "sName": "status", "aTargets": [ 3 ]},
                                        { "sName": "date_published", "aTargets": [ 4 ]}
                                    ],
                    "pageLength": 10, // default record count per page
                    "ajax_url": "<?= base_url('admin/get_categories_ajax') ?>", // ajax source
                    "order": [ [1, "asc"] ], // set first column as a default sort by asc
                    "for":"category"
                    };
                initiate_datatable(options);
            }


            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });

            function initiate_datatable(options){
                var grid = new Datatable();
                grid.init({
                    src: options.src,
                    onSuccess: function (grid, response) {
                        // grid:        grid object
                        // response:    json object of server side ajax response
                        // execute some code after table records loaded
                    },
                    onError: function (grid) {
                        // execute some code on network or other general error  
                    },
                    onDataLoad: function(grid) {
                        // execute some code on ajax data load
                    },
                    serverSide: true,
                    processing: true,
                    loadingMessage: 'Loading...',
                    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                        // So when dropdowns used the scrollable div should be removed. 
                        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                        
                        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                        "aoColumnDefs": options.aoColumnDefs,

                        "lengthMenu": [
                            [10, 20, 50, 100, 150],
                            [10, 20, 50, 100, 150] // change per page values here
                        ],
                        "pageLength": options.pageLength, // default record count per page
                        "ajax": {
                            "url": options.ajax_url, // ajax source
                        },
                        "order": options.order,
                        "drawCallback": function(settings, json) {
                            // alert( 'DataTables has finished its initialisation.' );
                            options.src.on('click', 'tr a.delete_'+options.for, function() {
                                $(this).toggleClass('active');
                            });
                            $('.delete_'+options.for).on('click', function() {
                                id = $(this).data('id');
                                if (confirm('Are you sure you want to delete this?')) {
                                    delete_row(options.src,options.for,id);
                                }
                            });
                        }
                    }
                });

            }
            function delete_row(formSrc,deleteWhat,data_id){
                console.log(data_id);
                $.ajax({
                    type: 'POST',
                    data: { "id" : data_id },
                    url: "<?= base_url('admin/reports/delete_') ?>"+deleteWhat,
                    success: function(html){
                        formSrc.DataTable().rows( formSrc.find('tr active') ).remove().draw();
                    },
                    error:function(jqXHR,exception){
                        // do something on error
                    }
                });
            }


            $('li.nav-item').find('a').each(function(){
                if($(this).attr('href') == window.location.href){
                    $(this).parent().addClass('active open');
                    if($(this).parent().parent().hasClass('sub-menu')){
                        $(this).parent().parent().parent().addClass("active open");
                    }
                }
            });
        });

        </script>
    </body>

</html>