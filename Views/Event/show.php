<h1>Event</h1>

<div class="form-group">
  <label for="name" >name</label>
  <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["name"]?>" disabled>
</div>


<div class="form-group">
  <label for="name" >Event Type</label>
  <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["type"]?>" disabled>
</div>

<div class="form-group">
  <label for="start" >start Date:</label>
  <input type="text" class="form-control" id="content" name="start" placeholder="<?= $event["start_at"]?>" disabled>
</div>

<div class="form-group">
  <label for="end" >end Date:</label>
  <input type="text" class="form-control" id="content" name="end" placeholder="<?= $event["end_at"]?>"  disabled required>
</div>

<div class="form-group">
  <label for="end" >reoccuring</label>
  
<?php if($event["reoccuring"]) : ?>
  <input id="id" type="checkbox" name="reoccuring" checked="true" checked disabled>
<?php endif; ?>

<?php if(!$event["reoccuring"]) : ?>
  <input id="id" type="checkbox" name="reoccuring" disabled>
<?php endif; ?>


</div>