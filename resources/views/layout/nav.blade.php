<style>
    ul .nav-link:hover {
        font-weight: bold;
        color: orange !important;
        font-size: 22px;
    }

    ul .nav-link {
        margin-right: 5px;
        font-size: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    li:first-child.nav-item {
        margin-left: 5px;
    }

    .btn {
        margin: 5px;
    }

    .dropdown-item:hover {
        background-color: orange;
    }

</style>

<nav class="navbar navbar-expand-sm bg-white navbar-dark pb-3">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="{{ route('/') }}">
        <img src="storage/common/logo.png" alt="logo" style="width:80px;height: 50px">
    </a>
    <!-- Links -->
    <a class="nav-link text-dark" href="{{ route('/') }}"
        style="font-size: 30px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
        MATTHEW STORE
    </a>
    <ul class="navbar-nav navbar-collapse mt-2">
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('/') }}">Store</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#">News & Promo</a>
        </li>
    </ul>
    <div class="dropdown mx-1">
        <button class="btn btn-secondary dropdown-toggle bg-white text-dark" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" id="listMenu">
			@if (Auth::check())
				<a class="dropdown-item" href="{{ route('user/profile') }}">Profile</a>
		<a class="dropdown-item" href="{{ /*route('user/cart')*/"" }}">Shopping Cart</a>
            @else
				<a class="dropdown-item" href="{{ route('auth/login') }}">Login</a>
                <a class="dropdown-item" href="{{ route('auth/register') }}">Register</a>
            @endif
        </div>
    </div>

    <div class="dropdown mr-5">
        <button class="btn btn-secondary dropdown-toggle bg-white text-dark" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-search"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-item form-inline">
                <input class="form-control" type="text" placeholder="Search.." name="search">
                <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</nav>
