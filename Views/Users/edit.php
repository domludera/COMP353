<h1 class="h3 mb-2 text-gray-800">Edit My Profile</h1>
<hr>
<form action="/users/update" method="post"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="email" required="">Email address:</label> <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>"/>
    </div>
    <div class="form-group">
        <label for="pwd" required="">Password:</label> <input type="password" class="form-control" id="password" name="password" value="<?= $user['password'] ?>" />
    </div>
    <div class="form-group">
        <label for="name" required="">Name:</label> <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>"/>
    </div>
    <div class="form-group">
        <label for="dob" required="">Date of Birth:</label> <input type="date" class="form-control" id="dob" name="dob" value="<?= $user['dob'] ?>"/>
    </div>
    <div class="form-group">
        <label for="profession" required="">Profession:</label> <input type="text" class="form-control" id="profession" name="profession" value="<?= $user['profession'] ?>" />
    </div>
    <div class="form-group">
        <label for="region" required="">Region:</label> <input type="text" class="form-control" id="region" name="region" value="<?= $user['region'] ?>"/>
    </div>    
    <hr>
    <div class="form-group">
        <label for="profile_image">Select a profile image to upload:</label>
        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
