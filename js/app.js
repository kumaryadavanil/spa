var API_url = "http://172.104.46.176/codeigniter";

$(document).ready(function(){
  var token = localStorage.getItem('token');
  if(token){
    var url = API_url + "/api/post/posts";
    loadPosts(url);
  }else{
    hideAuthSections();    
  }

  var form = $('#login');
  form.submit(function (e) {
      e.preventDefault();
      var user = $("#user").val();
      var password = $("#password").val();
      var data_str = {"user" : user, "pass" : password};
      var data = JSON.stringify(data_str);
      loginApp(data);      
  });
});

/**
 * View Post Details
 */
$(document).on("click", 'span.view', function(event) { 
  var id = $(this).data('id');
  if($(this).hasClass('loaded') == false){
    loadComments(id);
  }
  $("tr.post").removeClass('active');
  var post_id = "#post-" + id;
  $(post_id).addClass('active');
});

/**
 * Load Posts lists for next page
 */
$(document).on("click", '.ajax-loader', function(event) { 
  event.preventDefault();
  var url = $(this).attr('href');
  loadPosts(url);
});

/**
 * Delete Post
 */
$(document).on("click", 'span.delete', function(event) { 
  var id = $(this).data('id');
  var post_id = "#post-" + id;
  $(post_id).remove();
  if($(".parent-body .post").length == 0){
    if($(".pagination .next").length == 1){
      $(".pagination .next").trigger('click');
    }else if($(".pagination .prev").length == 1){
      $(".pagination .prev").trigger('click');
    }
  }
});

/**
 * Delete Post
 */
$(document).on("click", '.delete-comment', function(event) { 
  var id = $(this).data('id');
  var comment_id = "#comment-" + id;
  $(comment_id).remove();
});

/**
 * HIde Auth Section
 */
function hideAuthSections(){
  $(".home-page").hide();
  $("section.page.login-page").show();
}

/**
 * Display Auth Section
 */
function displayAuthSections(){
  $("section.page.home-page").show();
  $("section.page.login-page").hide();
}

/**
 * Login To App
 * @param {} data 
 */
function loginApp(PostData){
  var url = API_url + '/api/user/login';
  $.ajax({
    url: url,
    type: 'Post',
    headers: {         
        'Content-Type':'application/json'
    },    
    dataType: 'json',   
    data: PostData, 
    success: function(JSONObject){      
      var token = JSONObject.token;
      localStorage.setItem('token', token); 
      var url = API_url + "/api/post/posts";
      loadPosts(url);
    },
    statusCode: {
      401: function() {
        localStorage.removeItem("token"); 
        alert( "Login Name Or Password is wrong." );
      }
    }
  });  
}

/**
 * Load Posts
 */
function loadPosts(api_url){
  var html;
  $.ajax({
    url: api_url,
    headers: {
        'Authorization':localStorage.getItem('token'),        
        'Content-Type':'application/json'
    },    
    dataType: 'json',    
    success: function(JSONObject){
      displayAuthSections();      
      JSONODatabject = JSONObject['data'];
      for (var key in JSONODatabject) {
        if (JSONODatabject.hasOwnProperty(key)) {
          console.log(JSONODatabject[key]["id"] + ", " + JSONODatabject[key]["id"]);
          html += buildRow(JSONODatabject[key]);
        }
      }      
      $("#app-posts tbody.parent-body").html(html);
      var links = parse_link_header(JSONObject['links']);
    }
  });
}

/**
 * Load Posts
 */
function loadComments(cid){
  var url = API_url + '/api/comment/comments/' + cid;
  var comments;
  comments += "<tr class='post-comments'>";
  comments += "<td colspan='2'><h4>Comments</h4></td>";                    
  comments += "</tr>";
  $.ajax({
    url: url,
    headers: {
        'Authorization':localStorage.getItem('token'),        
        'Content-Type':'application/json'
    },    
    dataType: 'json',    
    success: function(JSONObject){
      for (var key in JSONObject) {
        if (JSONObject.hasOwnProperty(key)) {
          console.log(JSONObject[key]["id"] + ", " + JSONObject[key]["id"]);
          comments += buildCommentRows(JSONObject[key]);
        }
      }
      var id = "#post-" + cid + " .post-comments table";
      $(id).html(comments);
      var id = "#post-" + cid + " .view.link";
      $(id).addClass('loaded');      
      console.log(id);
      console.log(comments);
    }
  });
}


/**
 * Build Row Data
 * @param {} JSONObjec 
 */
function buildRow(JSONObjec){  
  var html = "<tr id='post-" + JSONObjec.id + "' class='post'>";
    html += "<td colspan='2'>";
      html += "<table class='inner-table' width='100%' collpadding=0>";
        html += "<tr>";
          html += "<td class='title'><span class='view link' data-id='"+ JSONObjec.id +"'>" + JSONObjec.id + ' - ' + JSONObjec.title +"</span></td>";          
          html += "<td class='actions'><span class='btn btn-danger delete link' data-id='"+ JSONObjec.id +"'>Delete</span></td>";
        html += "</tr>";
        html += "<tr class='post-body'>";
          html += "<td colspan='2'>"+ JSONObjec.body +"</td>";                    
        html += "</tr>";        
        html += "<tr class='post-comments'>";
          html += "<td colspan='2'><table></table></td>";                    
        html += "</tr>";
      html += "</table>";
    html += "</td>";
  html += "</tr>";
  return html;
}


/**
 * Build Row Data
 * @param {} JSONObjec 
 */
function buildCommentRows(JSONObjec){  
  var html = "<tr id='comment-"+ JSONObjec.id+"' class='post'>";
    html += "<td colspan='2'>";
      html += JSONObjec.body;
      html += "<span class='btn btn-danger delete-comment link float-right' data-id='"+ JSONObjec.id +"'>Delete</span>";
    html += "</td>";
  html += "</tr>";
  return html;
}

/**
 * Build Pager
 * @param {*} header 
 */
function parse_link_header(header) {
  if (header.length === 0) {
      throw new Error("input must not be of zero length");
  }
  var link_html = "<nav aria-label='Page navigation example'><ul class='pagination pagination-lg mt-4'>";
  // Split parts by comma
  var parts = header.split(',');
  var links = {};
  // Parse each part into a named link
  for(var i=0; i<parts.length; i++) {
      var section = parts[i].split(';');
      if (section.length !== 2) {
          throw new Error("section could not be split on ';'");
      }
      var url = section[0].replace(/<(.*)>/, '$1').trim();
      var name = section[1].replace(/rel="(.*)"/, '$1').trim();      
      link_html += "<li class='page-item'><a href='" + url + "' class='page-link text-capitalize ajax-loader "+ name +"'>" + name + "</li>";
  }
  link_html += "</ul><nav>";
  $("#app-posts tbody.parent-body").append(link_html);
}