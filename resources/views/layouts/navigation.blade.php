@can('view-any-effect')
    <li class="nav-item">
    <a class="nav-link @if(Route::currentRouteName()==='effects.index') active @endif" href="{{ route('effects.index') }}">{{ __('Effects') }}</a>
    </li>
@endcan
@can('view-any-food')
    <li class="nav-item">
    <a class="nav-link @if(Route::currentRouteName()==='foods.index') active @endif" href="{{ route('foods.index') }}">{{ __('Foods') }}</a>
    </li>
@endcan
@can('view-any-nutrient')
    <li class="nav-item">
    <a class="nav-link @if(Route::currentRouteName()==='nutrients.index') active @endif" href="{{ route('nutrients.index') }}">{{ __('Nutrients') }}</a>
    </li>
@endcan
@can('view-any-nutrient-limit')
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName()==='nutrient_limits.index') active @endif" href="{{ route('nutrient_limits.index') }}">{{ __('Nutrient Limits') }}</a>
    </li>
@endcan
@can('view-any-nutrient-rda')
    <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName()==='nutrient_rdas.index') active @endif" href="{{ route('nutrient_rdas.index') }}">{{ __('Nutrient Rdas') }}</a>
    </li>
@endcan
