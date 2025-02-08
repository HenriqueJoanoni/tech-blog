<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <!-- Email and Password fields -->
    <input type="text" name="email">
    <input type="password" name="password" id="">
    <button type="submit">Login</button>
</form>
