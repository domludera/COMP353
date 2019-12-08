<?php
require_once(ROOT . 'Models/Event.php');
$eventManager = new Event();
$id = $_SESSION['user'];
?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
  </li>
</ul>
<hr>
<!-- General Information -->
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <h1>Event</h1>
    <div class="form-group">
      <label for="name">Name</label> <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["name"]?>" disabled/>
    </div>

    <div class="form-group">
      <label for="name">Manager</label> <input type="text" class="form-control" id="manager" name="manager" placeholder="<?= $event["manager_email"]?>" disabled/>
    </div>

    <div class="form-group">
      <label for="name">Event Type</label> <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["type"]?>" disabled/>
    </div>
    <div class="form-group">
      <label for="start">Start Date:</label> <input type="text" class="form-control" id="content" name="start" placeholder="<?= $event["start_at"]?>" disabled/>
    </div>
    <div class="form-group">
      <label for="end">End Date:</label> <input type="text" class="form-control" id="content" name="end" placeholder="<?= $event["end_at"]?>" disabled required/>
    </div>
    <div class="form-group">
      <label for="end">Reoccuring</label> <?php if($event["reoccuring"]) : ?>
        <input id="id" type="checkbox" name="reoccuring" checked="checked" disabled="disabled" />
      <?php endif; ?>
      <?php if(!$event["reoccuring"]) : ?>
          <input id="id" type="checkbox" name="reoccuring" disabled="disabled" />
      <?php endif; ?>
    </div>
    <hr>

    <h2>Event Groups</h2>

    <?php if($eventManager->isAttending($event["id"],$id)) : ?>
      <a class="btn btn-primary col-12" href="/groups/create/<?= $event["id"]?>" role="button">New</a>
    <?php endif; ?>
    <ul class="list-group">
      <?php foreach($groups as $key => $group): ?>
        <a href="/groups/show/<?= $group["id"]?>"><li class="list-group-item"><?= $group["name"]?></li></a>
      <?php endforeach; ?>
    </ul>

    <hr>

    <h2>Attendees</h2>
    <ul class="list-group">
      <?php foreach($attendees as $key => $user): ?>
        <li class="list-group-item"><?= $user["email"]?></li> 
      <?php endforeach; ?>
    </ul>
    
  </div>
  <!-- General Information End -->

  <!-- Posts-->

  <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">

    <!-- Post something -->
    <form action='/posts/create/<?=$event["reoccuring"]?>' method="POST">
      <div class="form-check">
        <label for="exampleInputEmail1">Post Something</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="What is on your mind" required>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    
    <!-- Posts -->
    <hr>

    <div class="row">
      <div class="col-12">

        <h3 class="text-center">Posts</h3>

        <!-- Post lists -->
        
        <?php foreach($posts as $key => $post): ?>
          <div class="post">
            <img src="https://via.placeholder.com/50" alt="Avatar">
            <p><?= $post["content"]?></p>
            <span class="time-right">11:00</span>
          </div>
        <?php endforeach; ?>

        <?php if(count($posts) == 0) : ?>
          <h4 class="text-center"> There doesn't seem to be any posts yet!</h4>
        <?php endif; ?>

      </div>

    </div>

    <hr>

  </div>
  <!-- Posts End-->

</div>