<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard - Complete</title>
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
        .progress-bar-line {
            flex: 1;
            height: 4px;
            background-color: #34A853;
            margin: 0 8px;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            padding: 32px;
            width: 100%;
            max-width: 640px;
            margin: 16px;
            text-align: center;
        }
        .button {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .button-primary {
            background-color: #34A853;
            color: white;
        }
        .button-primary:hover {
            background-color: #2c8b42;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .button-secondary {
            background-color: #F4F4F4;
            color: #202124;
        }
        .button-secondary:hover {
            background-color: #E0E0E0;
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
            <div class="progress-bar-line"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-list"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Requirements</span>
            </div>
            <div class="progress-bar-line"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-database"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Database</span>
            </div>
            <div class="progress-bar-line"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Admin</span>
            </div>
            <div class="progress-bar-line"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Complete</span>
            </div>
        </div>
        @if ($errors->has('access_error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>{{ $errors->first('access_error') }}</strong>
        </div>
    @endif

        <!-- Content -->
        <h1 class="text-3xl font-bold mb-6 text-center">Installation Complete!</h1>
        <p class="text-gray-700 mb-6 text-center">
            Congratulations! Your application has been successfully installed. You can now log in to your admin dashboard and start using the application.
        </p>
        <p class="text-gray-700 mb-6 text-center">
            For security purposes, we strongly recommend removing the <strong>installer</strong> folder from your server.
        </p>
        <div class="flex flex-col sm:flex-row sm:justify-center gap-4 mt-6">
            <a href="{{ url('/') }}" class="button button-primary">
                Go to Application &rarr;
            </a>
            <a href="{{ url('/admin') }}" class="button button-secondary">
                Go to Admin Dashboard &rarr;
            </a>
        </div>
    </div>
</body>
</html>
