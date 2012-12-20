var ui = {
  /* config */
  rooms_holder: '#chat-ui-rooms',
  rooms_list: '#rooms-list',
  chat_rooms: '#opened-rooms',
  opened_rooms: new Array(),
  
  /**
   * Build user interface
   */
  build: function() {
    $(ui.rooms_holder).slideDown();
    ui.refresh_rooms();
  },
  
  /**
   * Refresh room list
   */
  refresh_rooms: function() {
    $.post(config.s_addr, { action: 'refresh_rooms' }, function(r) {
      $(ui.rooms_list).html('');
      for ( i in r ) {
        $(ui.rooms_list).append('<p id="'+i+'" class="enter-room">'+r[i]+'</p>');
      }
    }, 'json');
  },
  
  /**
   * Refresh messages in chat windows
   */
  refresh_messages: function(id) {
    $.post(config.s_addr, { action: 'refresh_messages', room: id }, function(r) {
      $('#room-box-'+id+' .messages').html('');
      for ( i in r ) {
        $('#room-box-'+id+' .messages').append('<p class="message-row">'+r[i]+'</p>');
      }
    }, 'json');
  }
  
};