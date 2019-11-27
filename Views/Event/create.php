<h1>New Event</h1>
<form action="/event/create" method="post">
  <div class="form-group">
    <label for="name" >name</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>

  <div class="form-group">
    <label for="type">Type</label>
    <select class="form-control" id="type" name="type" required>
      <?php foreach($EventTypes as $key => $type): ?>
        <option value="<?= $type["id"]?>"><?= $type["name"]?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label for="start" >start Date:</label>
    <input type="date" class="form-control" id="content" name="start" required>
  </div>
  
  <div class="form-group">
    <label for="end" >end Date:</label>
    <input type="date" class="form-control" id="content" name="end" required>
  </div>

  <div class="form-group">
    <label for="reoccuring" >reoccuring</label>
    <input id="id" type="checkbox" name="reoccuring" checked="true">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>