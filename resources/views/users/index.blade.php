@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        @if(request()->path() == 'users') 
          @include('components.user_list')
        @else
          <div class="card">
            @include('components.user_profile')
            @include('components.user_tab_list')
            <div class="p-3">
              @include('components.user_list')
            </div>
          </div>
        @endif
      </div>
    </div>
</div>
@endsection