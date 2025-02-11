<h1>users werkt</h1>
<ul>
    @foreach($users as $user)

        <li>{{$user -> name}}</li>

    @endforeach
</ul>
