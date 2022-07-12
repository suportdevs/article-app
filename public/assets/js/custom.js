$(document).ready(function() {
    // start index checked unchecked
    $(document).on("change", ".check_all", function () {
        if ($(this).is(":checked")) {
            $('input:checkbox.check_item').not(this).prop('checked', this.checked);
        } else {
            $('input:checkbox.check_item').not(this).prop('checked', this.checked);
        }
    });

    $(document).on("change", "input:checkbox.check_item", function () {
        if ($(this).is(":checked")) {
            $('.check_all').not(this).prop('checked', this.checked);
        } else {
            if($('.check_item').filter(':checked').length == 0) {

                $('.check_all').not(this).prop('checked', this.checked);
            }
        }
    });
    // end index checked unchecked
    $('.select2search').select2();
    
})

$(document).on("submit", "#searchForm", function(event){
    event.preventDefault()
    const url = $(this.action);
    search(url)
})
const search = (searchUrl) => {
    axios.post(url, {
        data: $(this).serialize()
    }).then((response) => {
        console.log(response)
    }).catch((error) => {
        console.log(error)
    })
}