<?php
require_once(ROOT . 'Models/Event.php');
$eventManager = new Event();
$id = $_SESSION['user'];

require_once(ROOT . 'Models/User.php');
$currentUser = new User();

?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
  </li>
<!-- General Information -->
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <h1>Event Details</h1>
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
 <hr>
<?php if($currentUser->isController($id) || $currentUser->isAdmin($id)) : ?>

<h2>Event Resources</h2>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
				<thead>
					<tr>
						<th>Resource</th>
						<th>Data</th>
						<th>Rate (CAN$)</th>
					</tr>
				</thead>
				<?php if ($eventResources && count($eventResources) > 0) : ?>
					<tbody>
						<?php foreach($eventResources as $key => $eventResource): ?>
							<tr>
								<td width="20%"><?= $eventResource["resource_name"]?></td>
								<td width="15%"><?= $eventResource["resource_data"]?></td>
								<td width="10%"><?= $eventResource["rate"]?></td>
							</tr><?php endforeach; ?>
					</tbody>
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>
<hr>

<h2>Billing</h2>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
				<thead>
					<tr>
						<th>Bill Number</th>
						<th>Starting Period</th>
						<th>Ending Period</th>
						<th>Total</th>
					</tr>
				</thead>
			
				<?php if ($billedEventResources && count($billedEventResources) > 0) : ?>
				<tbody>
				<?php foreach($billedEventResources as $key => $billedEventResource): ?>
						<tr>
						
							<td width="5%"><?= $billedEventResource["bill_id"]?></td>
							<td width="5%"><?= $billedEventResource["start_at"]?></td>
							<td width="5%"><?= $billedEventResource["end_at"]?></td>
							<td width="5%"><?= $billedEventResource["total"]?></td>
						</tr>
					<?php endforeach; ?>
				</tbody> 
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>

<?php endif; ?>	  
	  
  </div>
  <!-- General Information End -->
<!-- Posts-->

  <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">


    <!-- Post something -->
    <?php if($eventManager->isAttending($event["id"],$id)) : ?>
    <form action='/posts/create/<?=$event["id"]?>' method="POST">
      <div class="form-check">
        <label for="exampleInputEmail1">Post Something</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="What is on your mind" required>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    <hr>
    <?php endif; ?>

    <!-- Posts -->

    <div class="row">
      <div class="col-12">

        <h3 class="text-center">Posts</h3>

        <!-- Post lists -->

        <!-- Contains posts -->

        <?php foreach($posts as $key => $post): ?>

          <div class="post">
            <img src="https://via.placeholder.com/50" alt="Avatar">
            <p><?= $post["content"]?></p>
            <span class="time-left"><?= $post["email"]?></span>  
            <span class="time-right"><?= $post["created_at"]?></span>  
          </div>
          <!-- comment something -->
          <?php if($eventManager->isAttending($event["id"],$id)) : ?>
          <form action='/comments/create/<?=$post["id"]?>' method="POST">
            <div class="form-check">
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="Comment" required>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
          <?php endif; ?>

          <?php foreach($post["comments"] as $key => $comment): ?>
            <div class="comment">
              <p><?= $comment["content"]?></p>
              <span class="time-left"><?= $comment["email"]?></span>  
              <span class="time-right"><?= $comment["created_at"]?></span>  
            </div>
            <br>
          <?php endforeach; ?>

        <?php endforeach; ?>

        <!-- No posts -->
        <?php if(count($posts) == 0) : ?>
          <h4 class="text-center"> There doesn't seem to be any posts yet!</h4>
        <?php endif; ?>

      </div>

    </div>

    <hr>

  </div>
  <!-- Posts End-->

<style>
/* .post{
  background-color: grey;
  color: white;
  margin: 10px;
} */
.comment{
  margin:20px;
  word-wrap: break-word;
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
}
/* Chat containers */
.post {
  word-wrap: break-word;
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}
/* Darker chat container */
.darker {
  border-color: #ccc;
  background-color: #ddd;
}
/* Clear floats */
.post::after{
  content: "";
  clear: both;
  display: table;
}
/* Style images */
.post img{
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}
/* Style the right image */
.post img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}
/* Style time text */
.time-right {
  float: right;
  color: #aaa;
}
/* Style time text */
.time-left {
  float: left;
  color: #999;
}
    .tab-content{
        width: 100%;
        margin: 10%;
    }
</style>
