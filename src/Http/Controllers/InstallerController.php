<?php

namespace AlmirFrances\TanzaInstaller\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InstallerController extends Controller
{
    /**
     * Step 1: Show the initial installation instructions.
     */
    public function step1()
    {

        $envPath = base_path('.env');
        $envExamplePath = base_path('.env.example');

        // Automatically generate .env from .env.example if it doesn't exist
        if (!File::exists($envPath)) {
            if (File::exists($envExamplePath)) {
                File::copy($envExamplePath, $envPath);
            } else {
                File::put($envPath, '');
            }
        }

        // Ensure APP_KEY placeholder exists in .env
        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            if (!str_contains($envContent, 'APP_KEY=')) {
                $envContent .= "\nAPP_KEY=\n";
                File::put($envPath, $envContent);
            }
        }

        // Generate the application key using Artisan
        try {
            Artisan::call('key:generate', ['--force' => true]);
        } catch (\Exception $e) {
            return back()->withErrors(['key_error' => 'Failed to generate application key: ' . $e->getMessage()]);
        }
        return view('tanzainstaller::step1');
    }

    /**
     * Step 2: Check system requirements and folder permissions.
     */
    public function step2()
    {
        $requirements = $this->checkRequirements();

        return view('tanzainstaller::step2', compact('requirements'));
    }

    /**
     * Check the server requirements dynamically.
     */
    protected function checkRequirements()
{
    $requirements = [
        [
            'name' => 'PHP Version (8.2 or higher)',
            'status' => version_compare(PHP_VERSION, '8.2', '>='),
            'value' => PHP_VERSION,
        ],
        $this->checkFolderPermission('Writable /storage Directory', storage_path(), 0775),
        $this->checkFolderPermission('Writable /storage/framework Directory', storage_path('framework'), 0775),
        $this->checkFolderPermission('Writable /storage/logs Directory', storage_path('logs'), 0775),
        $this->checkFolderPermission('Writable /bootstrap/cache Directory', base_path('bootstrap/cache'), 0775),
        [
            'name' => '.env.example File Exists',
            'status' => file_exists(base_path('.env.example')),
            'directory' => base_path('.env.example'),
        ],
    ];

    return $requirements;
}

/**
 * Check folder permissions.
 *
 * @param string $name
 * @param string $path
 * @param int $requiredPermission
 * @return array
 */
protected function checkFolderPermission($name, $path, $requiredPermission)
{
    $currentPermission = substr(sprintf('%o', fileperms($path)), -4); // Get current permissions as octal
    $isWritable = is_writable($path);

    return [
        'name' => $name,
        'status' => $isWritable,
        'current_permission' => $currentPermission,
        'required_permission' => sprintf('%o', $requiredPermission), // Convert to octal
        'directory' => $path,
    ];
}



    // Step 3: Show Database Configuration Form
    public function step3()
    {
        if (!session()->isStarted()) {
            session()->start();
        }
        return view('tanzainstaller::step3');
    }

    public function saveDatabase(Request $request)
    {
        if (!session()->isStarted()) {
            session()->start();
        }

        // Validate the inputs
        $request->validate([
            'db_host' => 'required|string',
            'db_name' => 'required|string',
            'db_user' => 'required|string',
            'db_password' => 'nullable|string',
        ]);

        // Update or create the .env file
        $envUpdated = $this->updateEnvFile([
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => $request->db_host,
            'DB_PORT' => '3306',
            'DB_DATABASE' => $request->db_name,
            'DB_USERNAME' => $request->db_user,
            'DB_PASSWORD' => $request->db_password,
        ]);

        if (!$envUpdated) {
            return redirect()->route('installer.step4')->withErrors(['env_error' => 'Could not update the .env file. Please check file permissions.']);
        }

        // Test database connection
        try {
            config([
                'database.connections.mysql.host' => $request->db_host,
                'database.connections.mysql.database' => $request->db_name,
                'database.connections.mysql.username' => $request->db_user,
                'database.connections.mysql.password' => $request->db_password,
            ]);

            DB::purge('mysql'); // Clear any stale connection
            DB::connection('mysql')->getPdo();

            // Check if the database is empty
            $tables = DB::connection('mysql')->select('SHOW TABLES');
            if (!empty($tables)) {
                return redirect()->route('installer.step4')->withErrors(['db_error' => 'Database is not empty. Please provide an empty database.']);
            }

            return redirect()->route('installer.step4')->with('success', 'Database connection successful! Ready to install.');
        } catch (\Exception $e) {
            return redirect()->route('installer.step4')->withErrors(['db_error' => 'Database connection failed: ' . $e->getMessage()]);
        }
    }


public function installDatabase()
{
    try {
        Artisan::call('migrate', ['--force' => true]);

        try {
            Artisan::call('db:seed', ['--force' => true]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['seed_error' => 'Migrations completed, but seeding failed: ' . $e->getMessage()]);
        }

        return redirect()->route('installer.step5')->with('success', 'Database installed and seeded successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['migration_error' => 'Database installation failed: ' . $e->getMessage()]);
    }
}




    /**
     * Update the .env file with new data.
     */
    private function updateEnvFile($data)
    {
        $envPath = base_path('.env');
        $envExamplePath = base_path('.env.example');

        // If .env doesn't exist, create from .env.example
        if (!File::exists($envPath) && File::exists($envExamplePath)) {
            File::copy($envExamplePath, $envPath);
        }

        if (File::exists($envPath)) {
            $envContent = File::get($envPath);

            foreach ($data as $key => $value) {
                $line = "{$key}={$value}";
                if (preg_match("/^{$key}=(.*)$/m", $envContent)) {
                    $envContent = preg_replace("/^{$key}=(.*)$/m", $line, $envContent);
                } else {
                    $envContent .= "\n{$line}";
                }
            }

            return File::put($envPath, $envContent);
        }

        return false;
    }






    public function step4()
{
    return view('tanzainstaller::step4');
}

public function step5()
{
    return view('tanzainstaller::step5');
}

public function complete()
{
    $this->markInstallationAsComplete();

    return view('tanzainstaller::complete');
}

public function saveAdmin(Request $request)
{
    // Validate the input
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:admins,username',
        'email' => 'required|email|max:255|unique:admins,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        // Create the admin user
        \App\Models\Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('installer.complete')->with('success', 'Admin account created successfully!');
    } catch (\Exception $e) {
        return back()->withErrors(['admin_error' => 'Failed to create admin: ' . $e->getMessage()]);
    }
}


/**
 * Mark installation as complete in the `.env` file.
 */
protected function markInstallationAsComplete()
{
    $envPath = base_path('.env');

    if (file_exists($envPath)) {
        file_put_contents($envPath, preg_replace(
            '/^INSTALLER_INSTALLED=false/m',
            'INSTALLER_INSTALLED=true',
            file_get_contents($envPath)
        ));

        if (!str_contains(file_get_contents($envPath), 'INSTALLER_INSTALLED=true')) {
            file_put_contents($envPath, "\nINSTALLER_INSTALLED=true", FILE_APPEND);
        }
    }
}

}
