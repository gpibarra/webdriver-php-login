<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use Illuminate\Support\Facades\Storage;

use gpibarra\WebDriverPHP\WebDriver;
use Facebook\WebDriver\WebDriverBy;

use App\Login;
#use Carbon\Carbon;

class LoginCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'login {ServiceName}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Login in ServiceWeb';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $wd = new WebDriver();
        $wd->setDeamon(true);
        sleep(3);
        //$wd->driver->manage()->window()->maximize();

        $serviceName = strtolower($this->argument('ServiceName'));
        switch($serviceName) {
			case "facebook":
				//login Facebook
				/* */
				echo "Preparando Login...\n";
				$data = [
					'username' => env('LOGIN_FB_USER'),
					'password' => env('LOGIN_FB_PASS'),
				];
				Login::Login($wd, config('login.Facebook'), $data);
				echo "Logueando...\n";
				if (!Login::isLoginOk($wd, config('login.Facebook'))) {
					echo "Logueo fallo\n";
					echo "URL actual: ";
					echo $wd->driver->getCurrentURL();
					echo "\n";
					return;
				}
				echo "Login ok\n";
				sleep(5);
				break;
				/* */
			case "twitter":
				//login Twitter
				/* */
				echo "Preparando Login...\n";
				$data = [
					'username' => env('LOGIN_TW_USER'),
					'password' => env('LOGIN_TW_PASS')
				];
				Login::Login($wd, config('login.Twitter'), $data);
				echo "Logueando...\n";
				if (!Login::isLoginOk($wd, config('login.Twitter'))) {
					echo "Logueo fallo\n";
					echo "URL actual: ";
					echo $wd->driver->getCurrentURL();
					echo "\n";
					return;
				}
				echo "Login ok\n";
				sleep(5);
				break;
				/* */
			case "pagomiscuentas":
				//login PagoMisCuentas
				/* */
				echo "Preparando Login...\n";
				$data = [
					'username' => env('LOGIN_PMC_USER'),
					'password' => env('LOGIN_PMC_PASS'),
					'bank' => env('LOGIN_PMC_BANK'),
					'docType' => env('LOGIN_PMC_DOC')
				];
				Login::Login($wd, config('login.PagoMisCuentas'), $data);
				echo "Logueando...\n";
				sleep(10);
				if (!Login::isLoginOk($wd, config('login.PagoMisCuentas'))) {
					echo "Logueo fallo\n";
					echo "URL actual: ";
					echo $wd->driver->getCurrentURL();
					echo "\n";
					return;
				}
				echo "Login ok\n";
				sleep(5);
				break;
				/* */
			default:
				echo "Servicio $serviceName no implementado\n";
		}
        $contents = $wd->driver->takeScreenshot();
        Storage::put('screenShoot.png', $contents);
		sleep(3);
//        WebDriver::stopServer();

    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}

