<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard - System Requirements</title>
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
                <div class="progress-dot progress-dot-active">
                    <i class="fas fa-list"></i>
                </div>
                <span class="text-sm font-medium text-blue-500 hidden sm:block mt-2">Requirements</span>
            </div>
            <div class="progress-bar-line"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-inactive">
                    <i class="fas fa-database"></i>
                </div>
                <span class="text-sm font-medium text-gray-500 hidden sm:block mt-2">Database</span>
            </div>
            <div class="progress-bar-line"></div>
            <div class="flex flex-col items-center">
                <div class="progress-dot progress-dot-inactive">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="text-sm font-medium text-gray-500 hidden sm:block mt-2">Admin</span>
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
        <h1 class="text-3xl font-bold mb-6 text-center">System Requirements</h1>
        <p class="text-gray-700 mb-6 text-center">
            Before proceeding, we need to ensure your server meets the requirements. Below are the checks for your system:
        </p>
        <table class="w-full text-left mb-8">
            <thead>
                <tr class="border-b text-gray-700">
                    <th class="py-2">Requirement</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php $allPass = true; @endphp
                @foreach ($requirements as $requirement)
                    @php $allPass = $allPass && $requirement['status']; @endphp
                    <tr class="border-b">
                        <td class="py-2 text-gray-600">{{ $requirement['name'] }}</td>
                        <td class="py-2">
                            @if ($requirement['status'])
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span class="ml-2 text-gray-700">{{ $requirement['value'] ?? 'Pass' }}</span>
                            @else
                                <i class="fas fa-times-circle text-red-600"></i>
                                <span class="ml-2 text-gray-700">Fail</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col sm:flex-row sm:justify-between items-center">
            <a href="{{ route('installer.step1') }}" class="button bg-gray-200 text-gray-800 mb-4 sm:mb-0">
                <i class="fas fa-arrow-left mr-2"></i> Previous Step
            </a>
            <a href="{{ route('installer.step3') }}" class="button"
                @if (!$allPass) disabled @endif>
                Continue &rarr;
            </a>
        </div>
    </div>
</body>
</html>
