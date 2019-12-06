<h1>New Group</h1>
<form action="/groups/create" method="post">

    <input type="hidden" class="form-control" id="name" name="event_id" value="<?=$eventId?>" required>

    <div class="form-group">
        <label for="text">Group name</label>
        <input type="text" class="form-control" id="name" name="group_name" required>
    </div>

    <div class="form-group">
        <label class="mb-3 lead">Invited (Multi-Select):</label>
        <!-- Multiselect dropdown -->
        <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm" name="invite_ids[]" class="selectpicker w-100">
            <?php foreach($users as $key => $user): ?>
            <option value="<?= $user["id"]?>">
                <?= $user["email"]?>
            </option>
            <?php endforeach; ?>
        </select><!-- End -->
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>