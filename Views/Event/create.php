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
            <option value="<?= $type["id"]?>">
              <?= $type["name"]?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="start">Start Date:</label> <input type="date" class="form-control datePicker" id="content" name="start" required="" />
      </div>
      <div class="form-group">
        <label for="end">End Date:</label> <input type="date" class="form-control datePicker" id="content" name="end" required="" />
      </div>
      <div class="form-group">
        <label for="reoccuring">Reoccuring:</label> <input id="id" type="checkbox" name="reoccuring" checked="true" />
      </div><!-- Divider -->
      <hr class="sidebar-divider" />
      <h5>Assigned Manager Informaton:</h5>
      <!-- <div class="form-group">
        <label for="id">Id:</label> <input type="text" class="form-control" id="content" name="managerId" required="" />
      </div>
      <div class="form-group">
        <label for="email">Email:</label> <input type="email" class="form-control" id="content" name="managerEmail" required="" />
      </div><button type="submit" class="btn btn-primary">Submit</button> -->
      <div class="form-group">
        <label for="type">Manager:</label> <select class="form-control" id="type" name="manager_id" required="">
          <?php foreach($users as $key => $user): ?>
            <option value="<?= $user["id"]?>">
              <?= $user["email"]?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

        <div class="form-group">
            <label class="mb-3 lead">Attendees (Multi-Select):</label>
            <!-- Multiselect dropdown -->
            <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm" name="attending_ids[]" class="selectpicker w-100">
              <?php foreach($users as $key => $user): ?>
                <option value="<?= $user["id"]?>">
                  <?= $user["email"]?>
                </option>
              <?php endforeach; ?>
            </select><!-- End -->
        </div>

      </div><button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<script>

// Get today
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

// Auto set dates to today
$(document).ready( function() {
    var date = new Date();
    var today = date.toDateInputValue();
    $(".datePicker").val(today);
})
</script>