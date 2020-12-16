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

	.dropdown-menu {
		padding: 0;
	}

	.dropdown:hover .dropdown-menu{
		display: block
	}

	.dropdown-item {
		margin: 0;
		padding: 10px;
	}

	body {
		padding-top: 4.8rem;
	}
</style>

<nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="{{ route('main') }}">
		{{-- <img src="/storage/common/logo.png" alt="Logo" style="width:50px;""> --}}
		<i style="font-size: 3rem" class="fas fa-laugh-wink"></i>
    </a>
    <!-- Links -->
    <a class="px-0 mx-0 mx-lg-2 px-lg-2nav-link text-dark" href="{{ route('main') }}"
        style="font-size: 1.5rem;" >
        Tokobaju.com
    </a>
    <ul class="navbar-nav navbar-collapse d-none d-xl-block" id="to-collapse">
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('main') }}">Store</a>
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
				<a class="dropdown-item" href="{{ route('user/cart') }}">Shopping Cart</a>
				<a class="dropdown-item" href="{{ route('auth/logout') }}">Logout</a>
            @else
				<a class="dropdown-item" href="{{ route('auth/login') }}">Login</a>
                <a class="dropdown-item" href="{{ route('auth/register') }}">Register</a>
            @endif
        </div>
    </div>
</nav>

<script>
	

</script>
