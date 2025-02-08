<form method="POST" action="{{ route('register.post') }}">
    @csrf
    <!-- Name, Email, Password, and Password Confirmation fields -->
    <button type="submit">Register</button>
</form>
