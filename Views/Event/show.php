<h1>Event</h1>
<div class="form-group">
  <label for="name">name</label> <input type="text" class="form-control" id="name" name="name" placeholder="&lt;?= $event[" />" disabled&gt;
</div>
<div class="form-group">
  <label for="name">Event Type</label> <input type="text" class="form-control" id="name" name="name" placeholder="&lt;?= $event[" />" disabled&gt;
</div>
<div class="form-group">
  <label for="start">start Date:</label> <input type="text" class="form-control" id="content" name="start" placeholder="&lt;?= $event[" />" disabled&gt;
</div>
<div class="form-group">
  <label for="end">end Date:</label> <input type="text" class="form-control" id="content" name="end" placeholder="&lt;?= $event[" />" disabled required&gt;
</div>
<div class="form-group">
  <label for="end">reoccuring</label> <?php if($event["reoccuring"]) : ?> <input id="id" type="checkbox" name="reoccuring" checked="checked" disabled="disabled" /> <?php endif; ?> <?php if(!$event["reoccuring"]) : ?> <input id="id" type="checkbox" name="reoccuring" disabled="disabled" /> <?php endif; ?>
</div>
