@props(['route', 'lable', 'method'])

@empty($method)
    <li @class(['nav-item', 'active' => request()->routeIs($route)])>
        <a class="nav-link" href="{{ route($route) }}">{{ $lable }}</a>
    </li>
@else
    <li @class(['nav-item'])>
        <form class="form-inline" method="post" action="{{ route($route) }}">
            @csrf
            @method($method)
            <a class="nav-link" onclick="this.parentElement.submit()" style="cursor: pointer">{{ $lable }}</a>
        </form>
    </li>
@endempty
