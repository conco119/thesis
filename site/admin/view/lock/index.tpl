<div class="row">
    <div class="x_panel">
        <div class="x_title">
            <h2>Khóa sổ</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>


    </div>
</div>


<!-- Order Detail -->
<div class="modal fade" id="orderDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form-horizontal"></div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript"
        src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
{literal}
    <script>
        $(document).ready(function () {
            $('#date_from').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function () {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function () {
                $('#date_to').change();
            });
        });

        function filter() {
            var filter = $("#filter").val();
            var supp = $("#supp").val();
            var date = $("#date_ex").val();
            var url = "./?mod=report&site=performance";
            url += "&filter=" + filter;
            url += "&supp=" + supp;
            url += "&date=" + date;

            if (filter == "1") {
                var date_from = $("#date_from").val();
                var date_to = $("#date_to").val();
                url += "&date_from=" + date_from;
                url += "&date_to=" + date_to;
            } else if (filter == "2") {
                var year = $("#year").val();
                var month = $("#month").val();
                url += "&year=" + year;
                url += "&month=" + month;
            }

            window.location.href = url;
        }

        function PerformDetail(date) {
            $("#orderDetail .modal-body").load(
                    "?mod=report&site=ajax_perform_detail", {
                        'date': date
                    });
        }
    </script>
{/literal}
