<h1>New Mail</h1>
<form action="/mail/create" method="post">
  <div class="form-group">
    <label for="text" >To <br>(id of the  for now, we need to implement email search in controller)</label>
    <input type="text" class="form-control" id="email" name="to" required>
  </div>

  <div class="form-group">
    <label for="subject" required>Subject:</label>
    <input type="text" class="form-control" id="content" name="subject" required>
  </div>
  
  <div class="form-group">
    <label for="text" required>Content</label>
    <textarea rows="4" class="form-control" id="content" name="content" cols="50" required></textarea>
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>