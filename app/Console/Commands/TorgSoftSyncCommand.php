<?php

namespace App\Console\Commands;

use App\Core\StorageManager;
use App\Jobs\ImportTorgSoftProducts;
use Illuminate\Console\Command;

class TorgSoftSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:torgsoft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $remote_file = 'TSGoods.trs';
        $local_file = '/torgsoft/import.csv';
        $storage = (new StorageManager());
        if (!$storage->getLocalPublicDisk()->exists('torgsoft')) {
            $storage->getLocalPublicDisk()->makeDirectory('torgsoft');
        }
        $conn_id = ftp_connect(env('FTP_HOST'));
        ftp_login($conn_id,env('FTP_USER'), env('FTP_PASS'));
        ftp_pasv($conn_id, true);
        $h = fopen('php://temp', 'r+');
        ftp_fget($conn_id, $h, $remote_file, FTP_BINARY,0);
        $fstats = fstat($h);
        fseek($h, 0);
        $contents = fread($h, $fstats['size']);
        $storage->getLocalPublicDisk()->put($local_file,iconv('windows-1251', 'UTF-8', $contents),'public');
        ftp_close($conn_id);
        ImportTorgSoftProducts::dispatch();
        $this->info('Start products updating!');
    }
}
