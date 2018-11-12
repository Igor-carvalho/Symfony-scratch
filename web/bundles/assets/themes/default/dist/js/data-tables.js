/**
 * Created by dani on 5/10/15.
 */


function fnFormatDetails(oTable, nTr, options)
{

    var sOut = '<table class="table">';
    sOut += '<tr class="odd text-center"><td style="color:black">'+options.data+'</td></tr>';
    sOut += '</table>';
    return sOut;
}

var show_inner = function(oTable,$this,data,dataType){
    $this.on('click', 'tbody td .show-inner', function() {
        $this=$(this);
        var nTr = $this.parents('tr')[0];
        if (oTable.fnIsOpen(nTr))
        {
            /* This row is already open - close it */
            $this.addClass("row-details-close").removeClass("row-details-open");
            $this.find('i').addClass("fa-plus").removeClass("fa-minus");
            oTable.fnClose(nTr);
        }
        else
        {
            $.ajax({
                type: "POST",
                url: $this.data('href'),
                data: data || {},
                dataType: dataType || "html",
                beforeSend: block_screen(),
                error: function(respuesta) {
                    toastr.error(txtNoDetails, toastrError);
                }
            }).done(function(respuesta) {
                $this.addClass("row-details-open").removeClass("row-details-close");
                $this.find('i').addClass("fa-minus").removeClass("fa-plus");
                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr, {data:respuesta}), 'table-details');
                $('.table-details').attr('colspan', '12');
            }).always(function() {
                unblock_screen();
            });
        }
        return false;
    });
}


if($(".datatable").length){
    $(".datatable").each(function(){
        var dtable = $(this).dataTable({
            'aLengthMenu':[[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]],
            "bStateSave": true
        });

        show_inner(dtable,$(this),{},"html");
    });

}

function listNumElementShow(cookieName) {
    var num_element_list = $.cookie(cookieName) || 10;
    $('.dataTables_length select').change(function (e) {
        $.cookie(cookieName, $(this).val());
    });
    $('.dataTables_length select').val(num_element_list);
    $('.dataTables_length select').change();
}

function addOptionAll() {
    $('.dataTables_length select').append("<option value='all'>All</option>");
}

