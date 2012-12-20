$(document).ready(function() {
  main.start();
  
  /* start main loop */
  setInterval(main.loop, config.refresh_rate);
  
  /* Entering loop */
  $('.enter-room').live('click', function() {
    client.enter_room($(this).attr('id'), $(this).text());
  });
  
  /* send message */
  $('.message').live('keydown', function (e){
    if(e.keyCode == 13) {
      client.send_message($(this).attr('id'), $(this).val());
      $(this).val('');
    }
  });
  
  /* change nickname */
  $('#nick').live('keydown', function (e){
    if(e.keyCode == 13) {
      client.nickname = $(this).val();
    }
  })
  
});