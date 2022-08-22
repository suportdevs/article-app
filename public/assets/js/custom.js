$(document).ready(function() {
    // start index checked unchecked
    $(document).on("change", ".check_all", function () {
        if ($(this).is(":checked")) {
            $('input:checkbox.check_item').not(this).prop('checked', this.checked);
            $(".check_item").closest("tr").not(".check_all").css({"background-color": "#ef002c45"});
            $("#deleteMultiple").prop('disabled', false);
            $("#approvedMultiple").prop('disabled', false);
        } else {
            $('input:checkbox.check_item').not(this).prop('checked', this.checked);
            $(".check_item").closest("tr").not('.check_all').css({"background-color": ""});
            $("#deleteMultiple").prop('disabled', true);
            $("#approvedMultiple").prop('disabled', true);
        }
    });

    $(document).on("change", "input:checkbox.check_item", function () {
        if ($(this).is(":checked")) {
            $(this).closest("tr").not(".check_all").css({"background-color": "#ef002c45"});
        } else {
            $(this).closest("tr").not(".check_all").css({"background-color": ""});
        }
        if($('.check_item:checked').not(".check_all").length > 0){
            $('.check_all').not(this).prop('checked', true);
            $("#deleteMultiple").prop('disabled', false);
            $("#approvedMultiple").prop('disabled', false);
        }else{
            $('.check_all').prop('checked', false);
            $("#deleteMultiple").prop('disabled', true);
            $("#approvedMultiple").prop('disabled', true);
        }
    });
    // end index checked unchecked
    $('.select2search').select2();

    $(document).on("submit", "#searchForm", function(e){
        e.preventDefault();
        showPreloader();
        search(this.action);
    });
    
    const search = (url) => {
        $.ajax({
            url: url,
            type: 'get',
            data: $("#searchForm").serialize(),
            success: function (data) {
                hidePreloader();
                $("#ajaxContent-wraper").html(data);
                console.log(data);
            },
            error: function(xhr, status){
                hidePreloader();
                console.log(xhr);
            }
        });
    }

    $(document).on('click', '#clear', function () {
        $('#searchForm')[0].reset();
        $('#searchForm').trigger('submit');
    });
    // showPreloader
    const showPreloader = () => {
        $(document.body).css({ 'cursor': 'wait' });
        $("#preloader").show();
    }
    // hidePreloader();
    const hidePreloader = () => {
        $(document.body).css({ 'cursor': 'default' });
        $("#preloader").hide();
    }

    // delete multiple data
    $(document).on("click", "#deleteMultiple", (e) => {
        e.preventDefault();
        const _url = $("#formList").attr('action');
        const _form = $("#formList");
        let _rc = confirm("Are you sure about this action? This cannot be undone!");
        if (_rc === true) {
            axios.post(_url, _form.serialize()).then((response) => {
                toastr.success(response.data);
                $("#searchForm").trigger('submit');
            }).catch((error) => {
                toastr.error(error.response.data.message);
            })
        }
    });

    // approved multiple data
    $(document).on("click", "#approvedMultiple", (e) => {
        e.preventDefault();
        const _url = $(e.target).data('url');

        const _form = $("#formList");
        let _rc = confirm("Are you sure about this action? This cannot be undone!");
        if (_rc === true) {
            axios.post(_url, _form.serialize()).then((response) => {
                toastr.success(response.data);
                $("#searchForm").trigger('submit');
            }).catch((error) => {
                toastr.error(error.response.data.message);
            })
        }
    });
})

