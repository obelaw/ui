@foreach ($links as $link)
    @if (isset($link['href']) && hasPermission($link['permission']))
        <li class="nav-item">
            <a class="nav-link" href="{{ route($link['href']) }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    @if (isset($link['icon']))
                        <img src="{{ asset($link['icon']) }}" alt="" class="w-4 me-1">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-face-id" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                            <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                            <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M9 10l.01 0"></path>
                            <path d="M15 10l.01 0"></path>
                            <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                        </svg>
                    @endif
                </span>
                <span class="nav-link-title">
                    {{ \Illuminate\Support\Str::contains($link['label'], '::navbar') ? __($link['label']) : $link['label'] }}
                </span>
            </a>
        </li>
    @endif

    @if (isset($link['sublinks']) && hasPermission($link['permission']))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                data-bs-auto-close="outside" role="button" aria-expanded="false">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    @if (isset($link['icon']))
                        <img src="{{ asset($link['icon']) }}" alt="" class="w-4 me-1">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                            <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                            <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M9 10l.01 0"></path>
                            <path d="M15 10l.01 0"></path>
                            <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                        </svg>
                    @endif
                </span>
                <span class="nav-link-title">
                    {{ \Illuminate\Support\Str::contains($link['label'], '::navbar') ? __($link['label']) : $link['label'] }}
                </span>
            </a>
            <div class="dropdown-menu">
                @foreach ($link['sublinks'] as $_link)
                    @if (!isset($_link['thirdlinks']))
                        @if (hasPermission($_link['permission']))
                            <a class="dropdown-item" href="{{ route($_link['href']) }}">
                                @if (isset($_link['icon']))
                                    <img src="{{ asset($_link['icon']) }}" alt="" class="w-4 me-1">
                                @endif
                                {{ \Illuminate\Support\Str::contains($_link['label'], '::navbar') ? __($_link['label']) : $_link['label'] }}
                            </a>
                        @endif
                    @else
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-error" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                @if (isset($_link['icon']))
                                    <img src="{{ asset($_link['icon']) }}" alt="" class="w-4 me-1">
                                @endif
                                {{ \Illuminate\Support\Str::contains($_link['label'], '::navbar') ? __($_link['label']) : $_link['label'] }}
                            </a>
                            <div class="dropdown-menu">
                                @foreach ($_link['thirdlinks'] as $__link)
                                    <a href="{{ route($__link['href']) }}" class="dropdown-item">
                                        @if (isset($__link['icon']))
                                            <img src="{{ asset($__link['icon']) }}" alt="" class="w-4 me-1">
                                        @endif
                                        {{ \Illuminate\Support\Str::contains($__link['label'], '::navbar') ? __($__link['label']) : $__link['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </li>
    @endif
@endforeach
