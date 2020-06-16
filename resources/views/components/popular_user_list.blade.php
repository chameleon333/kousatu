<div class="card mb-3">
    <div class="card-header user-mark">人気のユーザー</div>
    <div class="card-body">
    @foreach ($popular_users as $user)
        <a href="{{ route('users.show', ['user'=>$user->id]) }}">
            <p>{{$user->name}}</p>
        </a>
    @endforeach
    </div>
</div>