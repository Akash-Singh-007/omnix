<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content bg-dark text-light">
      <div class="modal-header bg-info text-dark">
        <h5 class="modal-title" id="signupModalLabel">Signup to Omnix</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="partials/_handleSignup.php" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signupEmail1" aria-describedby="emailHelp" name="signupEmail">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div><div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" minlength="8" maxlength="15" id="signupUser1" aria-describedby="emailHelp" name="signupName">
            <div id="unameHelp" class="form-text">Must be started with a character.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" minlength="8" id="signupPassword1" name="signupPassword">
            <div id="unameHelp" class="form-text">Minimum 8 characters required.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="signupPassword2" name="signupCpassword">
            <div id="passHelp" class="form-text">Please re-enter the same password.</div>
          </div>
          <button type="submit" class="btn btn-info">SignUp</button>
        </form>
      </div>
    </div>
  </div>
</div>