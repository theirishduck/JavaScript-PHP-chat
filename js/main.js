var main = {
  /* start the application */
  start: function() {
    ui.build();
    client.connect();
  },
  
  /* main loop, refresh rooms and messages */
  loop: function() {
    ui.refresh_rooms();
    
    for ( i in ui.opened_rooms )
      ui.refresh_messages(i);
  }
}