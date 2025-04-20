<aside id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="index.html">
      <span class="align-middle">EMS</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{ Auth::user()->role->slug === 'administrator' ? route('admin.dashboard') : route('home') }}">
          <i class="align-middle" data-feather="sliders"></i>
          <span class="align-middle">{{ __('Dashboard') }}</span>
        </a>
      </li>

      @if (Auth::check() && Auth::user()->role->slug === 'administrator')
        <li class="sidebar-header">{{ __('Users Management') }}</li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('user.index') }}">
            <i class="fas fa-user align-middle"></i>
            <span class="align-middle">{{ __('Manage Users') }}</span>
          </a>
        </li>
      @endif
      
      <li class="sidebar-header">{{ __('Employee Management') }}</li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{ Auth::user()->role->slug === 'administrator' ? route('employee.index') : route('home') }}">
          <i class="fa-solid fa-users-viewfinder"></i>
          <span class="align-middle">{{ __('Manage Employees') }}</span>
        </a>
      </li>

      @if (Auth::check() && Auth::user()->role->slug === 'administrator')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('department.index') }}">
            <i class="fa-solid fa-users-gear"></i>
            <span class="align-middle">{{ __('Manage Departments') }}</span>
          </a>
        </li>
      @endif

      @if (Auth::check() && Auth::user()->role->slug === 'administrator')
        <li class="sidebar-header">{{ __('Task Management') }}</li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('tasks.index') }}">
            <i class="fa-solid fa-tasks"></i>
            <span class="align-middle">{{ __('Manage Tasks') }}</span>
          </a>
        </li>
      @endif
    </ul>
  </div>
</aside>