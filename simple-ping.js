jQuery(document).ready(function($) {
  'use strict';

  $('body').click(function() {
    var settings = {
      url: LLOC.apiurl + 'ping',
      type: 'POST',
      data: {msg: 'ping'}
    };
    $.ajax(settings).done(function(response) {
      console.debug(response);
    });
  });
});
