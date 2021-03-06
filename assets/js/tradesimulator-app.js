$(function() {
    let url = base + "Traderoutes/searchStations";

    // station name autocomplete
    $("#origin-station, #destination-station").autocomplete({
        source: url,
        minLength: 2,
        messages: {
            noResults: '',
        },
        select: function(event, ui) {
            if ($(this).hasClass('origin-station')) {
                $(".origin").val(ui.item.value);
            } else {
                $(".destination").val(ui.item.value);
            }
        }
    });

    // set station names
    $("#traderoute").change(function() {
        const fromStationName = $("#traderoute option:selected").text().substring(0, $("#traderoute option:selected").text().indexOf('>>') - 1);
        const toStationName = $("#traderoute option:selected").text().substr($("#traderoute option:selected").text().indexOf(">>") + 3);
        $("#origin-station").val(fromStationName);
        $("#destination-station").val(toStationName);
    });

    // submit
    $(".btn-submit-ts").on('click', function(e) {
        if (!$(this).hasClass('disabled')) {
            var origin = $("#origin-station").val(),
                destination = $("#destination-station").val(),
                buyer  = $("#buyer option:selected").attr('id'),
                seller = $("#seller option:selected").attr('id'),
                list   = $("#stocklist option:selected").attr('id');
            if (origin && destination && buyer && seller && list) {
                $(".tradesim").hide();
                $('.panel-loading').show();
            } else {
                e.preventDefault();
                toastr.error("Missing information");
            }
        } else {
            e.preventDefault();
        }
    });

    // alternate between query and result view
    if ($(".tradesim").data('res')) {
        $(".tradesim").hide();
        $(".tradesim-res").show();
    } else {
        $(".tradesim").show();
        $(".tradesim-res").hide();
    }

    // result table
    let table = $('#ts-table').DataTable({
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
        lengthMenu: [
            [50, 75, 100, -1],
            [50, 75, 100, "All"]
        ],
        autoWidth: false,
        buttons: [{
            extend: 'copy',
            className: 'btn-sm'
        }, {
            extend: 'csv',
            title: 'tradesimulator',
            className: 'btn-sm'
        }, {
            extend: 'pdf',
            title: 'tradesimulator',
            className: 'btn-sm'
        }, {
            extend: 'print',
            className: 'btn-sm'
        }],
        aoColumnDefs: [{
            bSearchable: false,
            aTargets: [3]
        }]
    });
});