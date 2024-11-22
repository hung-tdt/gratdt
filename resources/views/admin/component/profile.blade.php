
<div class="dropdown profile-element"> <span>
  <img style="height: 40px" alt="image" class="img-circle" src="{{$admin->thumb}}" />
   </span>
  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $admin->name }}</strong>
    </span> <span class="text-muted text-xs block">{{ $admin->username }} <b class="caret"></b></span> </span> </a>
  <ul class="dropdown-menu animated fadeInRight m-t-xs">
    <li><a href="{{ route('admins.profile', ['id' => $admin->id])}}">Profile</a></li>
    <li class="divider"></li>
    <li><a href="{{ route('auths.logout')}}">Logout</a></li>
  </ul>
</div>
