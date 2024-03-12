jQuery(document).ready(function ($) {
  $('.quotes-filter').on('change', function () {
    const author = $('.author').val();
    const category = $('.category').val();
    const tag = $('.tag').val();

    const data = {
      action: 'filter_quotes',
      nonce: quotes_ajax_params.nonce,
      author,
      category,
      tag
    };

    $.ajax({
      url: quotes_ajax_params.ajax_url,
      type: 'POST',
      data: data,
      beforeSend: function () {
        // loading state
      },
      success: function (response) {
        // Update the filtered quotes
        $('.quotes-archive-wrapper').html(response);
      },
      error: function (xhr, textStatus, error) {
        console.log(xhr.responseText);
      }
    });
  });
});