<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard - Database Installation</title>
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
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            padding: 32px;
            width: 100%;
            max-width: 640px;
            margin: 0 auto;
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
        .loader {
            border: 4px solid #F3F4F6;
            border-top: 4px solid #4285F4;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 8px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .note {
            background: #fef3c7;
            color: #b45309;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1 class="text-3xl font-bold mb-6 text-center">Database Installation</h1>
        <p class="text-gray-700 mb-6 text-center">
            @if ($errors->any())
                <span class="text-red-500 font-semibold">Issues Detected:</span>
                <ul class="text-red-500 mt-2 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                <span class="text-green-500 font-semibold">Database configuration successful! Ready to install.</span>
            @endif
        </p>
        @if ($errors->has('access_error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>{{ $errors->first('access_error') }}</strong>
    </div>
@endif

        <form id="installForm" action="{{ route('installer.installDatabase') }}" method="POST" class="mt-6">
            @csrf
            <div class="flex flex-col sm:flex-row sm:justify-between items-center">
                <a href="{{ route('installer.step3') }}" class="button bg-gray-200 text-gray-800 mb-4 sm:mb-0">
                    <i class="fas fa-arrow-left mr-2"></i> Go Back
                </a>
                <button type="submit" class="button hover:shadow-lg transition flex items-center justify-center"
                        @if ($errors->any()) disabled @endif>
                    <span id="buttonText">Install Database</span>
                    <span id="loader" class="loader hidden"></span>
                </button>
            </div>
        </form>
        <div class="note">
            <strong>Note:</strong> Do not close this browser window while the installation is in progress. This may interrupt the setup process.
        </div>
    </div>
    <script>
        document.getElementById('installForm').addEventListener('submit', function() {
            const button = document.querySelector('button[type="submit"]');
            document.getElementById('buttonText').textContent = "Installing...";
            document.getElementById('loader').classList.remove('hidden');
            button.disabled = true;
        });
    </script>
</body>
</html>
