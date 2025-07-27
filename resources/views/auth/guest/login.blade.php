<x-auth-layout>
    <div class="col-md-8 left-section">
        <h2 class="text-center pt-3">Login</h2>
        <hr>
        <form id="signupForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="alert alert-dismissible" role="alert" id="alertMessage" style="display: none;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong id="alertText"></strong>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="member_email">Email</label>
                        <input type="email" class="form-control" id="member_email" name="email"
                            placeholder="input email" value="{{ old('email') }}">
                        @error('email')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="member_password">Password</label>
                        <input type="password" class="form-control" id="member_password" name="password"
                            placeholder="password">
                        @error('password')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block" id="submit">Login</button>
        </form>
        <p style="margin-top:20px;">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang!</a></p>
    </div>
</x-auth-layout>