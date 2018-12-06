$('.btn-expand-collapse').click(function(e) {
    $('.navbar-primary').toggleClass('collapsed');
});

$(document).ready(function() {

    var element_template = Handlebars.compile(
      $('#element-template').html()
    );
 
  
    update_elements(element_template);
  
  
  });
  
  function update_elements(element_template){
    $('.table_past > tbody').empty();
  
    $.get({
      url: '',
      success: function(data){
  
        $.map(data.missions, function(file){
          $('.table_past > tbody').append(
            $(element_template(missions))
          );
        });

      },
      dataType: 'json'
    });
  }
  
 
  
  
  