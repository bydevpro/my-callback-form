@auth
  <a href="/logout">Logout</a>
@else
  <a href="/login">Login</a>
@endauth
<?php echo "Hello manager"; ?>