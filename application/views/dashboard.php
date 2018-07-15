<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Welcome ! <?php echo $_SESSION['name']?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('action/inbox/'.$_SESSION['user_id'])?>">Inbox</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('action/contact/'.$_SESSION['user_id'])?>">Contact</a>
      </li>
    </ul>
    
      
      <button class="btn btn-secondary my-2 my-sm-0" type="submit"><a href="<?=base_url('login/logout')?>" style="color:white">Logout</a></button>
   
  </div>
</nav>
<br>
<div class="container">
    <table class="table table-hovered" id ="table">
        <thead>
            <th>#</th>
            <th>Job Title</th>
            <th>Name</th>
            <th>Username</th>
            <th>Action</th>
        </thead>
        
    <table>
    
</div>