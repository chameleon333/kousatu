@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          @include('components.users.user_profile')
          @include('components.users.user_tab_list')
          <div class="p-3">
            @include('components.users.user_list')
          </div>
        </div>
      </div>
    </div>
</div>
@endsection