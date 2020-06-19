
@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="row col-md-12">
      <div class="col-md-9 mb-3 order-md-2">
        @include('components.tab_list')
        <article-list-component api="{{ $api }}"></article-list-component>
      </div>
      @include('components.side_navi')
    </div>
  </div>
</div>
@endsection