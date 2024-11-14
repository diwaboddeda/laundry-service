<div class="d-sm-block d-md-none">
    <nav>
        <a href="/dashboard" class="nav-link">Dashboard</a>
        @can('admin')
            <a href="/employees" class="nav-link">Employees</a>
        @endcan
        <a href="/services" class="nav-link">Services</a>
        <a href="/transactions" class="nav-link">Transactions</a>
        <a href="/progress" class="nav-link">Progress</a>
        
        <hr>

        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>
