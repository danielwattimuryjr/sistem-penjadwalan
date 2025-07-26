@props(['href' => '#', 'active' => false, 'icon' => '', 'label' => ''])

<li class="nav-item">
  <a class="nav-link {{ $active ? 'active' : '' }}" href="{{ $href }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center text-dark me-2 d-flex align-items-center justify-content-center">
      <i class="{{ $icon }}{{ $active ? '' : ' text-dark' }}"></i>
    </div>
    <span class="nav-link-text ms-1">{{ $label }}</span>
  </a>
</li>