jQuery(document).ready(function($) {
  'use strict';

  $('body').click(function() {
    var settings = {
      url: LLOC.ajaxurl,
      data: {action: 'simple_ping', msg: 'ping'}
    };
    $.ajax(settings).done(function(response) {
      console.debug(response.data);
    });
  });
});
