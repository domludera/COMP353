<h1>New Event</h1>
<form action="/event/create" method="post">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="form-group">
        <label for="name">Name:</label> <input type="text" class="form-control" id="name" name="name" required="" />
      </div>
      <div class="form-group">
        <label for="type">Type:</label> <select class="form-control" id="type" name="type" required="">
          <?php foreach($EventTypes as $key => $type): ?>
          <option value="&lt;?= $type[">
            "&gt;<?= $type["name"]?>
          </option><?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="start">Start Date:</label> <input type="date" class="form-control" id="content" name="start" required="" />
      </div>
      <div class="form-group">
        <label for="end">End Date:</label> <input type="date" class="form-control" id="content" name="end" required="" />
      </div>
      <div class="form-group">
        <label for="reoccuring">Reoccuring:</label> <input id="id" type="checkbox" name="reoccuring" checked="true" />
      </div><!-- Divider -->
      <hr class="sidebar-divider" />
      <h5>Assigned Manager Informaton:</h5>
      <div class="form-group">
        <label for="id">Id:</label> <input type="text" class="form-control" id="content" name="managerId" required="" />
      </div>
      <div class="form-group">
        <label for="email">Email:</label> <input type="email" class="form-control" id="content" name="managerEmail" required="" />
      </div><button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
