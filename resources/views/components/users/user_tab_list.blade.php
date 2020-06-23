<ul class="nav nav-tabs px-3 mb-3">
    @foreach($tab_info_list as $tab_text => $tab_info)
    <li class="nav-item">        
        <a href="{{ $tab_info['link'] }}" class="nav-link text-secondary @if($tab_info['link'] == '/'.request()->path() ) active @endif">
            {{$tab_text}}
        </a>
    </li>
    @endforeach
</ul>