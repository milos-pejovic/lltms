<html>
<head>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</head>
<body>
    <form class="google-event-register-form" action="/register-event" method="POST">
    
        {{csrf_field()}}

        <label>
            Name: 
            <input class="input-field" type="text" name="name" value="{{ old('name') }}"/>
        </label>
        <br />

        <label>
            Phone: 
            <input class="input-field" type="text" name="phone" value="{{ old('phone') }}"/>
        </label>
        <br />

        <label>
            E-mail: 
            <input class="input-field" type="email" name="email" value="{{ old('email') }}"/>
        </label>
        <br />

        <label>
            Time: 
            <input class="input-field" type="text" name="time" value="{{ old('time') }}"/>
        </label>
        <br />

        <label>
            Date: 
            <input class="input-field" type="text" name="date" value="{{ old('date') }}"/>
        </label>
        <br />

        <label>
            Note:
            <textarea class="input-field" name="note"></textarea>
        </label>
        <br />

        <input type="submit" value="Send" />
    </form>


    @if(count($errors) > 0)
    <h1>Errors</h1>
    <ul class="errors">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <script src="{{ URL::to('js/main.js') }}"></script>
</body>
</html>
