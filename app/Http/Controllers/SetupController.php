<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\Setup\SetupStoreRequest;

class SetupController extends Controller
{
    public function index()
    {
        if (Schema::hasTable("setups")) {
            if (\App\Models\Setup::status() == "installed") {
                return redirect()->route("home");
            }
        }
        return view('setup.index');
    }

    public function store(SetupStoreRequest $request)
    {
        $configData = [
            "mysql.database_name" => $request->db_name,
            "mysql.user" => $request->user,
            "mysql.password" => $request->password,
            "setup" => true
        ];

        $filePath = config_path("custom_config.php");
        $data = '<?php return ' . var_export($configData, true) . ';';
        $fileSave = file_put_contents($filePath, $data);

        Artisan::call("migrate:fresh", ["--seed" => true]);

        if ($fileSave)
            return redirect()->route("home")->withSuccess("Kurulum Başarıyla Tamamlandı");
        else
            return redirect()->route("setup.index")->withError("Kurulum Başarısız");
    }
}
