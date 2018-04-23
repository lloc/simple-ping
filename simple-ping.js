jQuery(document).ready(function($) {
  'use strict';

  $('body').click(function() {
    var settings = {
      url: LLOC.apiurl + 'ping',
      type: Math.random() < 0.5 ? 'GET' : 'POST',
      data: {msg: 'ping'}
    };
    $.ajax(settings).done(function(response) {
      console.debug(response);
    });
  });
});
