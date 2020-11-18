@extends('adminlte::page')

@section('title', config('adminlte.title', '管理画面') . ' | アカウント設定')

@section('content_header')
    <h1>アカウント設定</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">アカウント設定フォーム</h3>
    </div>

    @include('admin.common.error')

    <form action={{ route('admin.settings.account.update')}} method="POST">
      {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label>アカウント名</label>
          <input type="text" class="form-control" name="name" value={{ old('name', $account->name) }}>
        </div>

        <div class="form-group">
          <label>メールアドレス</label>
          <input type="email" class="form-control" name="email" value={{ old('email', $account->email) }}>
        </div>
      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary" id="tweetSubmitBtn">変更</button>
      </div>
    </form>
  </div>

  @include('admin.common.success')
@stop
