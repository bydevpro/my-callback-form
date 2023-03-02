<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      
      <nav id="scanfcode" class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      
      <a id="logo" class="navbar-brand" href="#">Здравствуй, {{ Auth::user()->getName() }}</a>
    </div>
    
 
      <ul id="link" class="nav navbar-nav navbar-right">
         
        <li><a class="btn btn-outline-success my-2 my-sm-0" href="{{'/logout'}}">Выход</a></li>
      </ul>
    
  </div>
</nav>