<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SPA</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        section.page{
          display:none;
        }
        .login-page .card{
          max-width:320px;
          margin:0 auto;
        }
        table{
          width:100%;
        }
        .table td, .table th {
          padding: 0;      
          border: 0;    
          padding-bottom: 5px;
          padding-top: 5px;
        }
        th.title, td.title{
          width:94%;
        }
        th.actions, td.actions{
          width:94%;
        }
        tr.post{
          border-top: 1px solid #dee2e6;
        }
        .post-body{
          display:none;
          background-color:#dee2e6;
        }
        .post-comments{
          display:none;
          background-color:#dee2e6;
        }
        .post.active .post-comments{
          display: table-row;
        }
        .post-body td{
          padding:10px;
        }
        .post-comments td{
          padding:5px;          
        }
        .post-comments table td{
          padding-top:10px;          
        }
        .post-comments tr:nth-child(even) {background-color: #D3D3D3;}
        .link{
          color: #007bff;
          text-decoration: none;
          background-color: transparent;
          cursor: pointer;
        }
        .post.active .post-body{
          display: table-row;
        }
    </style>  
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="/">SPA</a>
          </div>          
        </div>
      </nav>
    </header>
    <main class="container mt-5">
      <section class="page home-page">
        <div class="table-responsive">
          <table id="app-posts" class="table">
          <thead>
            <tr>
            <th scope="col" class="title">Title</th>					
            <th scope="col" class="actions">Delete</th>        
            </tr>
          </thead>
          <tbody class="parent-body">
          
          </tbody>
          </table>
        </div>			
      </section>           
      <section class="page login-page">
        <div class="card">          
            <div class="card-header">Login</div>
            <div class="card-body">
              <form id="login" method="post">
                <input type="text" id="user" class="form-control mb-4" name="user" placeholder="User Name" required autocomplete="off">
                <input type="password" id="password" class="form-control mb-4" name="pass" placeholder="Password" required autocomplete="off">
                <input type="submit" class="btn btn-primary" value="Log In" onclick="loginApp(this.form)">
              </form>
            </div>          
        </div>
      </section>    
    </main>    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <script src="js/app.js" charset="utf-8"></script>     
  </body>
</html>
