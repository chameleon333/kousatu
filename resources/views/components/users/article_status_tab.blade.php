@if (isset(auth()->user()->id))
  @if ((auth()->user()->id) == $user->id)
    <div class="col-md-4">
      <select class="form-control" name="select" onChange="location.href=value;">
        @foreach ($article_status_list as $status_id => $status_text)
          <option @if($request_status_id == $status_id) selected @endif value="{{ url()->current() }}?status={{ $status_id }}">{{ $status_text }}</option>
        @endforeach
      </select>
    </div>
  @endif
@endif