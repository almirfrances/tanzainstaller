
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard - Welcome</title>
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
        .progress-dot-active {
            background-color: #4285F4;
            color: white;
        }
        .progress-dot-completed {
            background-color: #34A853;
            color: white;
        }
        .progress-dot-inactive {
            background-color: #E0E0E0;
            color: #9E9E9E;
        }
        .progress-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
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
          <!-- Progress Bar -->
          <div class="progress-bar">
            <!-- Step 1 -->
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-completed">
                    <i class="fas fa-info-circle"></i>
                </div>
                <span class="text-sm font-medium text-green-600 hidden sm:block mt-2">Welcome</span>
            </div>
            <div class="progress-bar-line progress-bar-line-active"></div>
            <!-- Step 2 -->
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-inactive">
                    <i class="fas fa-list"></i>
                </div>
                <span class="text-sm font-medium text-gray-500 hidden sm:block mt-2">Requirements</span>
            </div>
            <div class="progress-bar-line"></div>
            <!-- Step 3 -->
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-inactive">
                    <i class="fas fa-database"></i>
                </div>
                <span class="text-sm font-medium text-gray-500 hidden sm:block mt-2">Database</span>
            </div>
            <div class="progress-bar-line"></div>
            <!-- Step 4 -->
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-inactive">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="text-sm font-medium text-gray-500 hidden sm:block mt-2">Admin</span>
            </div>
            <div class="progress-bar-line"></div>
            <!-- Step 5 -->
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
        <h1 class="text-3xl font-bold mb-6 text-center">Welcome to the Installation Wizard</h1>
        <p class="text-gray-700 mb-6 text-center">
            Thank you for choosing our software! This installation wizard will guide you through the setup process step by step.
        </p>
        <ul class="list-disc pl-8 text-gray-700 space-y-2 mb-8">
            <li>Ensure PHP 8.2 or higher is installed on your server.</li>
            <li>Have database credentials (host, username, password) ready.</li>
            <li>Set writable permissions for required directories (<code>/storage</code>, <code>/bootstrap/cache</code>).</li>
            <li>Familiarize yourself with your server environment.</li>
        </ul>
        <div class="flex justify-center">
            <a href="{{ route('installer.step2') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg font-medium text-lg shadow hover:bg-blue-600 transition">
                Start Installation
            </a>
        </div>
    </div>
</body>
</html>
