<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class AddCreatedTypeToTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:created_type';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add created_type column to all tables except selected tables';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get a list of all table names in the database
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        // Exclude the migrations table
        $excludeTables = ['migrations','users','role_user','airline_detail_ticketing_agent','attribute_primary_group',
            'attribute_secondary_group','company_country_states','module_role','password_resets','permission_role','personal_access_tokens'];

        // Iterate through tables and add the created_type column
        foreach ($tables as $table) {
            if (!in_array($table, $excludeTables)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->string('created_type')->nullable()->after('created_by');
                });

                // Update the created_type values
                $this->updateCreatedTypeValues($table);

                $this->info("Added and updated 'created_type' column to table: {$table}");
            }
        }

        $this->info('Done!');
    }

    protected function updateCreatedTypeValues($table)
    {
        // You can customize this logic to set the appropriate values for 'created_type'
        $createdTypeValue = 'users';

        // Update the 'created_type' column with the desired value
        DB::table($table)->update(['created_type' => $createdTypeValue]);
    }

}
