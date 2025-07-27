<x-admin-auth-layout>
    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
        <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('admin.login') }}">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email"
                            value="{{ old('email') }}" aria-label="Email" aria-describedby="email-addon">
                        @error('email')
                        <div class="text-danger form-text">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                            name="password" aria-describedby="password-addon" value="{{ old('password') }}">
                        @error('password')
                        <div class="text-danger form-text">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                            in</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                &nbsp;
            </div>
        </div>
    </div>
</x-admin-auth-layout>