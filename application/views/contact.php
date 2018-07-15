<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Welcome ! <?php echo $_SESSION['name']?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="<?=base_url('dashboard')?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('action/inbox/'.$_SESSION['user_id'])?>">Inbox</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?=base_url('action/contact/'.$_SESSION['user_id'])?>">Contact</a>
      </li>
    </ul>
    
      
      <button class="btn btn-secondary my-2 my-sm-0" type="submit"><a href="<?= base_url('login/logout')?>" style="color:white">Logout</a></button>
   
  </div>
 
</nav>
<br>
<div class="container">
    <h1><?=$user_details->NAME?>- <?= $job_details->JOB_TITLE?></h1>
    <STRONG></strong>
  </div>
  <br>
  <div class="container container1">
    <?php
        foreach((array)$data as $data):
            if($data['CONTACT_USER_ID'] == $_SESSION['user_id'] && $data['IS_REPLY'] == 0){
                $class =1 ;
            }
            else if($data['CONTACT_USER_ID'] != $_SESSION['user_id'] && $data['IS_REPLY'] == 0){
                $class = 0;
            }
            else if($data['CONTACT_USER_ID'] == $_SESSION['user_id'] && $data['IS_REPLY'] != 0){
                $class = 0;
            }
            else if($data['CONTACT_USER_ID'] != $_SESSION['user_id'] && $data['IS_REPLY'] != 0){
                $class = 1;
            }
            ?>
            <div class = "is-reply-<?= $class?>"><?= $data['MSG']?>   <sub STYLE="COLOR:grey"><?= $data['TIME']?></sub></div><br clear="all" />
            <?php
        endforeach;
    ?>
    		<p class="footer">
                <textarea rows=3 col=5 class="msg"></textarea></i>
                <button class="btn btn-success"><i class="fa fa-send"></i></button>
            </p>
</div>