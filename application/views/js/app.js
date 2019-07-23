$(document).ready(function(){
  localStorage.setItem('token', "TokenUU"); 
  var token = localStorage.getItem('token');

  $.ajax({
    url: 'http://172.104.46.176/codeigniter/api/post/posts',
    headers: {
        'Authorization':'GRvfHgfFdGvRdcfvEfvvDfcgbF34vcDfvbhH',        
        'Content-Type':'application/json'
    },    
    dataType: 'json',    
    success: function(data){
      console.log('succes: '+data);
    }
  });
  //alert(token);
});