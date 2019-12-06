<h1>New Mail</h1>
<form action="/mails/create" method="post">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="form-group">
        <h6 class="m-0 font-weight-bold text-primary">Outgoing</h6>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="text">To<br />
        (id of the for now, we need to implement email search in controller)</label> <input type="text" class="form-control" id="email" name="to" required="" />
      </div>
      <div class="form-group">
        <label for="subject" required="">Subject:</label> <input type="text" class="form-control" id="content" name="subject" required="" />
      </div>
      <div class="form-group">
        <label for="text" required="">Message</label> 
        <textarea rows="4" class="form-control" id="content" name="content" cols="50" required=""></textarea>
      </div><button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
