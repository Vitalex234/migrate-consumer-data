<?php

namespace App\Console\Commands;

use App\Services\ImportCustomerData;
use Illuminate\Console\Command;

/**
 *
 */
class ImportCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data to customers table from csv file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ImportCustomerData $importer
     * @return int
     */
    public function handle(ImportCustomerData $importer)
    {
        $importer->run($this->argument('filename'));
    }
}
