$('.btn-expand-collapse').click(function(e) {
    $('.navbar-primary').toggleClass('collapsed');
});

$(document).ready(function() {

    var element_template = Handlebars.compile(
      $('#element-template').html()
    );
    var element_template_future = Handlebars.compile(
        $('#element-template-future').html()
      );
 
  
    update_elements(element_template,element_template_future);
  
  
  });
  
  function update_elements(element_template,element_template_future){
    $('.table_past > tbody').empty();
    $('.table_future > tbody').empty();
    
    $.get({
      url: 'api/missionpast',
      success: function(data){
        $.map(data, function(oneelem){
          $('.table_past > tbody').append(
            $(element_template(oneelem))
          );
        });
      },
      dataType: 'json'
    });

    $.get({
        url: 'api/missionfuture',
        success: function(data){
          $.map(data, function(oneelem){
            $('.table_future > tbody').append(
              $(element_template(oneelem))
            );
          });
        },
        dataType: 'json'
      });
  }
  
 
  
  
  