<?php
namespace App\Controllers;

use App\Libraries\Controller;
use App\Models\Users;
use Exception;

class Pages extends Controller
{
     public function __construct()
     {
    //     $this->userModel = $this->model('Users');
      //  $this->blogModel = $this->model('Blogs');
     }
    public function index()
    {
        $this->view('pages/sample');
    }
    public function login()
    {
       
        if (isset($_POST["submit"])) {
          $email = $_POST["email"];
          $password = $_POST["password"];
          $user = $this->model('Users');
          $res = $user::find("all");
          foreach ($res as $key => $value) {
              # code...
           if($email == $value->email && $password == $value->password)
           {
               if($value->status == "approved")
               {
               $_SESSION["user"] = array(
                 "id" => $value->id,
                 "firstname" => $value->firstname,
                 "email" => $value->email,
                 "role" => $value->role,
               );
               header("location:home");
             //  break ;
            }
            else{
             echo "<p class='text-danger'>Not approved</p>";
             $this->view('pages/login');
            }
           } 
          }
        }
        $this->view('pages/login'); 
    }
    public function home()
    {
        $blog = $this->model('Blogs');
        $res = $blog::find("all");
       // print_r($res);
        if (!isset($_SESSION["blog"])) {
            $_SESSION["blog"] = array();
            foreach ($res as $key => $value) {
                $oneBlog = array(
                "id" => $value->id,
                "userid" => $value->userid,
                "title" => $value->title,
                "text" => $value->text,
                "img" => $value->img
              );
                array_push($_SESSION["blog"], $oneBlog);
        }
       }
        
        // echo "<pre>";
        // print_r($_SESSION["blog"]);
        // echo "</pre>";


       $this->view('pages/home');
    }

    public function dashboard()
    {
      //  echo "Hello Ashu bsdk";
      $this->view('pages/dashboard');
    }
    public function moreDetails()
    {
      //  die("hello");
      if(isset($_POST["productInfo"]))
      {
          $id = $_POST["id"];
          $role = $_POST["role"];
         // die($_POST["role"]);
         $result = array();
//  echo "<pre>";
// print_r($_SESSION["blog"]);
//  echo "</pre><br><br>";
         foreach ($_SESSION["blog"] as $key => $value) {
             # code...
             if($value["id"] == $id)
             {
                // echo $value["title"] ;
                $result = $_SESSION["blog"][$key];
             }
         }
         array_push($result,$role);
         $this->view("pages/moreDetails", $result);
      }
    }
    public function signup()
    {
        $data="";
        $postdata= $_POST ?? array();
        if (isset($_POST["submit"]) && isset($_POST['username'])&& isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['firstname']) && isset($_POST['lastname'])) {
            // print_r($_POST);
            // die();
            $user = $this->model('Users');
            $user->username = $postdata['username'];
            $user->firstname = $postdata['firstname'];
            $user->lastname = $postdata['lastname'];
            $user->email = $postdata['email'];
            $user->password = $postdata['password'];
            $user->role = "user";
            $user->status = "pending";
            $user->save() ;
        }
        $this->view("pages/signup", $data);
    }

    public function newBlog()
    {
       
       //  print_r($_SESSION["user"]["id"]);
        //  die();
          // die($id." ".$role);
           
          if (isset($_POST["addButton"])) {
            $text = $_POST["blogText"];
            $title = $_POST["pname"];
            $img = $_FILES['c_image']['name'];
            $c_image_temp = $_FILES['c_image']['tmp_name'];
            $blog = $this->model('Blogs');

            
          } else {
            $this->view('pages/newBlog');
          }
    }
    public function users()
    {
       // echo "<h1>Hello</h1>";
       if(isset($_POST["delete"]))
       {
           $id = $_POST["deleteId"];
         //  die($id);
         $this->model('Users')::table()->delete(array("id" => $id));
       }
       if (isset($_POST["chStatus"]))
       {
           $status = $_POST["status"];
           $id = $_POST["id"];
         //  die($id." ".$status);
         $user = $this->model('Users');
         $res = $user::find(array("id" => $id));
         $sta = $res->status;
        // die($status1);
        if($sta == "pending"){
         $res->status = "approved";
        $res->save();
         } 
        else {
        $res->status = "pending";
        $res->save();
       }
    }
       if (isset($result)) {
            unset($result);
        }
        $result = array();
        $user = $this->model('Users');
        $res = $user::find("all");
        $_SESSION["blog"] = array();
        foreach ($res as $key => $value) {
            if ($value->role != "admin") {
                $oneBlog = array(
                "id" => $value->id,
                "username" => $value->username,
                "firstname" => $value->firstname,
                "lastname" => $value->lastname,
                "email" => $value->email,
                "status" => $value->status
                );
                array_push($result, $oneBlog);
            }
        }
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        $this->view("pages/users", $result);
    }
}
