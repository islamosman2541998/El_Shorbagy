@foreach ($items->where('parent_id', $parent_id ?? 0) as $item)
    @php
        $itemUrl = LaravelLocalization::getLocalizedURL(
            app()->getLocale(),
            $item->type == 'dynamic' ? $item->dynamic_url : $item->url
        );

        $currentUrl = url()->current();

        $isActive = rtrim($currentUrl, '/') === rtrim($itemUrl, '/');

        $children = $items->where('parent_id', $item->id);
        $hasActiveChild = false;
        foreach ($children as $child) {
            $childUrl = LaravelLocalization::getLocalizedURL(app()->getLocale(), $child->type == 'dynamic' ? $child->dynamic_url : $child->url);
            if (rtrim($currentUrl, '/') === rtrim($childUrl, '/')) {
                $hasActiveChild = true;
                break;
            }
        }

        $activeClass = ($isActive || $hasActiveChild) ? 'active' : '';
        $totalChildren = $children->count();
    @endphp

    @if ($totalChildren)
        <li class="nav-item dropdown {{ $activeClass }}">
            <a class="nav-link dropdown-toggle" id="navbarDropdown{{ $item->id }}" role="button"
               data-bs-toggle="dropdown" aria-expanded="false" href="{{ $itemUrl }}">
                {{ $item->trans?->where('locale', $current_lang)->first()->title ?? 'No Title' }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $item->id }}">
                @include('site.layouts.menuItem', ['parent_id' => $item->id])
            </ul>
        </li>
    @else
        <a class="nav-item nav-link {{ $activeClass }}"
           href="{{ $itemUrl }}">
            {{ $item->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
        </a>
    @endif
@endforeach
