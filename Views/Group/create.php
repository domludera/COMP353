<h1>New Group</h1>
<p>//TO DO groups will be created inside of events, input "Event ID" will be autofilled with the respective event</p>
<form action="/group/create" method="post">
    <div class="form-group">
        <label for="text">Group name</label>
        <input type="text" class="form-control" id="name" name="groupname" required>
        <label for="text">Event ID</label>
        <input type="text" class="form-control" id="name" name="event_name" value="3" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>