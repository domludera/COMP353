<h1>Mail</h1>
<hr/>

<div class="form-group">
  <label for="text" >From <br>(id of the  for now, we need to implement email search in controller)</label>
  <input type="text" class="form-control" id="email" name="from"  placeholder="<?= $mail["from_user_id"]?>" disabled>
</div>

<div class="form-group">
  <label for="subject">Subject:</label>
  <input type="text" class="form-control" id="content" name="subject" placeholder="<?= $mail["subject"]?>" disabled>
</div>

<div class="form-group">
  <label for="text">Content</label>
  <textarea rows="4" class="form-control" id="content" name="content" cols="50" disabled><?= $mail["content"]?></textarea>
</div>
