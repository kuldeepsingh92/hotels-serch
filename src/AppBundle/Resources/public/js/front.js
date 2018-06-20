
$(function () {
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('search-box'));
    $('#search-box').on('keyup', function (e) {
        $('.pac-container').removeClass('pac-logo');
        let search_box = $(this);
        if (/^[0-9a-zA-Z\s\-\'\/,]$/.test(e.key) || e.key == 'Backspace') {
            let search_query = search_box.val().trim();
            $('.pac-container').find('.pac-hotels').remove();
            if (search_query.length > 0) {
                $.ajax({
                    url: search_url,
                    data: {
                        keywords: search_query
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (!$.isEmptyObject(response.data)) {
                            let html = '<div class="pac-hotels">';
                            $.each(response.data, function (index, property) {
                                html += '<div class="pac-item pac-hotels-item"><span class="pac-icon icon-hotel"></span><span class="pac-item-query">' + property.name.concat(' ', property.locality).replace(new RegExp('(' + response.keywords + ')', 'ig'), '<span class="pac-matched">$1</span>') + '</span><span> ' + property.city.concat(', ', property.state, ', ', ', ', property.country) + '</span></div>';
                            });
                            html += "</div>";
                            $('.pac-container').find('.pac-hotels').remove();
                            $('.pac-container').append(html);
                        }
                    }
                });
            }
        }
        else {
            e.preventDefault();
        }
    });
});