@php
    $current_route=request()->route()->getName();

    $categoryActive = in_array($current_route, ['categoryRead']) ? 'active' : '';
    $eventappointActive = in_array($current_route, ['eventappointRead']) ? 'active' : '';
    $fitappointActive = in_array($current_route, ['fitnessappointRead']) ? 'active' : '';
    $borrowActive = in_array($current_route, ['borrowRead']) ? 'active' : '';
    $logbookActive = in_array($current_route, ['logselectdateShow']) ? 'active' : '';
    $userGuideActive = in_array($current_route, ['userGuide']) ? 'active' : '';
@endphp

<aside class="sidebarcustom">
    <header class="sidebarcustom-header">
        <button class="toggler menu-toggler">
            <span class="material-symbols-rounded">Menu</span>
        </button>
    </header>

    <nav class="sidebarcustom-nav">
        <ul class="nav-list primary-nav">
            <li class="nav-item">
                <a href="#" class="nav-link text-gray disabled">
                    <span class="nav-label">Main Navigation </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dash') }}" class="nav-link {{$current_route=='dash'?'active':''}}">
                    <span class="nav-icon material-symbols-rounded">dashboard</span>
                    <span class="nav-label">Dashboard</span>
                </a>
                <span class="nav-tooltip">Dashboard</span>
            </li>

            <li class="nav-item">
                <a href="{{ route('categoryRead') }}" class="nav-link {{ $categoryActive }}">
                    <span class="nav-icon material-symbols-rounded">Inventory</span>
                    <span class="nav-label">Inventory</span>
                </a>
                <span class="nav-tooltip">Inventory</span>
            </li>

            <li class="nav-item">
                <a href="{{ route('eventappointRead') }}" class="nav-link {{ $eventappointActive }}">
                    <span class="nav-icon material-symbols-rounded">calendar_today</span>
                    <span class="nav-label">Events</span>
                </a>
                <span class="nav-tooltip">Events</span>
            </li>
            <li class="nav-item">
                <a href="{{ route('fitnessappointRead') }}" class="nav-link {{ $fitappointActive }}">
                    <span class="nav-icon material-symbols-rounded">exercise</span>
                    <span class="nav-label">Fitness Lab</span>
                </a>
                <span class="nav-tooltip">Fitness Lab</span>
            </li>

            <li class="nav-item">
                <a href="{{ route('borrowRead') }}" class="nav-link {{ $borrowActive }}">
                    <span class="nav-icon material-symbols-rounded">style</span>
                    <span class="nav-label">Borrow</span>
                </a>
                <span class="nav-tooltip">Borrow</span>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-gray disabled">
                    <span class="nav-label">Reports </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logselectdateShow') }}" class="nav-link {{ $logbookActive }}">
                    <span class="nav-icon material-symbols-rounded">insert_chart</span>
                    <span class="nav-label">Logbook</span>
                </a>
                <span class="nav-tooltip">Logbook</span>
            </li>
        </ul>

        <ul class="nav-list secondary-nav">
            <li class="nav-item">
                <a href="{{ route('userGuide') }}" class="nav-link {{ $userGuideActive }}" id="user-guide-btn">
                    <span class="nav-icon material-symbols-rounded">help_outline</span>
                    <span class="nav-label">User Guide</span>
                </a>
                <span class="nav-tooltip">User Guide</span>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <span class="nav-icon material-symbols-rounded">logout</span>
                    <span class="nav-label">Logout</span>
                </a>
                <span class="nav-tooltip">Logout</span>
            </li>
        </ul>
    </nav>
</aside>