<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Library</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if(Auth::user())
                    <li><a href="dashboard">Dashboard</a></li>
                    <li><a href="users">Users</a></li>
                    <li><a href="books">Books</a></li>
                @else
                    <li><a href="home">Home</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
                    <li><a href="#">Hello, {{ Auth::user()->first_name }}!</a></li>
                    <li><a href="logout">Logout</a></li>
                @else
                    <li><a href="register">Register</a></li>
                    <li><a href="login">Login</a></li>
                    <li><a href="login/facebook">Login with Facebook</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>