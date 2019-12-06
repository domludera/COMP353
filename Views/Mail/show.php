<h1><?= $mail["subject"]?>
</h1>
<hr />
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="form-group">
      <h6 class="m-0 font-weight-bold text-primary">Inbox</h6>
    </div>
  </div>
  <div class="card-body">
    <label for="text">From<br />
    (id of the for now, we need to implement email search in controller)</label> <input type="text" class="form-control" id="email" name="from" placeholder="<?= $mail["from_user_id"]?>" disabled>
    <div class="form-group">
      <label for="text">Message</label> 
      <textarea rows="4" class="form-control" id="content" name="content" cols="50" disabled="disabled"><?= $mail["content"]?>
</textarea>
    </div>
  </div>
</div>
