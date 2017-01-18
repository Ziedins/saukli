$(document).ready(function(){
  // ajax setup
  $.ajaxSetup({
    url: 'rate.php',
    type: 'POST',
    cache: 'false'
  });

  $('.rate').click(function(){
    var self = $(this); 
    var action = self.data('action');  
    var parent = self.parent().parent(); 
    var postid = parent.data('postid'); 
    var score = parent.data('score');


    if (!parent.hasClass('.disabled')) {

      if (action == 'up') {

        parent.find('.rating-score').html(++score).css({'color':'orange'});

        self.css({'color':'orange'});

        $.ajax({data: {'postid' : postid, 'action' : 'up'}});
      }

      else if (action == 'down'){

        parent.find('.rating-score').html(--score).css({'color':'blue'});

        self.css({'color':'blue'});

        $.ajax({data: {'postid' : postid, 'action' : 'down'}});
      };

      parent.addClass('.disabled');
    };
  });
});