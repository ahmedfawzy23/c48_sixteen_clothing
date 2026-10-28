@props(['route', 'lable'])

<li @class(['nav-item', 'active' => request()->routeIs($route)])>
    <a class="nav-link" href="{{ route($route) }}">{{ $lable }}</a>
</li>
