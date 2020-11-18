@if (session('success'))
  <div class="alert" role="alert" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
    {{ session('success') }}
  </div>
@endif
