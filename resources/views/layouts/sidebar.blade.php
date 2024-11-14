<div class="list-group d-none d-sm-none d-md-block">
    <a href="/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
    @can('admin')
    <a href="/employees" class="list-group-item list-group-item-action">Employees</a>
    @endcan
    <a href="/services" class="list-group-item list-group-item-action">Services</a>
    <a href="/transactions" class="list-group-item list-group-item-action">Transactions</a>
    <a href="/progress" class="list-group-item list-group-item-action">Progress</a>
</div>
