@if (count($errors) > 0)
<div class="alert" style="color:#a94442; background-color:#f2dede; border-color:#ebccd1;" role="alert">
  <ul>
    @foreach($errors->all() as $error)
      <li class="danger">{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
