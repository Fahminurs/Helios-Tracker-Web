<!-- <x-app-layout>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        .profile-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            padding: 16px;
            background-color: #f8f9fa;
        }

        .profile-content {
            background-color: #ffffff;
            min-height: calc(100vh - 32px);
            padding: 24px;
            margin-left: 280px;
            border-radius: 16px;
            width: calc(100% - 280px);
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            background: linear-gradient(145deg, #5e72e4 0%, #825ee4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 24px;
            box-shadow: 0 12px 24px rgba(94, 114, 228, 0.2);
        }

        .profile-avatar svg {
            width: 40px;
            height: 40px;
            color: white;
        }

        .profile-info h1 {
            font-size: 24px;
            font-weight: 700;
            color: #344767;
            margin-bottom: 8px;
        }

        .profile-info p {
            color: #67748e;
            font-size: 14px;
        }

        .profile-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: #344767;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #5e72e4;
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
        }

        .save-button {
            background: linear-gradient(145deg, #5e72e4 0%, #825ee4 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(94, 114, 228, 0.2);
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #344767;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .security-section {
            margin-top: 48px;
        }

        .notification-settings {
            margin-top: 48px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e9ecef;
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #5e72e4;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
    </style>

    <div class="wrapper">
        @include('admin.sidebar')
        
        <div class="profile-content">
            <div class="profile-header">
                <div class="profile-avatar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="profile-info">
                    <h1>Update Profile</h1>
                    <p>Kelola informasi profil dan pengaturan akun Anda</p>
                </div>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="section-title">Informasi Pribadi</div>
                
                <div class="profile-form">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-input" name="name" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" name="email" value="{{ auth()->user()->email }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-input" name="phone" value="{{ auth()->user()->phone }}">
                    </div>
                </div>

                <button type="submit" class="save-button">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    <script>
        // Tambahkan animasi smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.ventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</x-app-layout>  -->