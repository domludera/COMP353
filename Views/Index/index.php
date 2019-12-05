<h1>Welcome to the Share, Contribute & Comment System</h1>
<div>
  <p>Created by: Erik Smith, Dominik Ludera, Zachary , Hugo Joncour & Priscilla Cournoyer</p>
  <p>Comp 353 Project</p>
</div>
<div class="row">
  <!--Register-->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <ul class="nav-item active">
              <h2>Register</h2>
              <form action="/auth/register" method="post">
                <div class="form-group">
                  <label for="email" required="">Email address:</label> <input type="email" class="form-control" id="email" name="email" />
                </div>
                <div class="form-group">
                  <label for="pwd" required="">Password:</label> <input type="password" class="form-control" id="password" name="password" />
                </div>
				<div class="form-group">
                  <label for="pwd" required="">Name:</label> <input type="text" class="form-control" id="name" name="name" />
                </div>
                <div class="form-group">
                  <label for="pwd" required="">Date of Birth:</label> <input type="date" class="form-control" id="dob" name="dob" />
                </div>
                <div class="form-group">
                  <label for="pwd" required="">Profession:</label> <input type="text" class="form-control" id="profession" name="profession" />
                </div>
                <div class="form-group">
                  <label for="pwd" required="">Region:</label> <input type="text" class="form-control" id="region" name="region" />
                </div><button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--Login-->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <ul class="nav-item active">
              <h2>Login</h2>
              <form action="/auth/login" method="post">
                <div class="form-group">
                  <label for="email" required="">Email address:</label> <input type="email" class="form-control" id="email" name="email" />
                </div>
                <div class="form-group">
                  <label for="pwd" required="">Password:</label> <input type="password" class="form-control" id="password" name="password" />
                </div><button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
