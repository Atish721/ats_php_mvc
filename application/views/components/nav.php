<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="<?=BASEURL?>">Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=BASEURL?>home">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if (!$this->getSession('userId')) { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?=BASEURL?>home">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=BASEURL?>login">Login</a>
        </li>
      <?php } ?>
    </ul>
    <?php if ($this->getSession('userId')) { ?>
      <ul class="my-2 my-lg-0"><a href="<?=BASEURL?>profile/logout" class="btn btn-danger">Logout</a></ul>
    <?php } ?>
  </div>
</nav>
<!-- Close navbar -->