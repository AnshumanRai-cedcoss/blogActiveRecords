<?php 
// echo "<pre>";
// print_r($_SESSION["user"]);
// echo "</pre><br><br>";
// echo "<pre>";
// print_r($_SESSION["blog"]);
// echo "</pre>";
// echo $_SESSION["user"]["role"];
// die();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Home · Bootstrap v5.1</title>
    

    <!-- Bootstrap core CSS -->
    <link href="../../../public/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
    
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <?php if (!isset($_SESSION["user"])) {?>
            <li><a href="pages/login" class="text-white">Login</a></li>
            <?php } else {
              ?>
              <li><a href="pages/userDash" class="text-white">Dashboard</a></li>
              <?php } ?>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" 
        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        aria-hidden="true" class="me-2" viewBox="0 0 24 24">
        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
        <circle cx="12" cy="13" r="4"/></svg>
        <strong>Blogs</strong>
      </a>
       <button class="navbar-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" 
       aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">My Blogs</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its 
          contents, the creator, etc. Make it short and sweet, but not too short so folks dont 
          simply skip over it entirely.</p>
        <p>
          <a href="<?php echo URLROOT?>pages/dashboard" 
          class="btn btn-primary my-2">Dashboard</a>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
      <div class="container overflow-hidden">
        <form class="row row-cols-lg-auto align-items-center mt-0 mb-3" method="POST">
            <div class="col-lg-6 col-12">
              <label class="visually-hidden" for="inlineForm">Search</label>
              <div class="input-group">
                <input type="text" class="form-control" id="inlineForm" name="searchInput" 
                placeholder="Title or SKU">
              </div>
            </div>
          
            <div class="col-lg-3 col-12">
              <label class="visually-hidden" for="inlineFormSelectPref">Sort By</label>
              <select class="form-select" name="filter" id="inlineFormSelectPref">
                <option selected>Sort By</option>
                <option value="id">Recently Added</option>
                <option value="rating">Popularity</option>
              </select>
            </div>
          
            <div class="col-lg-3 col-12">
              <button type="submit" name="inputBtn" class="btn btn-primary w-100">Search</button>
            </div>
          </form>
      </div>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                if (isset($_SESSION["user"])) {
                $role =  $_SESSION["user"]["role"];
                }
                else {
                  $role = "user";
                }
                // echo $role;
                // display($data, $role);
                // function display($stm, $role)
                // {
                    $html="";

                    foreach ($_SESSION["blog"] as $k => $v) {
                        $text = "";
                        
                        $text = substr($v["text"], 0, 125);
                        $text .='...';
                        $html.= ' <div class="col">
                            <div class="card shadow-sm">
                            <img src="../../../public/images/'.$v["img"].'" alt="" width="90%" 
                            height="300px">
                  
                            <div class="card-body">
                                <h5>'.$v["title"].'</h5>
                              <p class="card-text">BLOG ID :'.$v["id"].'</p> <br>
                              
                              <p class="p-0 m-0">'.$text.'</p>
                              <form action="moreDetails" class="p-0 m-0" method="POST">
                              <input type="hidden" name="id"  value="'.$v["id"].'">
                              <input type="hidden" name="role"  value="'.$role.'">
                              <input class="btn btn-link p-0 m-0" type="submit" 
                              name="productInfo" value="Read More">
                              </form> 
                              <div class="d-flex justify-content-between align-items-center">';
                                if ($role != "user") {
                                $html .=' 
                                <form action="/pages/edit/'.$v["id"].'" method="post">
                                <input type="hidden" name="id" id="pro_id" value = "'.$v["id"].'" >
                                <input class="btn btn-primary" id="edit" type="submit" name="Edit" value="Edit Blog">
                                 </form>
                                <form action="" method="post">
                                <input type="hidden" name="delId" id="pro_id" value="'.$v["id"].'">
                                <input class="btn btn-danger" id="deletebtn" type="submit" 
                                name="delBtn" value="DELETE">
                                </form>
                             ';
                               }
                         $html.=' </div>   </div>
                          </div>
                        </div> ';
                    }
                    echo $html;
                
                
                ?>
</div>
<br>
             
          
        
      
    </div>
  </div>

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">&copy; CEDCOSS Technologies</p>
  </div>
</footer>


    <script src="../node_modules//bootstrap//dist//js//bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="../../../public/assets/js/script.js"></script>  
  </body>
</html>