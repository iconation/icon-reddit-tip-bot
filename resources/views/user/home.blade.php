<h3>Welcome: {{Auth::user()->username}}</h3>
<a href="{{route('user.logout')}}">Logout</a>