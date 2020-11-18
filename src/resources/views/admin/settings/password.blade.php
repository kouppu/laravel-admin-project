@extends('adminlte::page')

@section('title', config('adminlte.title', '管理画面') . ' | パスワードリセット')

@section('content_header')
    <h1>パスワード設定</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">パスワード設定フォーム</h3>
    </div>

    @include('admin.common.error')

    <form action={{ route('admin.settings.password.update')}} method="POST">
      {{ csrf_field() }}
      <div class="card-body">

        <div class="form-group">
          <label>パスワード</label>
          <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
          <label>パスワード（確認）</label>
          <input type="password" name="password_confirmation" class="form-control">
        </div>

      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary" id="tweetSubmitBtn">変更</button>
      </div>

    </form>

  </div>

  @include('admin.common.success')
@stop
