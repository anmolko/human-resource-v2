<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterCreatedByAndUpdatedBy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:alter_created_and_updated_by';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It alters all the created by and updated in tables that has them';

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


        DB::beginTransaction();
        try {
            foreach ($tables as $table) {
                if (!in_array($table, $excludeTables)) {

                    // Check if the table contains inconsistent data
                    $inconsistentRecords = DB::table($table)->whereNotExists(function ($query) use ($table){
                        $query->select(DB::raw(1))
                            ->from('users')
                            ->whereRaw("$table.created_by = users.id")
                            ->unionAll(function ($query) use ($table) {
                                $query->select(DB::raw(1))
                                    ->from('reference_informations')
                                    ->whereRaw("$table.created_by = reference_informations.id");
                            });
                    })->get();

                    if ($inconsistentRecords->isNotEmpty()) {
                        $this->info('Invalid value encountered in table - ' . $table);
                    }

                    // Define SQL statements for updating foreign key constraints
                    $sql = [
                        "ALTER TABLE $table MODIFY created_by INT UNSIGNED",
                        "ALTER TABLE $table ADD FOREIGN KEY (created_by) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE",
                        "ALTER TABLE $table ADD FOREIGN KEY (created_by) REFERENCES reference_informations(id) ON UPDATE CASCADE ON DELETE CASCADE",
                    ];

                    // Execute the SQL statements
                    foreach ($sql as $statement) {
                        DB::statement($statement);
                    }

                    // Define SQL statements for updating foreign key constraints for updated_by
                    $updatedBySql = [
                        "ALTER TABLE $table MODIFY updated_by INT UNSIGNED",
                        "ALTER TABLE $table ADD FOREIGN KEY (updated_by) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE",
                        "ALTER TABLE $table ADD FOREIGN KEY (updated_by) REFERENCES reference_informations(id) ON UPDATE CASCADE ON DELETE CASCADE",
                    ];

                    // Execute the SQL statements for updated_by
                    foreach ($updatedBySql as $statement) {
                        DB::statement($statement);
                    }
                }
            }
            DB::commit();
            $this->info('Done!');

        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
