<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Collection Builder
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a <? if ($active['home']) { ?> class="nav-item nav-link active" <? }  else { ?> class="nav-item nav-link" <? } ?> href="<?= base_url(); ?>index.php?/Home">Home <span class="sr-only">(current)</span></a>
      <a <? if ($active['collection']) { ?> class="nav-item nav-link active" <? }  else { ?> class="nav-item nav-link" <? } ?> class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Collections">My Collections</a>
      <a <? if ($active['set']) { ?> class="nav-item nav-link active" <? }  else { ?> class="nav-item nav-link" <? } ?>class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Sets">My Sets</a>
      <? if ($loggedin) {?>
        <a class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Login/Logout">LogOut</a>
      <? } else {?>
        <a <? if ($active['login']) { ?> class="nav-item nav-link active" <? }  else { ?> class="nav-item nav-link" <? } ?>class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Login">LogIn</a>
        <a <? if ($active['login']) { ?> class="nav-item nav-link active" <? }  else { ?> class="nav-item nav-link" <? } ?>class="nav-item nav-link" href="<?= base_url(); ?>index.php?/SignUp">Sign Up</a>
      <? } ?>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Collection Builder
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Home">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Collections">My Collections</a>
      <a class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Sets">My Sets</a>
      <? if ($loggedin) {?>
        <a class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Login/Logout">LogOut</a>
      <? } else {?>
        <a class="nav-item nav-link" href="<?= base_url(); ?>index.php?/Login">LogIn</a>
        <a class="nav-item nav-link" href="<?= base_url(); ?>index.php?/SignUp">Sign Up</a>
      <? } ?>
    </div>
  </div>
</nav>