function getPensumDetailed(el, url) {
    let element = $(el);
    let pensum_id = element.data('model_pensum_id');
    let period_id = element.data('model_period_id');
    let user_id = element.data('model_user_id');
    let with_ref_date = false;
    let refDate = '';
    $.post(
        url,
        {
            period_id, user_id, with_ref_date, refDate
        },
        function (data) {
            $('.userperiod_extradetail').find('button').remove();
            $('.userperiod_extradetail').html(data);
        }
    )

}