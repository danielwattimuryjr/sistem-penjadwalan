<x-auth-layout>
    <div class="col-md-8 left-section">
        <h2 class="text-center pt-3">Sign Up</h2>
        <hr>
        <form id="signupForm" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="member_fullName">Nama Lengkap</label>
                        <input type="text" class="form-control" id="member_fullName" name="name"
                            placeholder="input nama lengkap" value="{{ old('name') }}">
                        @error('name')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="member_phone">No. Telepon</label>
                        <input type="text" class="form-control" id="member_phone" name="nomor_telepon"
                            placeholder="input nomor telepon" value="{{ old('nomor_telepon') }}">
                        @error('nomor_telepon')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
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
                <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="member_ktp">KTP</label>
                                <input type="text" class="form-control" id="member_ktp" name="member_ktp" placeholder="input nomor KTP" required>
                            </div>
                        </div> -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div style="margin-top:12px;" class="wrapradio">
                            <label class="radio-inline">
                                <input type="radio" name="jenis_kelamin" class="radio" value="male" {{
                                    old('jenis_kelamin')=='male' ? 'checked' : '' }}
                                    style="margin-top: 0;display: block;"> Laki-Laki
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="jenis_kelamin" value="female" {{
                                    old('jenis_kelamin')=='female' ? 'checked' : '' }}
                                    style="margin-top: 0;display: block;"> Perempuan
                            </label>
                        </div>
                        @error('jenis_kelamin')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="member_birthdate">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="member_birthdate" name="tanggal_lahir"
                            placeholder="input tanggal lahir" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="member_address">Alamat Lengkap</label>
                                <textarea class="form-control" id="member_address" name="member_address" rows="3" required placeholder="input alamat"></textarea>
                            </div>
                        </div>
                    </div> -->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="member_password">Password</label>
                        <input type="password" class="form-control" id="member_password" name="password"
                            placeholder="Input password">
                        @error('password')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="member_confirmPassword">Ulangi Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="password_confirmation"
                            placeholder="Ulangi password">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block" id="submit">DAFTAR SEKARANG!</button>
        </form>
        <p style="margin-top:20px;">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
</x-auth-layout>