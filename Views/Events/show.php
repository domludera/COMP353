<?php
require_once(ROOT . 'Models/Event.php');
$eventManager = new Event();
$id = $_SESSION['user'];
?>

<h1>Event</h1>
<div class="form-group">
  <label for="name">name</label> <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["name"]?>" disabled/>
</div>

<div class="form-group">
  <label for="name">Manager</label> <input type="text" class="form-control" id="manager" name="manager" placeholder="<?= $event["manager_email"]?>" disabled/>
</div>

<div class="form-group">
  <label for="name">Event Type</label> <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["type"]?>" disabled/>
</div>
<div class="form-group">
  <label for="start">start Date:</label> <input type="text" class="form-control" id="content" name="start" placeholder="<?= $event["start_at"]?>" disabled/>
</div>
<div class="form-group">
  <label for="end">end Date:</label> <input type="text" class="form-control" id="content" name="end" placeholder="<?= $event["end_at"]?>" disabled required/>
</div>
<div class="form-group">
  <label for="end">reoccuring</label> <?php if($event["reoccuring"]) : ?>
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