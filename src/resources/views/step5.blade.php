<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard - Create Administrator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #F7FAFC, #EDF2F7);
            color: #202124;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 16px;
        }
        .progress-dot {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .progress-dot-completed {
            background-color: #34A853;
            color: white;
        }
        .progress-dot-active {
            background-color: #4285F4;
            color: white;
        }
        .progress-dot-inactive {
            background-color: #E0E0E0;
            color: #9E9E9E;
        }
        .progress-bar-line {
            flex: 1;
            height: 4px;
            background-color: #E0E0E0;
            margin: 0 8px;
            transition: background-color 0.3s ease;
        }
        .progress-bar-line-active {
            background-color: #4285F4;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            padding: 32px;
            width: 100%;
            max-width: 640px;
            margin: 16px;
        }
        .google-input {
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 400;
            outline: none;
            background-color: white;
            transition: border-color 0.2s ease-in-out;
        }
        .google-input:focus {
            border-color: #4285F4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.3);
        }
        .button {
            background-color: #4285F4;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .button:hover {
            background-color: #3367D6;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .button:disabled {
            background-color: #E0E0E0;
            color: #9E9E9E;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="card bg-white rounded-xl shadow-lg w-full max-w-3xl sm:px-8 px-4 py-8 mx-3">
        <!-- Progress Bar -->
        <div class="progress-bar flex items-center justify-between mb-6">
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-check"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Welcome</span>
            </div>
            <div class="progress-bar-line progress-bar-line-active"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-list"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Requirements</span>
            </div>
            <div class="progress-bar-line progress-bar-line-active"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-database"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Database</span>
            </div>
            <div class="progress-bar-line progress-bar-line-active"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-active">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="text-sm font-medium text-blue-500 hidden sm:block mt-2">Admin</span>
            </div>
            <div class="progress-bar-line"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-inactive">
                    <i class="fas fa-check-circle"></i>
                </div>
                <span class="text-sm font-medium text-gray-500 hidden sm:block mt-2">Complete</span>
            </div>
        </div>
        @if ($errors->has('access_error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>{{ $errors->first('access_error') }}</strong>
        </div>
    @endif

        <!-- Content -->
        <h1 class="text-3xl font-bold mb-6 text-center">Create Admin Account</h1>
        <p class="text-gray-700 mb-6 text-center">
            Enter the details for the admin account to complete the setup process.
        </p>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('installer.saveAdmin') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="google-input mt-1 block w-full" placeholder="John" required>
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="google-input mt-1 block w-full" placeholder="Doe" required>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="google-input mt-1 block w-full" placeholder="admin" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" class="google-input mt-1 block w-full" placeholder="admin@example.com" required>
                </div>
                <div>
                    <label for="password" class="google-label">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="google-input pr-10 mt-1 block w-full" placeholder="••••••••" required>
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-400" onclick="togglePasswordVisibility('password')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="google-label">Confirm Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="google-input pr-10 mt-1 block w-full" placeholder="••••••••" required>
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-400" onclick="togglePasswordVisibility('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <script>
                    function togglePasswordVisibility(fieldId) {
                        const field = document.getElementById(fieldId);
                        const icon = field.nextElementSibling.firstChild;
                        if (field.type === 'password') {
                            field.type = 'text';
                            icon.classList.replace('fa-eye', 'fa-eye-slash');
                        } else {
                            field.type = 'password';
                            icon.classList.replace('fa-eye-slash', 'fa-eye');
                        }
                    }
                </script>
            </div>
            <div class="flex flex-col sm:flex-row sm:justify-between items-center mt-6">
                <a href="{{ route('installer.step4') }}" class="button bg-gray-200 text-gray-800 mb-4 sm:mb-0">
                    <i class="fas fa-arrow-left mr-2"></i> Go Back
                </a>
                <button type="submit" class="button hover:shadow-lg transition">
                    Create Admin
                </button>
            </div>
        </form>

    </div>

</body>
</html>
