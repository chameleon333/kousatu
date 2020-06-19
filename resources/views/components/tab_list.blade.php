<ul class="nav nav-tabs">

    @foreach($tab_info_list as $tab_text => $tab_info)
    <li class="nav-item">
        <a href="{{url()->current()}}{{$tab_info['param']}}" class="nav-link @if($tab_info['param'] == str_replace(url()->current(),'',request()->fullUrl()) ) active @endif">
            <i class="mr-1 {{$tab_info['icon_class']}}"></i>{{$tab_text}}
        </a>
    </li>
    @endforeach
</ul>