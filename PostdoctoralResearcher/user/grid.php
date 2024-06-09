<?php 
		include("include/database-connect.phtml");
		include("include/include.phtml");
		new_header_forms($admin,$seed);
		

											?>
    

<div class="panel-body" style="background: #f3f3f3">
    <div class="tab-content">
        <div id="karshenas" class="tab-pane active">
            <!--<a href="#"><i class="icon-chevron-right"></i></a>-->
            <!--   <ul class="breadcrumb2">
                                    <li class="active"><a href="#"><i class="icon-home"></i> صفحه اصلي</a></li>
                                    <li><a href="#"><i class="icon-folder-open"></i>ليست طرح هاي تحقيقاتي</a></li>
                                    <li class=""><a href="#"><i class="icon-paste"></i>پايان نامه ها</a></li>
                                    <li class=""><a href="#"><i class="icon-envelope"></i>ليست نامه ها</a></li>
                                    <li class=""><a href="#"><i class="icon-question-sign"></i>وضعيت طرح ها</a></li>
                                </ul> -->
            <!--<a href="#"><i class="icon-chevron-left"></i></a>-->
            <section class="panel panel-border">
                <header class="panel-heading bg-gradient">
                    وضعيت طرح هاي تحقيقاتي
                                        <div class="pull-left" style="margin-top: -10px;">
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="چاپ"><i class=" icon-print"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="نوسازي"><i class=" icon-refresh"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="ويرايش"><i class=" icon-pencil"></i></a>
                                            <!--<input type="search" placeholder="جستجو" class="form-control search" />-->
                                        </div>
                </header>
                <div class="panel-body">
                    <div id="temp"></div>
                    <div id="uniSelect">

                        <?php 
										$query="select * from daneshkade order by  daneshkade_name  desc";
										$qresult=mysql_query($query) or die("Error in selecting data from daraje elmi");
										?>
                        <label>
                            <select class="form-control" name="daneshkade" id="daneshkade" size="1">
                                <option value="-1" selected="selected">همه</option>
                                <?php 
											while($row_fetched=mysql_fetch_array($qresult))
											 {
											  	    	  
											    echo "<option  value=\"".$row_fetched["cod_daneshkade"]."\">".$row_fetched["daneshkade_name"]."</option>";
											 }
											?>
                            </select>

                            دانشکده/مرکز
                        </label>
                    </div>
                    <table class="display table table-bordered table-striped" id="example">
                        <thead>
                            <tr>
								
                                <th>کد طرح</th>
                                <th>عنوان فارسي</th>
                                <th>دانشکده/مرکز</th>
                                <th>تاريخ ارسال</th>
                                <th>ويرايش</th>
								<th>جزييات</th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </section>
        </div>
        <div id="rahbari" class="tab-pane">محتواي صفحه راهبري در اين قسمت قرار مي گيرد</div>
        <div id="mojri" class="tab-pane">محتواي صفحه مجري در اين قسمت قرار مي گيرد</div>
        <div id="davari" class="tab-pane">محتواي صفحه داوري در اين قسمت قرار مي گيرد</div>
    </div>
</div>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript">

function format(d) {
    var r;
    $.ajax({
        url: "details.php",
        type: "POST",
        data: { cod_tarh: d.cod_tarh },
        async: false,
        dataType: "html",
        success: function(result) {
            r = result;

        }
    });
    return r;
}

$(document).ready(function() {
    var detailRows = [];
    var dt;

    dt = $('#example').DataTable({
        "fnInitComplete": function(oSettings, json) {

            var uniSelect = $("#uniSelect");
            var wrapper = $("#example_wrapper");
            uniSelect.prependTo(wrapper);
        },
        "fnDrawCallback": function(oSettings) {
            var trs = $("#example tr");
            for (var i = 1; i < trs.length; i++) {

                var rowId = ($(trs[i]).attr('id'));
                $("#" + rowId + " td:last-child").trigger('click');

            }
            $('.details-control').on('click', function() {
                debugger;
                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                var idx = $.inArray(tr.attr('id'), detailRows);

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(format(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });
        },
        "sScrollY": 400,
        "bScrollCollapse": true,
        "paging": true,
        'bPaginate': true,
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "bDestroy": true,
        Language: {
            Processing: "?? ??? ??????",
            LengthMenu: "????? ??????? _MENU_",
            ZeroRecords: "????? ???? ???",
            Info: "????? _START_ ?? _END_ ?? ????? _TOTAL_ ????",
            InfoEmpty: "???",
            InfoFiltered: "(????? ??? ?? ????? _MAX_ ????)",
            InfoPostFix: "",
            Search: "?????:",
            Url: "",
            paginate : {
                First: "?????",
                Previous: "????",
                Next: "????",
                Last: "?????"
            },
        },
        "sAjaxSource": "server_side.php",
        "aoColumns": [
            { "data": "cod_tarh" },
            { "data": "tarh_title_farsi" },
            { "data": "daneshkade_name" },
            { "data": "tarh_time" },
            { "data": "edit" },
            { "data": "ss", "sClass": "details-control", "bSortable": false }
        ],

    });
    $('#daneshkade').change(function() {
        var uniSelect = $("#uniSelect");
        var temp = $("#temp");
        uniSelect.appendTo(temp);
        $("#example").DataTable().fnDestroy();
        dt = $('#example').DataTable({
            "fnInitComplete": function(oSettings, json) {

                var uniSelect = $("#uniSelect");
                var wrapper = $("#example_wrapper");
                uniSelect.prependTo(wrapper);
            },
            "fnDrawCallback": function(oSettings) {
                var trs = $("#example tr");
                for (var i = 1; i < trs.length; i++) {
                    var rowId = ($(trs[i]).attr('id'));
                    debugger;
                    $("#" + rowId + " td:last-child").trigger('click');

                }
                $('.details-control').on('click', function() {
                    debugger;
                    var tr = $(this).closest('tr');
                    var row = dt.row(tr);
                    var idx = $.inArray(tr.attr('id'), detailRows);
                    if (row.child.isShown()) {
                        tr.removeClass('details');
                        row.child.hide();

                        // Remove from the 'open' array
                        detailRows.splice(idx, 1);
                    } else {
                        tr.addClass('details');
                        row.child(format(row.data())).show();

                        // Add to the 'open' array
                        if (idx === -1) {
                            detailRows.push(tr.attr('id'));
                        }
                    }
                });
            },
            "paging": false,
            'bPaginate': true,
            'sPaginationType': 'full_numbers',
            "processing": true,
            "serverSide": true,
            "oLanguage": {
                "sProcessing": "<img src='image/ajax-loader-white.gif'>",
                "sLengthMenu": "????? ??????? _MENU_",
                "sZeroRecords": "????? ???? ???",
                "sInfo": "????? _START_ ?? _END_ ?? ????? _TOTAL_ ????",
                "sInfoEmpty": "???",
                "sInfoFiltered": "(????? ??? ?? ????? _MAX_ ????)",
                "sInfoPostFix": "",
                "sSearch": "?????:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "?????",
                    "sPrevious": "????",
                    "sNext": "????",
                    "sLast": "?????"
                },
            },
            "scrollY": "200px",
            "scrollCollapse": true,
            "ajax": "server_side.php?cod_daneshkade=" + $('#daneshkade :selected').val(),
            "aoColumns": [
                { "data": "cod_tarh" },
                { "data": "tarh_title_farsi" },
                { "data": "daneshkade_name" },
                { "data": "tarh_time" },
                { "data": "edit" },
                { "data": "null", "sClass": "details-control", "bSortable": false }
            ]
        });


    });


});



   


</script>

<?php 
  new_footer_forms($admin,$seed);
 ?>
