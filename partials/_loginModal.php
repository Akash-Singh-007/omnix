<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header bg-info text-dark">
        <h5 class="modal-title" id="loginModalLabel">Login to Omnix</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="partials/_handleLogin.php" method="post">
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Username or email</label>
            <input type="loginEmail" name="loginEmail" class="form-control" id="loginEmail" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email or username with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="loginPass" class="form-label">Password</label>
            <input type="password" name="loginPass" class="form-control" id="loginPass" required>
          </div>
          <button type="submit" class="btn btn-info">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>