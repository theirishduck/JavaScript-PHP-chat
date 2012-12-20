var client = {
  
  token: null,
  nickname: '',
  
  /**
   * Connect to server
   */
  connect: function() {
    $.post(config.s_addr, { action: 'connect' }, function(r) { client.token = r.token; client.nickname = $('#nick').val(); }, 'json');
  },
  
  /**
   * Enter chat room
   */
  enter_room: function(id, name) {
    if ( ui.opened_rooms[id] == undefined ) {
      var div_id = 'room-box-'+id;
      
      $(ui.chat_rooms).append('<div id="'+div_id+'" class="room-box"><div class="chat-ui-title">'+name+'</div><div class="messages"></div><input type="text" class="message" id="'+id+'" /></div>');
      $('#'+div_id).slideDown();
      ui.opened_rooms[id] = 1;
    }
  },
  
  /**
   * Send a new message to a room
   */
  send_message: function(id, msg) {
    $.post(config.s_addr, { token: client.token, action: 'send_message', message: msg, room: id, nick: client.nickname }, function(r) { ui.refresh_messages(id); }, 'json');
  }
  
};